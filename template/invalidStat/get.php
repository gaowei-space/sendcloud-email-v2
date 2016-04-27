<?php

/**
 * 示例:
 *
 * 'template_name' => array(
 *      'api_user' => 'xxx',
 *      'api_key' => 'xxx',             // 不建议在模板中设置api_key,请在config/config.php中统一设置
 *      'days' => 1,                    // int
 *      'start_date' => '2015-03-15',
 *      'end_date' => '2015-03-31',
 *      'api_user_list' => 'api_user_list:user1;user2;user3',
 *      'label_id_list' => 'label_id_list:id1;id2;id3',
 *      'domain_list' => 'domain_list:domain1;domain2;domain3',
 *      'aggregate' => 1                // int (0|1)
 * ),
 * ...
 */
return array();