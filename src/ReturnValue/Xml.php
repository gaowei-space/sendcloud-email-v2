<?php

namespace SendCloud\ReturnValue;

class Xml
{
    /**
     * SendCloud返回的XML格式的请求数据转换成关联数组.
     *
     * @param string $data
     *
     * @return array|null
     */
    public static function parse($data)
    {
        $xml = null;
        if ($xml = simplexml_load_string($data)) {
            $xml = (array)$xml;
        }
        return $xml;
    }
}