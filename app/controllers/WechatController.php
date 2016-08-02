<?php
/**
 * 处理微信接口类
 */
class WechatController extends Controller{

	public function server(){
		  $wechat=Config::get('wechat');
		  $wechat = new W($wechat['token'], $wechat['encodingAesKey'], $wechat['appId'], $wechat['debugMode']);
		  $wechat->run();
	}



}