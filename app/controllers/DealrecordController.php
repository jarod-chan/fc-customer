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

		$room=array('roomid'=>'','projectid'=>'','buildingid'=>'','buildunitid'=>'');
	   	$view->with('room',$room);

		$sellprojectSet=H::toSet(S::sellProject());
		$view->with('sellprojectSet',$sellprojectSet);
		$view->with('buildingSet',null);
		$view->with('buildingunitSet',null);
		$view->with('roomSet',null);

		return $view;
	}

	//只处理新增，无法修改，只能删除后重新添加
	public function save($customer_id){
		$counselor_id=Session::get("counselor_id");
		$arr=Input::all();

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
		return Redirect::action('DealrecordController@toList', array('customer_id'=>$customer_id));
	}

	public function toEdit($customer_id,$id){
		$dealrecord=Dealrecord::find($id);
		//判断是否存在佣金记录
		$hasCommission=true;
		if($dealrecord->commissions->isEmpty()){
			$hasCommission=false;
		}

		$room=$dealrecord->room();
		$dealrecord_id=$dealrecord->id;
		return View::make('dealrecord.view')
		->with('customer_id',$customer_id)
		->with('room',$room)
		->with('dealrecord_id',$dealrecord_id)
		->with('hasCommission',$hasCommission);
	}






	public function delete($customer_id,$id){
		DB::transaction(function() use ($id){
			Commission::where('dealrecord_id', $id)->delete();
			Dealrecord::destroy($id);
		});

		return Redirect::action('DealrecordController@toList', array('customer_id'=>$customer_id));
	}
}