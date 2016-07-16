<?php
class CustomerController  extends Controller {

	private static $limit=50;

	public function index($state){
		$type=trim(Input::get("type"));
		if($type==""){
			$type='name';
		}
		$key=trim(Input::get("key"));

		$customerSet=$this->queryByParam($state);
		$offset=$this->getOffset($customerSet);


	 	return View::make('customer.index')
		->with('customerSet',$customerSet)
		->with('offset',$offset)
	 	->with('state',$state)
	 	->with('type',$type)
	 	->with('key',$key);
	}

	public function query($state){

		$customerSet=$this->queryByParam($state);
		$offset=$this->getOffset($customerSet);

		$data=array();
		foreach ($customerSet as $customer){
			//格式化备注字段
			$remark=$customer->remark;
			if (!H::IsNullOrEmptyString($remark)) {
				$remark="(".$remark.")";
			}else{
				$remark="";
			}

			$item=array(
				'id'=>$customer->id,
				'name'=>$customer->name,
				'remark'=>$remark,
				'update_at'=>$customer->update_at
			);


			array_push($data,$item);
		}

		return array(
			'offset'=>$offset,
			'data'=>$data
		);
	}

	private function queryByParam($state){
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

		$offset=Input::get("offset");
		if(!$offset||$offset<0){ $offset=0; };

		$query->orderBy("update_at","desc");
	    return $query->offset($offset)->take(self::$limit+1)->get();
	}

	private function isQueryPublicCustomer($state){
		return $state=='public';
	}


	private function getOffset($customerSet){
		$offset=Input::get("offset");
		if(!$offset||$offset<0){ $offset=0; }

		if(count($customerSet)>0 && $customerSet->count()==self::$limit+1){
			$customer=$customerSet->pop();
			return $offset+self::$limit;
		}else{
			return -1;
		}
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
			Session::flash('message', '保存失败,客户电话存在重复');
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
			Session::flash('message', '保存失败,客户电话存在重复');
			return Redirect::to('customer/'.$customer->id.'/edit')->withInput();
		}

		$customer->save();
		Session::flash('message', '保存成功');
		return Redirect::action('CustomerController@toEdit', array('id'=>$customer->id));
	}
}