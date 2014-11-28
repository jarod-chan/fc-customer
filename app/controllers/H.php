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

	public static function trimz($s) {
		$s=explode('.',$s);
		if (count($s)==2 && ($s[1]=rtrim($s[1],'0'))) return implode('.',$s);
		return $s[0];
	}

	public static function fmt($date){
		if($date){
			return date('n-j',strtotime($date));
		}else {
			return '';
		}
	}
}

