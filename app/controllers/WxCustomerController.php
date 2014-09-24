<?php
class WxCustomerController  extends Controller {

	public function  toAdd($crid){
		$counselorSet=Counselor::orderBy("id")
			->lists('name','id');
		$stateSet=Customer::stateEnums();

		$counselor=Counselor::find($crid);

		return View::make('wxcustomer.add')
		->with('counselorSet',$counselorSet)
		->with('stateSet',$stateSet)
		->with('counselor',$counselor)
		->with('crid',$crid);
	}

	public function save($crid){
		$arr=Input::all();
		$arr['register_id']=$crid;
		$arr['register_at']=new DateTime();
		$customer=Customer::create($arr);
		Session::flash('message', '保存成功');
		return Redirect::action('WxCustomerController@toEdit', array('crid' => $crid,'id'=>$customer->id));
	}

	public function toEdit($crid,$id){
		$customer=Customer::find($id);

		$counselorSet=Counselor::orderBy("id")
		->lists('name','id');
		$stateSet=Customer::stateEnums();

		return View::make('wxcustomer.edit')
		->with('customer',$customer)
		->with('counselorSet',$counselorSet)
		->with('stateSet',$stateSet)
		->with('crid',$crid);
	}

}