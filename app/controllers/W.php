<?php
include_once "Whandler.php";

class W extends Wechat {
	protected function onText() {
		$openid = $this->getRequest ( 'FromUserName' );
		$content = trim ( $this->getRequest ( 'content' ) );

		$counselor=Counselor::where('openid',$openid)->first();

		if($counselor){
			$handler = new WCustomerMenu();
			if ($handler->isPattern($content)) {
				$result =  $handler->deal($counselor);
				$this->responseNews ($result);
			}

			$handler = new WRoomprice();
			if ($handler->isPattern($content)) {
				$result =  $handler->deal($openid,$content);
				$this->responseText ($result);
			}

			$handler = new WCustomerQuery();
			if ($handler->isPattern($content)) {
				$result =  $handler->deal($counselor,$content);
				$this->responseText($result);
			}

			$handler = new WDefault();
			$result =  $handler->deal();
			return $this->responseText($result);
		}else{
			$this->responseText ( "你的openid是:$openid" );
		}

	}
}