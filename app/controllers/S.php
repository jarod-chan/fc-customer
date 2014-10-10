<?php
class S{
	//const URL = 'http://172.22.1.30/ser/public/serroom/';
	const URL = 'http://172.22.1.14:8080/fyg/FdcInfoQuery';


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
		return self::get('?infoType=1')['projects'];
	}

	public static function building($sellProject_id){
		//使用urlencode来编码，防止id特殊字符出现错误
		return self::get('?infoType=2&projectid='.urlencode($sellProject_id))['buildings'];
	}

	public static function buildingunit($building_id,$roomstatus){
		$buildingUnits=self::get('?infoType=3&buildingid='.urlencode($building_id))['buildingUnits'];
		if(count($buildingUnits)>0){
			return array('type'=>'unit','arr'=>$buildingUnits);
		}
		$room=self::get('?infoType=4&roomStatus='.$roomstatus.'&buildingid='.urlencode($building_id))['rooms'];
		return array('type'=>'room','arr'=>$room);
	}

	public static function room($buildingunit_id,$roomstatus){
		return self::get('?infoType=4&roomStatus='.$roomstatus.'&buindunitid='.urlencode($buildingunit_id))['rooms'];
	}

	public static function roomofid($room_id){
		return self::get('roomofid?val='.urlencode($room_id));
	}

}