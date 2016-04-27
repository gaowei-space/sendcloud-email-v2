<?php

/**
 * SendCloud Library入口文件.
 *
 * 库的用户只需载入此文件便可直接使用
 * 使用SendCloud Library需要用户的PHP版本 >= 5.3
 *
 */

namespace SendCloud;

class SendCloud
{

    public function __construct()
    {
        Config::init();
    }

    /**
     * 获取/设置配置.
     *
     * @param string $key 键名
     * @param mixed $val 值
     * @param mixed $default 默认返回值
     *
     * @return mixed|void 对于获取配置将返回配置值,不存在指定配置键则返回默认值
     */
    public function config($key, $val = null, $default = null)
    {
        if ($val == null) {
            return Config::get($key, $default);
        } else {
            Config::set($key, $val);
        }
    }

    /**
     * 准备请求数据,设置调用的模块与行为,创建请求对象.
     *
     * @param string|null $module
     * @param string|null $action
     * @param string|array $data
     *
     * @return null|\SendCloud\Request 返回请求对象,配置有误则返回null
     */
    public function prepare($module, $action, $data = 'default')
    {
        $request = $this->_createRequest($this->config("REQUEST"));
        if ( ! is_object($request)) {
            return null;
        }
        $request->setModule($module);
        $request->setAction($action);
        $request->prepareRequest($data);

        return $request;
    }

    /**
     * 创建请求对象.
     *
     * @param string $type 请求类型
     *
     * @return \SendCloud\Request\SMTPReqeust|\SendCloud\Request\WebAPIRequest
     */
    private function _createRequest($type)
    {
        switch (strtolower($type)) {
            case "webapi":
                $obj = new Request\WebAPIRequest();
                break;
            case "smtp":
                $obj = new Request\SMTPReqeust();
                break;
            default:
                $obj = null;
        }

        return $obj;
    }
}