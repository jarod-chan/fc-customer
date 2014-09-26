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

	public function toAdd($customer_id){
		$purposeroom=new Purposeroom;
		return View::make('purposeroom.edit')
		->with('customer_id',$customer_id)
		->with('purposeroom',$purposeroom);
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
		return View::make('purposeroom.edit')
		->with('customer_id',$customer_id)
		->with('purposeroom',$purposeroom);
	}

	public function delete($customer_id,$id){
		Purposeroom::destroy($id);
		return Redirect::action('PurposeroomController@toList', array('customer_id'=>$customer_id));
	}

}