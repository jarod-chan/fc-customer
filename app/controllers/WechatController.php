<?php
class WechatController extends Controller{

	public function server(){
		  $token='fccustomer';
		  $encodingAesKey='hXyTUD9UwNPMtUxy9lqVKemH8CQ0aOMzaHJLTiPlpff';
		  $appId='wx154ee7378279cebf';
		  $wechat = new W($token, $encodingAesKey, $appId);
		  $wechat->run();
	}

}