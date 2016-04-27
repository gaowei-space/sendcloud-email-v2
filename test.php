<?php
require './autoload.php';

$sc = new \SendCloud\SendCloud();

// 参数发送： 参数1为module名称, 参数2为action名称, 参数3为请求参数,它们将作为POST数据提交给接口
/*$req = $sc->prepare('mail', 'send', array(
	'apiUser'     => 'aso100',
	'apiKey'      => 'BVwOWBZM07NJWJ3v',
    'from'        => '574630774@qq.com', # 发信人，用正确邮件地址替代
    'fromname'    => 'Shevy',
    'to'          => 'gaowei@qimai.net',# 收件人地址, 用正确邮件地址替代, 多个地址用';'分隔  
    'subject'     => '欢迎使用ASO100',
    'html'        => '欢迎使用ASO100，完善信息有奖励噢！<a href="http://aso100.com">去完善>></a>',
    'respEmailId' => 'true'
));*/

// 自定义模板发送
// $req = $sc->prepare('mail', 'sendtemplate', 'verifycode'); # 模板发送
$req = $sc->prepare('mail', 'send', 'welcomeBatch'); # 普通发送，地址列表发送

$data = $req->send();       // 提交API调用请求,返回数据
echo "<pre>";
print_r($data);
