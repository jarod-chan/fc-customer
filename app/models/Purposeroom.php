<?php
class Purposeroom extends Eloquent{

	protected $table = 'fc_purposeroom';

	protected $primaryKey='id';

	public $timestamps = false;

	protected $fillable = array('customer_id','creater_id','create_at','updater_id','update_at','level','reason','room_id');

	//创建人
	public function creater(){
		return $this->belongsTo('Counselor', 'creater_id');
	}

	//最后更新人
	public function updater(){
		return $this->belongsTo('Counselor', 'updater_id');
	}

	public function room(){
		$arr=S::roomInfoPurpose($this->room_id);
		if($arr) {
			return $arr[0];
		}
		return null;
	}

	public static function enum($key){
		return Syenum::vals('purposeroom_'.$key);
	}

	public function name($key){
		return Syenum::key('purposeroom_'.$key,$this->$key);
	}

}