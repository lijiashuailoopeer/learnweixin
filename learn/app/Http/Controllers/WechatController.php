<?php
/**
 * Copyright (C) Loopeer, Inc - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential.
 *
 * Created by PhpStorm.
 * User: lijiashuai
 * Date: 2017/3/30
 * Time: 18:17
 */
namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;

class WechatController extends Controller
{
    private $options;

    public function __construct()
    {
        $this->options = config('api.wx_config');
    }

    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
//        Log::info('request arrived.');
        $app = new Application($this->options);
        $wechat = new Application($this->options);
        $wechat->server->setMessageHandler(function($message) use ($app) {
            $openid = $message->FromUserName;
            if ($message->MsgType == 'event') {
                switch ($message->Event) {
                    case 'subscribe':
                        $user = $app->user->get($openid);
                        $account = Account::where('open_id', $openid)->first();
                        if (empty($account)) {
                            $this->createNewAccount($user);
                        }
                        return config('api.wx_default_msg');
                        break;
                    case 'unsubscribe':
                        break;
                    case "CLICK":
                        $content = $message->EventKey;
                        if($content == 'appointment')
                        {
                            return config('api.wx_appointment_msg');
                        }

                        break;
                    default:
                        break;
                }
            }
            //return config('api.wx_default_msg');
        });
//        Log::info('return response.');
        return $wechat->server->serve();
    }


}