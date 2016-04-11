<?php
/**
 * 处理微信接口类
 */
class WechatController extends Controller{

	public function server(){
		  $token='fytoken';
		  $encodingAesKey='lNRzxzh359IRGqoJ8XnT3SGhys7xObiY38ByWshNonp';
		  $appId='wx154ee7378279cebf';
		  $debugMode=TRUE;
		  $wechat = new W($token, $encodingAesKey, $appId, $debugMode);
		  $wechat->run();
	}



}