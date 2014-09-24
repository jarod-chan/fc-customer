<?php
class Counselor extends Eloquent{

	protected $table = 'fc_counselor';

	protected $primaryKey='id';

	public $timestamps = false;

	protected $fillable = array('name','role','openid');


	public function getRoleName(){
		$arr=array('s' =>'置业顾问','m'=>'销售经理');
		return   $arr[$this->role];
	}

}