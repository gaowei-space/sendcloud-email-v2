<?php

namespace SendCloud\Request;

use SendCloud\Config as Config;

class RequestTemplate
{
    private static $cache = array();

    /**
     * 载入请求模板.
     *
     * 不存在模板文件或指定模板将返回一个空数组.
     *
     * @param string $module 模块名
     * @param string $action 行为名
     * @param string $templateName 模板名
     *
     * @return array
     */
    public static function loadTemplate($module, $action, $templateName)
    {
        if ( ! is_string($module) || ! is_string($action) || ! is_string($templateName)) {
            return array();
        }
        if (($templates = self::loadCache($module, $action)) === false) {
            $filepath = Config::path("template/{$module}/") . $action . '.php';
            if ( ! file_exists($filepath)) {
                return array();
            }
            $templates = require $filepath;
            if ( ! is_array($templates)) {
                return array();
            }
            self::preserveCache($module, $action, $templates);
        }

        if (array_key_exists($templateName, $templates)) {
            return $templates[$templateName];
        }

        return array();
    }

    /**
     * 载入缓存的模板
     *
     * @param string $module 模块名
     * @param string $action 动作名
     *
     * @return bool|array 模板存在则返回模板关联数组, 否则返回false
     */
    private static function loadCache($module, $action)
    {
        if (isset(self::$cache["{$module}.{$action}"])) {
            return self::$cache["{$module}.{$action}"];
        }
        return false;
    }

    /**
     * 缓存模板
     *
     * @param string $module 模块名
     * @param string $action 动作名
     * @param string $templates 模板数组
     */
    private static function preserveCache($module, $action, $templates)
    {
        self::$cache["{$module}.{$action}"] = $templates;
    }
}