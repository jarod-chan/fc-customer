<?php
//service的公共代码
class SC {

	public static function  isSale($counselor_id){
		$counselor=Counselor::find($counselor_id);
		return $counselor->role=="s";
	}

}