<?php

class Wquery {

	public function query($counselor_id,$param){
		if(empty($param)){
			return "请在？后输入查询的客户手机号或者客户姓名";
		}

		$customerSet=Customer::where('phone',$param)
			->orWhere('name','like', '%'.$param.'%')
			->take(10)
			->get();

		if(!$customerSet->isEmpty()){
			$result=array('result'=>true);
			$result['data']=$this->fmtCustomer($customerSet,$counselor_id);
		}else{
			$result=array(
					'result'=>false,
					'message'=>"无法查询到相关的客户！",
					'url'=>URL::to("menu/to?counselor_id=$counselor_id&to=customer/add")
			);
		}
		return $this->resultToString($result);
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

	private function resultToString($result){

		if($result['result']){
			$data = $result['data'];
			$msg = '';
			for($i = 0; $i < count($data); $i ++){
				$name = $data[$i]['name'];
				$phone = $data[$i]['phone'];
				$counselor = $data[$i]['counselor'];
				$state = $data[$i]['state'];
				$msg .= "姓名：".$name."\n手机：".$phone."\n销售顾问：".$counselor."\n状态：".$state;
				if($data[$i]['showurl'] == 1){
					$url = $data[$i]['url'];
					$msg .= "\n<a href=\"$url\">点击跳转</a>\n\n";
				}else{
					$msg .= "\n\n";
				}
			}
			return $msg;
		}else{
			$msg=$result['message'];
			return $msg;
		}
	}

}