<?php

/**
 * 示例:
 *
 * 'template_name' => array(
 *      'api_user' => 'xxx',
 *      'api_key' => 'xxx',             // 不建议在模板中设置api_key,请在config/config.php中统一设置
 *      'from' => 'example@example.com',
 *      'substitution_vars' => '
 *          {
 *              "to": ["example1@example.com", "example2@example.com"],
 *              "sub": {
 *                  "%var1%": ["xxx","yyy"],
 *                  "%var2%": [123,345]
 *              }
 *          }
 *      ',
 *      'to' => 'example1@example.com;example2@example.com',
 *      'subject' => 'xxxxx',
 *      'template_invoke_name' => 'xxx',
 *      'fromname' => 'from_name',
 *      'replyto' => 'example@example.com',
 *      'label' => 'label ID',          // int
 *      'headers' => '{"key1": "val1", "key2": "val2"}',
 *      'files' => 'file data',
 *      'x_smtpapi' => 'xxxxxx',
 *      'resp_email_id' => 'false',      // ('true'|'false')
 *      'use_maillist' => 'false',       // ('true'|'false')
 *      'gzip_compress' => 'false',      // ('true'|'false')
 * ),
 * ...
 */

return [
	'verifycode' => [
		'from'               => 'Shevy<574630774@qq.com>', # 发信人，用正确邮件地址替代
		'fromName'           => '来自ASO100的一份信',
		'subject'            => '来自ASO100的一份信',
		'respEmailId'        => 'true',      // ('true'|'false')
		'templateInvokeName' => 'verifycode',
		'xsmtpapi'           => '{"to": ["gaowei@qimai.net", "18600686927@163.com"],"sub":{"%name%": ["shevy1", "shevy2"],"%verifycode%":[288231, 497232]}}'
	],
 ];