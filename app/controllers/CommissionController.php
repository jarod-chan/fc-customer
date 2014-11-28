<?php
class CommissionController extends Controller{

	private static $limit=2;

	public function index(){
		$key=trim(Input::get("key"));
		$state=Input::get("state");
		if(!$state||$state==''){
			$state="no";
		}

		if(C::isSale()){
			$dealrecordList=$this->saleDealRecord($state);
		}else{
			$dealrecordList=$this->managerDealRecord($state);
		}

		$minId=$this->getMinId($dealrecordList);
		$dealrecordList=$this->cutDealRecord($dealrecordList);

		return View::make('commission.index')
		->with('dealrecordList',$dealrecordList)
		->with('key',$key)
		->with('state',$state)
		->with('minId',$minId);
	}


	private function saleDealRecord($state){
		$query=Dealrecord::whereRaw('1=1');
		$customer_ids = Customer::where('counselor_id',C::counselorId())
			->lists("id");
		if(count($customer_ids)==0){
			return array();
		}else{
			$query->whereIn('customer_id',$customer_ids);
		}

		$key=trim(Input::get("key"));
		if($key!=''){
			$query->where('customer_name',$key);
		}

		$query->where('state',$state);

		$minId=Input::get("min_id");
		if($minId){
			$query->where('id','<=',$minId);
		}

		$query->orderBy('id','desc');
		return $query->take(self::$limit+1)->get();
	}

	private function managerDealRecord($state){
		$query=Dealrecord::whereRaw('1=1');

		$key=trim(Input::get("key"));
		if($key!=''){
			$query->where('customer_name',$key);
		}

		$query->where('state',$state);

		$minId=Input::get("min_id");
		if($minId){
			$query->where('id','<=',$minId);
		}

		$query->orderBy('id','desc');
		return $query->take(self::$limit+1)->get();
	}

	//页面查询接口
	public function query(){
		$state=Input::get("state");
		if(C::isSale()){
			$dealrecordList=$this->saleDealRecord($state);
		}else{
			$dealrecordList=$this->managerDealRecord($state);
		}
		$minId=$this->getMinId($dealrecordList);
		$dealrecordList=$this->cutDealRecord($dealrecordList);

		$data=array();
		foreach ($dealrecordList as $dealrecord){
			$room=$dealrecord->room();
			$item=array(
				'dr_id'=>$dealrecord->id,
				'room'=>$room['project_name'].$room['building_name'].H::nullStr($room,'buildunit_name').$room['roomName'],
				'customer'=>$room['customer'],
				'purchaseState'=>$room['purchaseState'],
				'contractTotalAmount'=>$room['contractTotalAmount'],
				'totalUnRevAmount'=>$room['totalUnRevAmount'],
				'commission'=>H::trimz($dealrecord->commission),
				'dr_state'=>$dealrecord->state(),
				'dr_inamt'=>H::trimz($dealrecord->inamt),
				'dr_leftamt'=>H::trimz($dealrecord->leftamt)
			);
			array_push($data,$item);
		}

		return array(
			'minId'=>$minId,
			'data'=>$data
		);
	}

	private function getMinId($dealrecordList){
		if($dealrecordList->count()==self::$limit+1){
			$lastDealrecord=$dealrecordList->last();
			return $lastDealrecord->id;
		}else{
			return -1;
		}
	}

	private function cutDealRecord($dealrecordList){
		if($dealrecordList->count()==self::$limit+1){
			$dealrecordList->pop();
		}
		return $dealrecordList;
	}


	public function toDeal($dr_id){
		$dealrecord=Dealrecord::find($dr_id);
		$counselorSet=Counselor::orderBy("id")
		->lists('name','id');
		$queryParam=Input::only('state','key');
		if(C::isSale()){
			return View::make('commission.view')
			->with('dealrecord',$dealrecord)
			->with($queryParam);
		}else {
			return View::make('commission.deal')
			->with('dealrecord',$dealrecord)
			->with('counselorSet',$counselorSet)
			->with($queryParam);
		}
	}

	public function save($dr_id){


		$commissionSet=Input::get('commissionSet');
		$commissionIds=Commission::where('dealrecord_id',$dr_id)->lists('id');
		if(Input::has('commissionSet')){
			foreach ($commissionSet as $arr){
				$arr_id=$arr["id"];
				if(empty($arr_id)){
					$commission=new Commission;
				}else {
					$commissionIds=H::delete($commissionIds,$arr_id);
					$commission=Commission::find($arr_id);
				}
				$arr["dealrecord_id"]=$dr_id;
				$commission->fill($arr);
				$commission->save();
			}
		}
		if(count($commissionIds)>0){
			Commission::destroy($commissionIds);
		}

		$dealrecord=Dealrecord::find($dr_id);
		$arr=Input::only("percent","commission");
		$dealrecord->fill($arr);
		$dealrecord->doCalculation();
		$dealrecord->save();

		$queryParam=Input::only('state','key');

		Session::flash('message', '保存成功');
		return Redirect::action('CommissionController@index',$queryParam);

	}

}