<?php
class Customer extends Eloquent{

	protected $table = 'fc_customer';

	protected $primaryKey='id';

	public $timestamps = false;

	protected $fillable = array('name','phone','qq','email','weixin','from','way','state','register_id','register_at','counselor_id','update_at','remark');

	public static function  stateEnums(){
		return array('purpose' =>'意向客户','sign'=>'签约客户','public'=>'公共客户');
	}

	public function getStateName(){
		if($this->state){
			return self::stateEnums()[$this->state];
		}else{
			return "";
		}
	}

	public static function enum($key){
		return Syenum::vals('customer_'.$key);
	}

	public function name($key){
		return Syenum::key('customer_'.$key,$this->$key);
	}

	//顾问
	public function counselor(){
		return $this->belongsTo('Counselor', 'counselor_id');
	}

	//登记人
	public function register(){
		return $this->belongsTo('Counselor', 'register_id');
	}

	//判断是否重复
	public function isPhoneExist(){
		$query=Customer::where('phone',$this->phone);
		if($this->id){
			$query->where('id', '!=', $this->id);
		}
		$customer=$query->first();
		if($customer){
			return true;
		}else {
			return false;
		}
	}

}