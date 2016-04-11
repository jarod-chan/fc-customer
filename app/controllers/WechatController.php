<?php
/**
 * 处理微信接口类
 */
class WechatController extends Controller{

	public function server(){
		  $token='fytoken';
		  $encodingAesKey='lNRzxzh359IRGqoJ8XnT3SGhys7xObiY38ByWshNonp';
		  $appId='wx2e99aec0be0cb0b5';
		  $debugMode=TRUE;
		  $wechat = new W($token, $encodingAesKey, $appId, $debugMode);
		  $wechat->run();
	}



}