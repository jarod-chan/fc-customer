<?php
class CustomerController  extends Controller {

	public function index($state){
		$query=Customer::where('state',$state);

		$type=trim(Input::get("type"));
		$key=trim(Input::get("key"));
		if($key!=''){
			$query->where($type,'like', '%'.$key.'%');
		}

		if(!$this->isQueryPublicCustomer($state)){
			if(C::isSale()){
				$query->where('counselor_id',C::counselorId());
			}
		}

		$query->orderBy("update_at","desc");
		$customerSet=$query->get();

	 	return View::make('customer.index')
		->with('customerSet',$customerSet)
	 	->with('state',$state)
	 	->with('type',$type)
	 	->with('key',$key);
	}

	private function isQueryPublicCustomer($state){
		return $state=='public';
	}

	public function  toAdd(){
		$counselorSet=Counselor::orderBy("id")
			->lists('name','id');
		$stateSet=Customer::stateEnums();

		$counselor_id=Session::get("counselor_id");
		$counselor=Counselor::find($counselor_id);

		return View::make('customer.add')
		->with('counselorSet',$counselorSet)
		->with('stateSet',$stateSet)
		->with('counselor',$counselor);
	}

	public function save(){
		$counselor_id=Session::get("counselor_id");
		$arr=Input::all();
		$nowtime=new DateTime();

		$customer=new Customer;
		$arr['register_id']=$counselor_id;
		$arr['register_at']=$nowtime;
		$arr['updater_id']=$counselor_id;
		$arr['update_at']=$nowtime;
		$customer->fill($arr);

		//检查是否有重复的号码，防止数据的重复提交
		if($customer->isPhoneExist()){
			Session::flash('message', '保存失败,客户手机存在重复');
			return Redirect::to('customer/add')->withInput();
		}

		$customer->save();
		Session::flash('message', '保存成功');
		return Redirect::action('CustomerController@toEdit', array('id'=>$customer->id));
	}

	public function toEdit($id){
		$customer=Customer::find($id);

		$counselorSet=Counselor::orderBy("id")
		->lists('name','id');
		$stateSet=Customer::stateEnums();

		return View::make('customer.edit')
		->with('customer',$customer)
		->with('counselorSet',$counselorSet)
		->with('stateSet',$stateSet);
	}

	public function update(){
		$counselor_id=Session::get("counselor_id");
		$customer=Customer::find(Input::get("id"));
		$arr=Input::all();
		$customer->fill($arr);

		//检查是否有重复的号码，防止数据的重复提交
		if($customer->isPhoneExist()){
			Session::flash('message', '保存失败,客户手机存在重复');
			return Redirect::to('customer/'.$customer->id.'/edit')->withInput();
		}

		$customer->save();
		Session::flash('message', '保存成功');
		return Redirect::action('CustomerController@toEdit', array('id'=>$customer->id));
	}
}