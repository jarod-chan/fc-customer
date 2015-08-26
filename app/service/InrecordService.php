<?php
class InrecordService extends  Controller{

	/*
	 * 客户可能得状态
	* */
	public function typeEnums(){
		$states=Inrecord::typeEnums();
		return H::toArr($states);
	}

	public function  index($customer_id){
		$inrecordList=Inrecord::where('customer_id',$customer_id)
		->orderBy('id','desc')
		->get();
		$this->formate($inrecordList);
		return $inrecordList;
	}

	private  function  formate($inrecordList){
		foreach ($inrecordList as $inrecord){
			$arr=array(
					'updater_name'=>$inrecord->updater->name,
					'updater_date'=>H::fmt($inrecord->create_at),
					'type_name'=>$inrecord->getTypeName()
			);
			$inrecord["extension"]=$arr;
		}
	}

	public function save($customer_id){
		$counselor_id=Input::get("app_counselor_id");
		$arr=Input::get("data");

		$customer_last_update=null;
		if(isset($arr['id'])){
			$arr['updater_id']=$counselor_id;
			$arr['update_at']=new DateTime();
			$inrecord=Inrecord::find($arr['id']);
		}else{
			$arr['customer_id']=$customer_id;
			$arr['creater_id']=$counselor_id;
			$arr['create_at']=new DateTime();
			$arr['updater_id']=$counselor_id;
			$arr['update_at']=new DateTime();
			$inrecord=new Inrecord;

			$customer_last_update=$arr['create_at'];
		}

		$inrecord->fill($arr);
		$inrecord->save($arr);

		if($customer_last_update){
			//更新对应的客户更新时间
			$customer=Customer::find($customer_id);
			$customer->update(array('update_at' => $customer_last_update));
			//如果是公共客户，则把它更新为当前的顾问的意向客户
			if($customer->state=='public'){
				$customer->update(array('state' =>'purpose','counselor_id'=>$counselor_id));
			}
		}

		return array(
				"result"=>true,
				"data"=>array("id"=>$inrecord->id)
		);
	}

	public function delete($customer_id,$id){
		$inrecord=Inrecord::find($id);
		if($inrecord){
			$inrecord->delete();
			//更新对应的客户更新时间
			$max_create_at=Inrecord::where('customer_id',$customer_id)->max('create_at');
			Customer::find($customer_id)->update(array('update_at' => $max_create_at));
			return array("result"=>true);
		}
		return array("result"=>false,"message"=>"记录已经删除");
	}

}