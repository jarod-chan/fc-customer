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

	public static function isMobile(){
		return Session::has('counselor_role')&&Session::has('counselor_id');
	}

	public static function isLogin(){
		return self::getKeyFromSession('is_login',false);
	}

	private static function getKeyFromSession($key,$default){
		if(Session::has($key)){
			return Session::get($key);
		}
		return $default;
	}
}