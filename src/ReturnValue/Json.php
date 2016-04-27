<?php

namespace SendCloud\ReturnValue;

class Json
{
    /**
     * SendCloud返回的JSON格式的请求数据转换成关联数组.
     *
     * @param string $data
     *
     * @return array|null
     */
    public static function parse($data)
    {
        return json_decode($data, true);
    }
}