<?php
class QueryController extends Controller{

	public function query(){
		$openid=Input::get("openid");
		log::info(':'.$openid.':');
		$counselor=Counselor::where('openid',$openid)
			->first();
		if(!$counselor){
			return array(
					'result'=>false,
					'message'=>"你没有查询权限！"
			);
		}
		$counselor_id=$counselor->id;

		$param=Input::get("param");
		$customerSet=Customer::where('phone',$param)
			->orWhere('name','like', '%'.$param.'%')
			->get();

		if(!$customerSet->isEmpty()){
			$result=array('result'=>true);
			$result['data']=$this->fmtCustomer($customerSet,$counselor_id);
			return $result;
		}else{
			return array(
					'result'=>false,
					'message'=>"该客户不存在！",
					'url'=>URL::to("menu/to?counselor_id=$counselor->id&to=customer/add")
			);
		}
	}

	private function fmtCustomer($customerSet,$counselor_id){
		$set=array();
		foreach ($customerSet as $customer) {
			$arr=array(
					'name'=>$customer->name,
					'phone'=>$customer->phone,
					'counselor'=>$customer->counselor->name,
					'state'=>$customer->getStateName(),
					'url'=>URL::to("menu/to?counselor_id=$counselor_id&to=customer/$customer->id/edit")
			);
			if($customer->counselor_id==$counselor_id){
				$arr['showurl']=true;
			}else{
				$arr['showurl']=false;
			}
			array_push($set,$arr);
		}
		return $set;
	}
}