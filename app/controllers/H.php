<?php
class H {

	public static function prepend($arr,$tag){
		$arrTag=array(""=>$tag);
		if(!$arr) return $arrTag;
		foreach ($arr as  $k=>$v){
			$arrTag[$k]=$v;
		}
		return $arrTag;
	}

	public static function  delete($arr,$element){
		$key = array_search($element,$arr);
		if($key!==false){
			unset($arr[$key]);
		}
		return $arr;
	}

	public static function  toSet($arr){
		$ret=array();
		foreach ($arr as $item){
			$ret[$item['id']]=$item['name'];
		}
		return $ret;
	}

	public static function  nullStr($arr,$key){
		if(array_key_exists($key,$arr)){
			return $arr[$key];
		}
		return "";
	}
}

