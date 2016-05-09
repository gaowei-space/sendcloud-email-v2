<?php
require 'vendor/autoload.php';

$sc = new \SendCloud\SendCloud();

// SEND1(普通发送): 参数1为module名称, 参数2为action名称, 参数3为请求参数
$req = $sc->prepare('mail', 'send', array(
    'apiUser'     => '',
    'apiKey'      => '',
    'from'        => '', # 发信人，用正确邮件地址替代
    'fromName'    => '来自***的一份信',
    'to'          => '***@qq.com;***@163.com',# 收件人地址, 用正确邮件地址替代, 多个地址用';'分隔
    'subject'     => '欢迎使用****',
    'html'        => '<p>欢迎使用****</p>',
    'respEmailId' => 'true'
));
// SEND2(模板发送): 参数1为module名称, 参数2为action名称, 参数3为请求参数
/*$req = $sc->prepare('mail', 'sendtemplate', [
    'apiUser'   	 => '',
    'apiKey'    	 => '',
    'from'               => '',
    'fromName'           => '来自***的一份信',
    'subject'            => '来自***的一份信',
    'respEmailId'        => 'true',
    'templateInvokeName' => 'version_v2',
    'xsmtpapi'           => '{"to": ["***@qq.com"],"sub":{"%username%": ["name"],"%link%":["http://qq.com"]}}'
]);*/

// SEND3(自定义模板发送): 参数1为module名称, 参数2为action名称, 参数3为模板名称
// $req = $sc->prepare('mail', 'sendtemplate', 'verifycode');

$data = $req->send();       // 提交API调用请求,返回数据
echo "<pre>";
print_r($data);
