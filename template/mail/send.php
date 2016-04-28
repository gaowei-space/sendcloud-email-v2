<?php

return [
	'welcome' => [
		'from'          => '***@qq.com', # 发信人，用正确邮件地址替代
		'fromName'      => '来自***的一份信',
		'to'            => '***@sina.cn',# 收件人地址, 用正确邮件地址替代, 多个地址用';'分隔  
		'subject'       => '欢迎使用***，完善信息有奖励噢！',
		'html'          => '欢迎使用***，完善信息有奖励噢！你不来耍一耍么？<a href="http://***.com">去完善>></a>',
		'respEmailId'   => 'true',      // ('true'|'false')
	],
	'welcomeBatch' => [
		'from'               => '***@qq.com', # 发信人，用正确邮件地址替代
		'fromName'           => '来自***的一份信',
		'to'                 => '***@maillist.sendcloud.org',#  地址列表的个数不能超过 5,多个地址用';'分隔  
		'subject'            => '欢迎使用***，完善信息有奖励噢！',
		'html'               => '欢迎使用***，完善信息有奖励噢！你不来耍一耍么？<a href="http://***.com">去完善>></a>',
		'useAddressList'     => 'true',
		'respEmailId'        => 'true',      // ('true'|'false')
	],
 ];
