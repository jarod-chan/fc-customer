<?php
class CPublicController extends Controller{

	public function index(){
		$query=Customer::where('state','public');
		if(C::isSale()){
			$query->where('counselor_id',C::counselorId());
		}
		$query->orderBy("update_at","desc");
		$customerSet=$query->get();
		return View::make('ccustomer.index')
		->with('customerSet',$customerSet);
	}

}