<?php
class Counselor extends Eloquent{

	protected $table = 'fc_counselor';

	protected $primaryKey='id';

	public $timestamps = false;

	protected $fillable = array('name','role','openid');

	public static function roleEnums(){
		return array('s' =>'销售顾问','m'=>'销售经理');
	}

	public function getRoleName(){
		$arr=array('s' =>'销售顾问','m'=>'销售经理');
		return   $arr[$this->role];
	}

}