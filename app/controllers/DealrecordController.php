<?php
class DealrecordController extends Controller{

	public function  toList($customer_id){
		$dealrecordList=Dealrecord::where('customer_id',$customer_id)
		->orderBy('id','desc')
		->get();
		return View::make('dealrecord.list')
		->with('dealrecordList',$dealrecordList)
		->with('customer_id',$customer_id);
	}

	public function toAdd($customer_id){
		$dealrecord=new Dealrecord;
		$view=View::make('dealrecord.edit')
		->with('customer_id',$customer_id)
		->with('dealrecord',$dealrecord);

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
			$dealrecord=Dealrecord::find(Input::get("id"));
		}else{
			$arr['customer_id']=$customer_id;
			$arr['creater_id']=$counselor_id;
			$arr['create_at']=new DateTime();
			$arr['updater_id']=$counselor_id;
			$arr['update_at']=new DateTime();
			$dealrecord=new Dealrecord;
		}

		$dealrecord->fill($arr);
		$dealrecord->save($arr);
		return Redirect::action('DealrecordController@toList', array('customer_id'=>$customer_id));
	}

	public function toEdit($customer_id,$id){
		$dealrecord=Dealrecord::find($id);
		$view=View::make('dealrecord.edit')
		->with('customer_id',$customer_id)
		->with('dealrecord',$dealrecord);

		$room=$dealrecord->room();
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
		Dealrecord::destroy($id);
		return Redirect::action('DealrecordController@toList', array('customer_id'=>$customer_id));
	}
}