<?php

namespace SendCloud;

class Config 
{
    public static $config = array();

    public static function init()
    {
        $_config = require self::path("config") . DIRECTORY_SEPARATOR . "config.php";
        self::$config = array_merge(self::$config, $_config);
    }

    /**
     * 返回指定目录名的绝对路径.
     *
     * 目录名相对于库根目录.
     *
     * @param string $directory 目录名
     *
     * @return string 绝对路径
     */
    public static function path($directory)
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . $directory;
    }

    /**
     * 获取配置值.
     *
     * 允许获得二维数组的配置值,只需要将多维数组的键以逗号"."分隔开即可
     * 例如: Config::get('d1.d2'); // 获得$config['d1']['d2']的值(如果存在的话).
     *
     * @param string    $key        键名
     * @param mixed     $default    默认返回值
     *
     * @return mixed 不存在指定键名则返回默认返回值
     */
    public static function get($key, $default = null)
    {
        if ( ! is_string($key)) {
            return $default;
        }
        $key = strtoupper($key);
        if ( ! strpos($key, '.')) {
            return isset(self::$config[$key]) ? self::$config[$key] : $default;
        } else {
            // 试图获取二维数组值
            $d = explode('.', $key);
            $d1 = array_shift($d);
            $d2 = implode('.', $d);

            return isset(self::$config[$d1][$d2]) ? self::$config[$d1][$d2] : $default;
        }
    }

    /**
     * 设置配置.
     *
     * 允许设置二维数组,方式同get方法
     * 当设置二维数组时,如果第一维已设置并且不为数组类型,则不会进行配置的设置,直接返回.
     *
     * @param string    $key 键名
     * @param mixed     $val 键值
     *
     * @return void
     */
    public static function set($key, $val)
    {
        if( ! is_string($key)) {
            return;
        }
        $key = strtoupper($key);
        if ( ! strpos($key, '.')) {
            self::$config[$key] = $val;
        } else {
            // 试图获取二维数组值
            $d = explode('.', $key);
            $d1 = array_shift($d);
            $d2 = implode('.', $d);

            if (is_array(self::$config[$d1]) || ! isset(self::$config[$d1])) {
                self::$config[$d1][$d2] = $val;
            }
        }
    }

}
