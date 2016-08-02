<?php
class HttpClient {

	var $url;

	function __construct() {
		$this->url=$wechat=Config::get('eas.url');
	}


	public function get($method,$param){
		$url=$this->url;
		if($method) {
			$url=$url.'/'.$method;
		}
		if ($param) {
			$url=$url.'?'.http_build_query($param);
		}

		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);

		return json_decode($result, true);
	}

	public function postData($param) {
		$url=$this->url;

		$curlPost = 'infoType=7&args=' . urlencode ( $param );
		$ch = curl_init (); // 初始化curl
		curl_setopt ( $ch, CURLOPT_URL, $url); // 抓取指定网页
		curl_setopt ( $ch, CURLOPT_HEADER, 0); // 设置header
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 ); // 要求结果为字符串且输出到屏幕上
		curl_setopt ( $ch, CURLOPT_POST, 1 ); // post提交方式
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $curlPost );
		$data = curl_exec ( $ch ); // 运行curl
		curl_close ( $ch );

		return json_decode ( $data, true );
	}


}