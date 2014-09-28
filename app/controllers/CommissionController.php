<?php
class CommissionController extends Controller{

	public function index(){

		$customer_ids = Customer::where('counselor_id',C::counselorId())->lists('id');
		if(C::isSale()){
			$query=Dealrecord::whereIn('customer_id',$customer_ids)
			->orderBy('id','desc');
		}else {
			$query=Dealrecord::orderBy('id','desc');
		}
		$dealrecordList=$query->get();
		return View::make('commission.index')
		->with('dealrecordList',$dealrecordList);
	}

	public function toDeal($dr_id){
		$counselorSet=Counselor::orderBy("id")
		->lists('name','id');
		$dealrecord=Dealrecord::find($dr_id);
		return View::make('commission.deal')
		->with('dealrecord',$dealrecord)
		->with('counselorSet',$counselorSet);
	}

	public function save($dr_id){
		$commissionSet=Input::get('commissionSet');
		$commissionIds=Commission::where('id',$dr_id)->lists('id');
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

		Session::flash('message', '保存成功');
		return Redirect::action('CommissionController@index');

	}

}