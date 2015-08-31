<?php
class DealrecordService extends Controller{

	public function  index($customer_id){
		$dealrecordList=Dealrecord::where('customer_id',$customer_id)
		->orderBy('id','desc')
		->get();
		$this->formate($dealrecordList);
		return $dealrecordList;
	}

	private  function  formate($dealrecordList){
		foreach ($dealrecordList as $dealrecord){
			$arr=array(
					"room"=>$dealrecord->room()
			);
			$dealrecord["extension"]=$arr;
		}
	}

	//只处理新增，无法修改，只能删除后重新添加
	public function save($customer_id){
		$counselor_id=Input::get("app_counselor_id");
		$arr=Input::get("data");

		$arr['customer_id']=$customer_id;
		$arr['creater_id']=$counselor_id;
		$arr['create_at']=new DateTime();
		$arr['updater_id']=$counselor_id;
		$arr['update_at']=new DateTime();
		$arr['state']='no';

		$dealrecord=new Dealrecord;
		$dealrecord->fill($arr);
		$room=$dealrecord->room();
		if($room){
			//保存客户的真实姓名
			$dealrecord->customer_name=$room['customer'];
			//计算初始化的佣金比率
			$dealrecord->doInitPercent($room);
		}else {
			$dealrecord->customer_name='';
		}
		$dealrecord->save();

		return array(
				"result"=>true,
				"data"=>array("id"=>$dealrecord->id)
		);
	}

	public function delete($customer_id,$id){
		$dealrecord=Dealrecord::find($id);
		if($dealrecord){
			DB::transaction(function() use ($id){
				Commission::where('dealrecord_id', $id)->delete();
				Dealrecord::destroy($id);
			});
			return array("result"=>true);
		}

		return array("result"=>false,"message"=>"删除出错");
	}

	//判断是否有佣金记录
	public function haveCommission($customer_id,$id){
		$count=Commission::where('dealrecord_id', $id)->count();
		if($count>0){
			return array("result"=>true);
		}
		return array("result"=>false);
	}


}