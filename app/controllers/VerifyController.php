<?php
class VerifyController extends Controller{

	public function verify(){
		$phone=Input::get("phone");
		$query=Customer::where('phone',$phone);
		if(Input::has("customer_id")){
			$customer_id=Input::get("customer_id");
			$query->where('id', '!=', $customer_id);
		}
		$customer=$query->first();
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
					'message'=>'客户不存在'
			);
		}
	}

}