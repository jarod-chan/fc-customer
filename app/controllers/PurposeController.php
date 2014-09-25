<?php
class PurposeController extends Controller{

	public function  toList($customer_id){
		$purposeList=Purpose::where('customer_id',$customer_id)
		->orderBy('id','desc')
		->get();
		return View::make('purpose.list')
		->with('purposeList',$purposeList)
		->with('customer_id',$customer_id);
	}

	public function toAdd($customer_id){
		$purpose=new Purpose;
		return View::make('purpose.edit')
		->with('customer_id',$customer_id)
		->with('purpose',$purpose);
	}

	public function save($customer_id){
		$counselor_id=Session::get("counselor_id");
		$arr=Input::all();
		if(Input::has("id")){
			$arr['updater_id']=$counselor_id;
			$arr['update_at']=new DateTime();
			$purpose=Purpose::find(Input::get("id"));
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
		return Redirect::action('PurposeController@toList', array('customer_id'=>$customer_id));
	}

	public function toEdit($customer_id,$id){
		$purpose=Purpose::find($id);
		return View::make('purpose.edit')
		->with('customer_id',$customer_id)
		->with('purpose',$purpose);
	}

	public function delete($customer_id,$id){
		Purpose::destroy($id);
		return Redirect::action('PurposeController@toList', array('customer_id'=>$customer_id));
	}
}