<?php

namespace SendCloud\Request;

abstract class AbstractRequest
{
    /**
     * @var string SendCloud接口基础地址
     */
    protected $baseUrl;

    /**
     * @var string 实际请求地址
     */
    protected $requestUrl;

    /**
     * @var string 模块
     */
    protected $module = "";

    /**
     * @var string 动作
     */
    protected $action = "";

    /**
     * WEBAPI获取请求的模块
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * WEBAPI设置请求的模块
     *
     * @param string $module 模块名
     *
     * @return void
     */
    public function setModule($module)
    {
        $this->module = is_string($module) ? $module : $this->$module;
        $this->prepareUrl();

        return $this;
    }

    /**
     * WEBAPI获取请求的动作
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * WEBAPI设置请求的动作
     *
     * @param string $action 动作名
     *
     * @return void
     */
    public function setAction($action)
    {
        $this->action = is_string($action) ? $action : $this->$action;
        $this->prepareUrl();

        return $this;
    }

    /**
     * 发送数据前准备请求参数数据
     *
     * @param string|array $data 关联数组
     */
    abstract public function prepareRequest($data);

    /**
     * 设置请求参数
     *
     * @param string $name 参数名
     * @param string $val 参数值
     */
    abstract public function setParam($name, $val);

    /**
     * 生成API请求URL
     */
    abstract protected function prepareUrl();
}