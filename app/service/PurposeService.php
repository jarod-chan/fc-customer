<?php
class PurposeService extends Controller {

	public function  index($customer_id){
		$purposeList=Purpose::where('customer_id',$customer_id)
		->orderBy('id','desc')
		->get();
		$this->formate($purposeList);
		return  $purposeList;
	}

	private  function  formate($purposeList){
		foreach ($purposeList as $purpose){
			$arr=array(
					'khjb'=>$purpose->name("khjb"),
					'yxqd'=>$purpose->name("yxqd"),
					'gfdj'=>$purpose->name("gfdj"),
					'zzlx'=>$purpose->name("zzlx"),
					'hxlx'=>$purpose->name("hxlx"),
					'jzfg'=>$purpose->name("jzfg"),
					'jzx'=>$purpose->name("jzx"),
					'yhld'=>$purpose->name("yhld"),
					'xqf'=>$purpose->name("xqf"),
			);
			$purpose["extension"]=$arr;
		}
	}

	public function save($customer_id){
		$counselor_id=Input::get("app_counselor_id");
		$arr=Input::get("data");
		if(isset($arr['id'])){
			$arr['updater_id']=$counselor_id;
			$arr['update_at']=new DateTime();
			$purpose=Purpose::find($arr["id"]);
		}else{
			$arr['customer_id']=$customer_id;
			$arr['creater_id']=$counselor_id;
			$arr['create_at']=new DateTime();
			$arr['updater_id']=$counselor_id;
			$arr['update_at']=new DateTime();
			$purpose=new Purpose;
		}

		$purpose->fill($arr);
		$purpose->save($arr);
		return array(
					"result"=>true,
					"data"=>array("id"=>$purpose->id)
		);
	}


	public function delete($customer_id,$id){
		$purpose=Purpose::find($id);
		if($purpose){
			$purpose->delete();
			return array("result"=>true);
		}
		return array("result"=>false,"message"=>"记录已经删除");
	}

}