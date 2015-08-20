<?php
class CustomerService extends Controller{

	/*
	 * 客户可能得状态
	 * */
	public function  states(){
		$states=Customer::stateEnums();
		return H::toArr($states);
	}

	/*
	 * 客户列表
	 * */
	public function index($state){
		$counselor_id=Input::get("app_counselor_id");
		$query=Customer::where('state',$state);

		if(!$this->isQueryPublicCustomer($state)){
			if(SC::isSale($counselor_id)){
				$query->where('counselor_id',$counselor_id);
			}
		}

		$query->orderBy("update_at","desc");
		return $query->get();
	}

	private function isQueryPublicCustomer($state){
		return $state=='public';
	}


	/*
	 * 新增或者更新客户信息，
	 * 注：更新客户的时候，不更新客户的更新时间，只是修改客户信息不作为更新客户
	 * 如修改跟进记录才会记录更新时间
	 * 这里如果是经理去重新分配，会出现没有更新时间的问题，web页面也存在这个问题
	 * */
	public function save(){
		$counselor_id=Input::get("app_counselor_id");

		$arr=Input::get("data");
		if(isset($arr['id'])){
			$customer=Customer::find($arr['id']);
		}else{
			$customer=new Customer;
			$nowtime=new DateTime();
			$arr['register_id']=$counselor_id;
			$arr['register_at']=$nowtime;
			$arr['updater_id']=$counselor_id;
			$arr['update_at']=$nowtime;

		}
		$customer->fill($arr);

		//检查是否有重复的号码，防止数据的重复提交
		if($customer->isPhoneExist()){
			return  array(
					"result"=>false,
					"message"=>"保存失败,客户电话存在重复"
			);
		}

		//$customer->save();
		return  array(
				"result"=>true,
				"data"=>array("id"=>$customer->id)
		);
	}



}