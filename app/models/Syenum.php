<?php
class Syenum extends Eloquent{

	protected $table = 'fc_enum';

	protected $primaryKey=array('key','type');

	public $timestamps = false;

	protected $fillable = array('type','key','name','sq');

	public static function allTypes(){
		return array(
				array('val'=>'accept_from','name'=>'诉求受理-信息来源'),
				array('val'=>'accept_degree','name'=>'诉求受理-严重程度'),
				array('val'=>'accept_type','name'=>'诉求受理-诉求类别')
		);
	}

	public function scopeKey($query,$type,$key){
		$syenum=$query->where('type',$type)
		->where('key',$key)
		->select('name')
		->first();

 		if($syenum){
			return $syenum->name;
		}else{
			return " ";
		}
	}

	public function scopeVals($query,$type){
		return $query->where('type',$type)
		->orderBy("sq")
		->lists("name","key");
	}

}