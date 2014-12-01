<?php
class InrecordController extends Controller{

	public function  toList($customer_id){
		$inrecordList=Inrecord::where('customer_id',$customer_id)
		->orderBy('id','desc')
		->get();
		return View::make('inrecord.list')
		->with('inrecordList',$inrecordList)
		->with('customer_id',$customer_id);
	}

	public function toAdd($customer_id){
		$counselor_id=Session::get("counselor_id");
		$inrecord=new Inrecord;
		$inrecord->updater_id=$counselor_id;
		return View::make('inrecord.edit')
		->with('inrecord',$inrecord)
		->with('customer_id',$customer_id);
	}

	public function save($customer_id){
		$counselor_id=Session::get("counselor_id");
		$arr=Input::all();
		$customer_last_update=null;
		if(Input::has("id")){
			$arr['updater_id']=$counselor_id;
			$arr['update_at']=new DateTime();
			$inrecord=Inrecord::find(Input::get("id"));
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

		return Redirect::action('InrecordController@toList', array('customer_id'=>$customer_id));
	}

	public function toEdit($customer_id,$id){
		$inrecord=Inrecord::find($id);
		return View::make('inrecord.edit')
		->with('customer_id',$customer_id)
		->with('inrecord',$inrecord);
	}

	public function delete($customer_id,$id){
		Inrecord::destroy($id);
		//更新对应的客户更新时间
		$max_create_at=Inrecord::where('customer_id',$customer_id)->max('create_at');
		Customer::find($customer_id)->update(array('update_at' => $max_create_at));
		return Redirect::action('InrecordController@toList', array('customer_id'=>$customer_id));
	}

}