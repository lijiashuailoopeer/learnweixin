<?php
/**
 * Copyright (C) Loopeer, Inc - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 *
 * User: msy
 * Date: 16-11-22
 * Time: 下午9:19
 */
return array(
    'wx_config' => [
        'debug' => env('WECHAT_DEBUG', true),
        'app_id'  => env('WX_APP_ID'),         // AppID
        'secret'  => env('WX_APP_SECRET'),     // AppSecret
        'token'   => env('WX_TOKEN'),          // Token
        'oauth' => [
            'scopes'   => ['snsapi_userinfo'],
            'callback' => '/wechat/callback',
        ],
    ],
    'wechat_menus' => [
        [
            'type' => 'view',
            'name' => '我要加分',
            'url' => 'https://www.baidu.com'
        ],
        [
            'type' => 'view',
            'name' => '我要减分',
            'url' => 'https://www.baidu.com'
        ],
    ]
);
