<?php
class Commission extends Eloquent{

	protected $table = 'fc_commission';

	protected $primaryKey='id';

	public $timestamps = false;

	protected $fillable = array('dealrecord_id','percent','commission','counselor_id','comdate_at');

	//顾问
	public function counselor(){
		return $this->belongsTo('Counselor', 'counselor_id');
	}
}