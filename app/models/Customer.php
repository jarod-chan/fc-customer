<?php
class Customer extends Eloquent{

	protected $table = 'fc_customer';

	protected $primaryKey='id';

	public $timestamps = false;

	protected $fillable = array('name','phone','qq','email','weixin','from','way','state','register_id','register_at','counselor_id','update_at');

	public static function  stateEnums(){
		return array('purpose' =>'意向客户','sign'=>'签约客户','public'=>'公共客户');
	}

	public function getStateName(){
		return self::stateEnums()[$this->state];
	}

	//顾问
	public function counselor(){
		return $this->belongsTo('Counselor', 'counselor_id');
	}

	//登记人
	public function register(){
		return $this->belongsTo('Counselor', 'register_id');
	}

}