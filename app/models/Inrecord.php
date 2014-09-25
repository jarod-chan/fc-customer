<?php
class Inrecord extends Eloquent{

	protected $table = 'fc_inrecord';

	protected $primaryKey='id';

	public $timestamps = false;

	protected $fillable = array('customer_id','creater_id','create_at','updater_id','update_at','type','description','result');

	public static function  typeEnums(){
		return array('dhhf' =>'电话回访','gksm'=>'顾客上门');
	}

	public function getTypeName(){
		return self::typeEnums()[$this->type];
	}


	//创建人
	public function creater(){
		return $this->belongsTo('Counselor', 'creater_id');
	}

	//最后更新人
	public function updater(){
		return $this->belongsTo('Counselor', 'updater_id');
	}

}