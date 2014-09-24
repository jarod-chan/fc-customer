<?php
class MenuController extends Controller{

	public function index(){
		$openid=Input::get("openid");
		$counselor=Counselor::where('openid',$openid)
		->first();
		return array(
			'result'=>true,
			'data'=>array(
					array('name'=>'新增客户','url'=>URL::to("menu/to?counselor_id=$counselor->id&to=customer/add")),
					array('name'=>'意向客户','url'=>URL::to("menu/to?counselor_id=$counselor->id&to=customer/purpose")),
					array('name'=>'签约客户','url'=>URL::to('wx/customer/todo?openid='.$openid)),
					array('name'=>'公共客户','url'=>URL::to('wx/accept/history?openid='.$openid)),
					array('name'=>'佣金结算','url'=>URL::to('wx/accept/history?openid='.$openid))
			)
		);
	}

	public function to(){
		$counselor_id=Input::get("counselor_id");
		$to=Input::get("to");
		Session::put('counselor_id', $counselor_id);
		return  Redirect::to($to);
	}

}