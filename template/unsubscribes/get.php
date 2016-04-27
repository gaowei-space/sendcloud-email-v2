<?php

/**
 * 示例:
 *
 * 'template_name' => array(
 *      'api_user' => 'xxx',
 *      'api_key' => 'xxx',             // 不建议在模板中设置api_key,请在config/config.php中统一设置
 *      'days' => 1,
 *      'start_date' => '2015-03-11',
 *      'end_date' => '2015-03-31',
 *      'email' => 'example@example.com',
 *      'api_user_list' => 'api_user_list=user1;user2;user3',
 *      'label_id_list' => 'label_id_list=id1;id2;id3',
 *      'start' => 10,                  // int >= 0
 *      'limit' => 50                   // int [0-10]
 * ),
 * ...
 */
return array();