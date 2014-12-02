<?php
class SysParam extends Eloquent{

	protected $table = 'fc_sysparam';

	protected $primaryKey='key';

	public $timestamps = false;

	protected $fillable = array('key','value');

 	protected $appends = array('name');

	public static function allParams(){
		return array(
				array('key'=>'overdue_day','name'=>'客户过期天数'),
		);
	}

	public function getNameAttribute()
	{
	   foreach (self::allParams() as $param){
		   	if ($param['key']==$this->key) {
		   		return $param['name'];
		   	}
	   }
	   return '';
	}


}