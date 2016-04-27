<?php

return [
	'welcome' => [
		'from'          => '574630774@qq.com', # 发信人，用正确邮件地址替代
		'fromName'      => '来自Shevy的一份信',
		'to'            => '18001210160@sina.cn',# 收件人地址, 用正确邮件地址替代, 多个地址用';'分隔  
		'subject'       => '欢迎使用ASO100，完善信息有奖励噢！',
		'html'          => '欢迎使用ASO100，完善信息有奖励噢！你不来耍一耍么？<a href="http://aso100.com">去完善>></a>',
		'respEmailId'   => 'true',      // ('true'|'false')
	],
	'welcomeBatch' => [
		'from'               => '574630774@qq.com', # 发信人，用正确邮件地址替代
		'fromName'           => '来自ASO100的一份信',
		'to'            	 => 'daren@maillist.sendcloud.org',#  地址列表的个数不能超过 5,多个地址用';'分隔  
		'subject'            => '欢迎使用ASO100，完善信息有奖励噢！',
		'html'          	 => '欢迎使用ASO100，完善信息有奖励噢！你不来耍一耍么？<a href="http://aso100.com">去完善>></a>',
		'useAddressList'	 => 'true',
		'respEmailId'        => 'true',      // ('true'|'false')
	],
 ];