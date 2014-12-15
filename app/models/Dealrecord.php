<?php
class Dealrecord extends Eloquent{

	protected $table = 'fc_dealrecord';

	protected $primaryKey='id';

	public $timestamps = false;

	protected $fillable = array('customer_id','creater_id','create_at','updater_id','update_at','room_id','state','percent','commission','inamt','leftamt','customer_name');

	//创建人
	public function creater(){
		return $this->belongsTo('Counselor', 'creater_id');
	}

	//最后更新人
	public function updater(){
		return $this->belongsTo('Counselor', 'updater_id');
	}

	//状态
	public static function  stateEnums(){
		return array('no' =>'未结算','do'=>'部分结算','done'=>'已结算');
	}

	public function state(){
		if($this->state){
			return self::stateEnums()[$this->state];
		}
		return "";
	}

	public function commissions()
	{
		return $this->hasMany('Commission','dealrecord_id');
	}

	public function room(){
		$arr=S::roomInfoDeal($this->room_id);
		if($arr) {
			return $arr[0];
		}
		return null;
	}

	public function  doInitPercent($room){
		$default_percent=bcadd("0","0",5);
		if($room){
			$totalamout=bcadd($room['contractTotalAmount'],'0',5);

			$projectid=$room['projectid'];
			$projectpct=ProjectPct::find($projectid);
			if($projectpct){
				$default_percent=bcadd("0",$projectpct->percent,5);
			}
			$commission=bcmul('0.01',$default_percent,5);//百分比存储,除以100获得数值
			$commission=bcmul($totalamout,$commission,5);

			$this->percent = $default_percent;
			$this->commission = $commission;
		}
	}


	public function doCalculation(){
		$inamt="0";
		$leftamt="0";
		$tpercent=bcadd("0","0",5);
		foreach ($this->commissions as $item){
			$inamt=bcadd($inamt,$item->commission,5);
			$tpercent=bcadd($tpercent,$item->percent,5);
		}

		//根据百分比的和更新结算状态
		$compZero=bccomp($tpercent,"0",5);
		$compOne=bccomp($tpercent,"100",5);

		if($compZero==0){
			$this->state='no';
		}else if($compZero==1&&$compOne==-1){
			$this->state='do';
		}else{
			$this->state='done';
		}

		$this->inamt=$inamt;
		$this->leftamt=bcsub($this->commission,$inamt,5);
	}

}