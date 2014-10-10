<?php
class PurposeroomController extends Controller{

	public function  toList($customer_id){
		$purposeroomList=Purposeroom::where('customer_id',$customer_id)
		->orderBy('id','desc')
		->get();
		return View::make('purposeroom.list')
		->with('purposeroomList',$purposeroomList)
		->with('customer_id',$customer_id);
	}

	public function toAdd($customer_id){// $x=S::sellProject(); d($x); return;

		$purposeroom=new Purposeroom;
		$view=View::make('purposeroom.edit')
		->with('customer_id',$customer_id)
		->with('purposeroom',$purposeroom);

		$room=array();
		$room['fid']='';
		$room['fsellprojectid']='';
		$room['fbuildingid']='';
		$room['fbuildunitid']='';
		$view->with('room',$room);
		$sellprojectSet=H::toSet(S::sellProject());
		$view->with('sellprojectSet',$sellprojectSet);
		$view->with('buildingSet',null);
		$view->with('buildingunitSet',null);
		$view->with('roomSet',null);

		return $view;
	}

	public function save($customer_id){
		$counselor_id=Session::get("counselor_id");
		$arr=Input::all();
		if(Input::has("id")){
			$arr['updater_id']=$counselor_id;
			$arr['update_at']=new DateTime();
			$purposeroom=Purposeroom::find(Input::get("id"));
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
		return Redirect::action('PurposeroomController@toList', array('customer_id'=>$customer_id));
	}

	public function toEdit($customer_id,$id){
		$purposeroom=Purposeroom::find($id);

		$view=View::make('purposeroom.edit')
		->with('customer_id',$customer_id)
		->with('purposeroom',$purposeroom);

		$room=$purposeroom->room();
		if($room){
			$sellprojectSet=H::toSet(S::sellProject());
			$view->with('sellprojectSet',$sellprojectSet);

			$buildingSet=H::toSet(S::building($room["fsellprojectid"]));
			$view->with('buildingSet',$buildingSet);

			$ret=S::buildingunit($room["fbuildingid"]);
			if($ret["type"]=="unit"){
				$buildingunitSet=H::toSet($ret['arr']);
				$view->with('buildingunitSet',$buildingunitSet);

				$roomSet=H::toSet(S::room($room["fbuildunitid"]));
				$view->with('roomSet',$roomSet);
			}elseif ($ret["type"]=="room"){
				$view->with('buildingunitSet',null);

				$roomSet=H::toSet($ret['arr']);
				$view->with('roomSet',$roomSet);
			}

			$view->with("room",$room);
	   }

	   return $view;

	}

	public function delete($customer_id,$id){
		Purposeroom::destroy($id);
		return Redirect::action('PurposeroomController@toList', array('customer_id'=>$customer_id));
	}

}