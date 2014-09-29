<?php
class S{
	const URL = 'http://172.22.1.30/ser/public/serroom/';

	private static function get($model){
		$url=self::URL.$model;

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

	public static function sellProject(){
		return self::get('sellproject');
	}

	public static function building($sellProject_id){
		//使用urlencode来编码，防止id特殊字符出现错误
		return self::get('building?val='.urlencode($sellProject_id));
	}

	public static function buildingunit($building_id){
		return self::get('buildingunit?val='.urlencode($building_id));
	}

	public static function room($buildingunit_id){
		return self::get('room?val='.urlencode($buildingunit_id));
	}

	public static function roomofid($room_id){
		return self::get('roomofid?val='.urlencode($room_id));
	}

}