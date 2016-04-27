<?php

namespace SendCloud\Request;

class SMTPRequest extends AbstractRequest
{
    private $port;

    public function __construct()
    {
        $this->port = 80;
        $this->baseUrl = "smtpcloud.sohu.com";
    }

    public function prepareRequest($data)
    {

    }

    protected function prepareUrl()
    {

    }
}