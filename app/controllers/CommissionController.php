<?php
class CommissionController extends Controller{

	public function index(){
		$key=trim(Input::get("key"));
		if(C::isSale()){
			$dealrecordList=$this->saleDealRecord();
		}else{
			$dealrecordList=$this->managerDealRecord();
		}

		return View::make('commission.index')
		->with('dealrecordList',$dealrecordList)
		->with('key',$key);
	}


	private function saleDealRecord(){
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
		$query->orderBy('id','desc');
		return $query->get();
	}

	private function managerDealRecord(){
		$query=Dealrecord::whereRaw('1=1');

		$key=trim(Input::get("key"));
		if($key!=''){
			$query->where('customer_name',$key);
		}

		$query->orderBy('id','desc');
		return $query->get();
	}


	public function toDeal($dr_id){
		$dealrecord=Dealrecord::find($dr_id);
		$counselorSet=Counselor::orderBy("id")
		->lists('name','id');
		if(C::isSale()){
			return View::make('commission.view')
			->with('dealrecord',$dealrecord);
		}else {
			return View::make('commission.deal')
			->with('dealrecord',$dealrecord)
			->with('counselorSet',$counselorSet);
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

		Session::flash('message', '保存成功');
		return Redirect::action('CommissionController@index');

	}

}