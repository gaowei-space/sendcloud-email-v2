<?php

namespace SendCloud\Request;

use SendCloud\Config as Config;
use SendCloud\ReturnValue as RV;

class WebAPIRequest extends AbstractRequest
{
    /**
     * @var array 请求参数集
     */
    private $data = array();

    public function __construct()
    {
        $this->baseUrl = "http://api.sendcloud.net/apiv2/";
    }

    /**
     * 发送API请求.
     *
     * 允许重复发送请求.
     *
     * @return null|array 请求参数错误将返回null
     */
    public function send()
    {
        $ch = curl_init($this->requestUrl);

        $cOptions = array(
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_URL => $this->requestUrl,
            CURLOPT_POSTFIELDS => $this->data
        );
        curl_setopt_array($ch, $cOptions);
        $ret = curl_exec($ch);
        curl_close($ch);

        return $this->parseReturnData($ret);
    }

    /**
     * 准备请求参数.
     *
     * 在发送请求前,允许对用户自定义的参数或模板参数进行替换
     * 当用户数据中缺乏必要字段时,方法将会从配置中取出预先设置的值进行覆盖.
     *
     * @param string|array $params 请求参数数组或模板名, 默认取得默认请求模板
     *
     * @return void
     */
    public function prepareRequest($params = 'default')
    {
        if (is_string($params)) {
            // 载入请求模板
            $params = RequestTemplate::loadTemplate($this->getModule(), $this->getAction(), $params);
        } elseif ( ! is_array($params)) {
            $params = array();
        }

        $params['apiKey'] = isset($params['apiKey']) ? $params['apiKey'] : Config::get('API_KEY');
        $params['apiUser'] = isset($params['apiUser']) ? $params['apiUser'] : Config::get('API_USER');
        $this->data = $params;

        return $this;
    }

    /**
     * 设置请求参数.
     *
     * @param string $name 参数名
     * @param string $val 参数值
     *
     * @return void
     */
    public function setParam($name, $val)
    {
        if ( ! is_string($name) || ! is_string($val)) {
            return;
        }
        $this->data[$name] = $val;

        return $this;
    }

    /**
     * 返回请求参数的值.
     *
     * @param string $name 参数名
     *
     * @return mixed 参数不存在返回null
     */
    public function getParam($name)
    {
        if ( ! is_string($name) || ! isset($this->data[$name])) {
            return null;
        }

        return $this->data[$name];
    }

    /**
     * 设置请求地址.
     *
     * 每当用户设置请求的API模块与行为时,请求地址将发生变化.
     *
     * @return void
     */
    protected function prepareUrl()
    {
        $this->requestUrl = $this->baseUrl . $this->module . '/' . $this->action;
    }

    /**
     * 根据格式将返回数据转为关联数组.
     *
     * @param mixed $data
     *
     * @return array|null
     */
    private function parseReturnData($data)
    {
        $format = strtolower(Config::get("FORMAT"));
        switch ($format) {
            case "json":
                return RV\Json::parse($data);
                break;
            case "xml":
                return RV\Xml::parse($data);
                break;
        }
    }
}