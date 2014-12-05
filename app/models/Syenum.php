<?php
class Syenum extends Eloquent{

	protected $table = 'fc_enum';

	protected $primaryKey=array('key','type');

	public $timestamps = false;

	protected $fillable = array('type','key','name','sq');

	public static function allTypes(){
		return array(
				array('val'=>'customer_from','name'=>'客户信息-来源'),
				array('val'=>'customer_way','name'=>'客户信息-途径'),
				array('val'=>'purpose_khjb','name'=>'意向信息-客户级别'),
				array('val'=>'purpose_yxqd','name'=>'意向信息-意向强度'),
				array('val'=>'purpose_gfdj','name'=>'意向信息-购房动机'),
				array('val'=>'purpose_zzlx','name'=>'意向信息-住宅类型'),
				array('val'=>'purpose_hxlx','name'=>'意向信息-户型类型'),
				array('val'=>'purpose_jzfg','name'=>'意向信息-楼层'),
				array('val'=>'purpose_jzx','name'=>'意向信息-精装修'),
				array('val'=>'purpose_yhld','name'=>'意向信息-优惠力度'),
				array('val'=>'purpose_xqf','name'=>'意向信息-学区房'),
				array('val'=>'purposeroom_level','name'=>'意向房源-意向级别')
		);
	}

	public static function typeName($key){
		$allTypes=self::allTypes();
		foreach ($allTypes as $type){
			if($type['val']==$key){
				return $type['name'];
			}
		}
		return '';
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