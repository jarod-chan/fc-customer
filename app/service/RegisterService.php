<?php
class RegisterService extends Controller{

	public function  isRegister(){
		$openid=Input::get("openid");
		$counselor=Counselor::where('openid',$openid)->select("id","name","role")->first();
		if($counselor){
			return array(
					'result'=>true,
					'data'=>$counselor
			);
		}else{
			return array(
					'result'=>false,
					'message'=>'微信openid认证失败'
			);
		}
	}


}