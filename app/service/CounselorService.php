<?php
class CounselorService extends Controller{

	public function  query(){
		$counselorSet=Counselor::orderBy("id")
			->select('id', 'name')
			->get();
		return $counselorSet;
	}

	public function  counselor($id){
		return Counselor::find($id);
	}


}