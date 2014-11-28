<?php
class CounselorController extends Controller{

	public function  toList(){
		$counselorList=Counselor::orderBy('id','desc')
		->get();
		return View::make('counselor.list')
		->with('counselorList',$counselorList);
	}

	public function  toAdd(){
		$counselor=new Counselor;
		return View::make('counselor.edit')
		->with('counselor',$counselor);
	}

	public function  toEdit($id){
		$counselor=Counselor::find($id);
		return View::make('counselor.edit')
		->with('counselor',$counselor);
	}

	public function save(){
		$arr=Input::all();
		if(Input::has("id")){
			$counselor=Counselor::find(Input::get("id"));
		}else{
			$counselor=new Counselor;
		}

		$counselor->fill($arr);
		$counselor->save($arr);
		return Redirect::action('CounselorController@toList');
	}

}