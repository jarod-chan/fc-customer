<?php
class PurposeroomService extends Controller{

	public function  index($customer_id){
		$purposeroomList=Purposeroom::where('customer_id',$customer_id)
		->orderBy('id','desc')
		->get();
		$this->formate($purposeroomList);
		return $purposeroomList;
	}

	private  function  formate($purposeroomList){
		foreach ($purposeroomList as $purposeroom){
			$arr=array(
				"room"=>$purposeroom->room(),
				"level_name"=>$purposeroom->name('level')
			);
			$purposeroom["extension"]=$arr;
		}
	}

	public function save($customer_id){
		$counselor_id=Input::get("app_counselor_id");
		$arr=Input::get("data");

		if(isset($arr['id'])){
			$arr['updater_id']=$counselor_id;
			$arr['update_at']=new DateTime();
			$purposeroom=Purposeroom::find($arr['id']);
		}else{
			$arr['customer_id']=$customer_id;
			$arr['creater_id']=$counselor_id;
			$arr['create_at']=new DateTime();
			$arr['updater_id']=$counselor_id;
			$arr['update_at']=new DateTime();
			$purposeroom=new Purposeroom;
		}

		$purposeroom->fill($arr);
		$purposeroom->save($arr);

		return array(
				"result"=>true,
				"data"=>array("id"=>$purposeroom->id)
		);
	}

	public function delete($customer_id,$id){
		$purposeroom=Purposeroom::find($id);
		if($purposeroom){
			$purposeroom->delete();
			return array("result"=>true);
		}
		return array("result"=>false,"message"=>"记录已经删除");
	}

	public function roomSelectOption(){
		$room_id=Input::get("room_id");
		$arr=array();
		if($room_id){
			$room=S::roomInfoPurpose($room_id)[0];

			$sellprojectSet=S::sellProject();
			$arr['sellprojectSet']=$sellprojectSet;

			$buildingSet=S::building($room["projectid"]);
			$arr['buildingSet']=$buildingSet;

			$ret=S::buildingunit($room["buildingid"],'Onshow');
			if($ret["type"]=="unit"){
				$buildingunitSet=$ret['arr'];
				$arr['buildingunitSet']=$buildingunitSet;

				$roomSet=S::room($room["buildunitid"],'Onshow');
				$arr['roomSet']=$roomSet;
			}elseif ($ret["type"]=="room"){

				$roomSet=$ret['arr'];
				$arr['roomSet']=$roomSet;
			}

		}else{
			$sellprojectSet=S::sellProject();
			$arr['sellprojectSet']=$sellprojectSet;
		}

		return $arr;

	}


}