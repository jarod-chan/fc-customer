<?php
class C{
	public static function isSale(){
		return Session::get('counselor_role')=='s';
	}

	public static function isManager(){
		return Session::get('counselor_role')=='m';
	}

	public static function counselorId(){
		return Session::get('counselor_id');
	}
}