<?php
class Dealrecord extends Eloquent{

	protected $table = 'fc_dealrecord';

	protected $primaryKey='id';

	public $timestamps = false;

	protected $fillable = array('customer_id','creater_id','create_at','updater_id','update_at','room_id','amount','percent','commission','inamt','leftamt');

	//创建人
	public function creater(){
		return $this->belongsTo('Counselor', 'creater_id');
	}

	//最后更新人
	public function updater(){
		return $this->belongsTo('Counselor', 'updater_id');
	}
}