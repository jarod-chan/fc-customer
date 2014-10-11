<?php
class S{
	//const URL = 'http://172.22.1.30/ser/public/serroom/';
	const URL = 'http://172.22.1.14:8080/fyg/FdcInfoQuery';


	private static function get($model){
		$url=self::URL.'?'.http_build_query($model);

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
		$param=array("infoType"=>"1");
		return self::get($param)['projects'];
	}

	public static function building($sellProject_id){
		//使用urlencode来编码，防止id特殊字符出现错误
		$param=array("infoType"=>"2","projectid"=>$sellProject_id);
		return self::get($param)['buildings'];
	}

	public static function buildingunit($building_id,$roomstatus){
		$param=array("infoType"=>"3","buildingid"=>$building_id);
		$buildingUnits=self::get($param)['buildingUnits'];
		if(count($buildingUnits)>0){
			return array('type'=>'unit','arr'=>$buildingUnits);
		}

		$param=array("infoType"=>"4","buildingid"=>$building_id,"roomStatus"=>$roomstatus);
		$room=self::get($param)['rooms'];
		return array('type'=>'room','arr'=>$room);
	}

	public static function room($buildingunit_id,$roomstatus){
		$param=array("infoType"=>"4","buindunitid"=>$buildingunit_id,"roomStatus"=>$roomstatus);
		return self::get($param)['rooms'];
	}

	public static function roomInfoPurpose($room_id){
		$param=array("infoType"=>"5","roomids"=>'(\''.$room_id.'\')');
		return self::get($param)['rooms'];
	}

	public static function roomInfoDeal($room_id){
		$param=array("infoType"=>"6","roomids"=>'(\''.$room_id.'\')');
		return self::get($param)['rooms'];
	}

}