<?php
class WxMenuController extends Controller{

	public function menu(){
		$openid=Input::get("openid");
		$counselor=Counselor::where('openid',$openid)
		->first();
		return array(
			'result'=>true,
			'data'=>array(
					array('name'=>'新增客户','url'=>URL::to("wx/{$counselor->id}/customer/add")),
					array('name'=>'意向客户','url'=>URL::to('wx/customer/todo?openid='.$openid)),
					array('name'=>'签约客户','url'=>URL::to('wx/customer/todo?openid='.$openid)),
					array('name'=>'公共客户','url'=>URL::to('wx/accept/history?openid='.$openid)),
					array('name'=>'佣金结算','url'=>URL::to('wx/accept/history?openid='.$openid))
			)
		);
	}

}