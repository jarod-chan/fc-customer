<?php
class QueryController extends Controller{

	public function query(){
		$param=Input::get("param");
		$customer=Customer::where('phone',$param)->first();
		if($customer){
			return array(
				'result'=>true,
				'data'=>array(
					'name'=>$customer->name,
					'phone'=>$customer->phone,
					'counselor'=>$customer->counselor->name,
					'state'=>$customer->getStateName()
				)
			);
		}else{
			return array(
					'result'=>false,
					'message'=>"该客户不存在！"
			);
		}
	}
}