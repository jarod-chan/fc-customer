<?php
class MenuController extends Controller{



	public function index(){
		$openid=Input::get("openid");
		$counselor=Counselor::where('openid',$openid)
		->first();
		include_once "MenuArray.php";
		return array(
			'result'=>true,
			'data'=>$menuArray
		);
	}

	public function to(){
		$counselor_id=Input::get("counselor_id");
		$to=Input::get("to");
		Session::put('counselor_id', $counselor_id);
		$counselor=Counselor::find($counselor_id);
		Session::put('counselor_role',$counselor->role);
		return  Redirect::to($to);
	}

}