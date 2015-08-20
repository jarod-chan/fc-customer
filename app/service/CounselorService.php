<?php
class CounselorService extends Controller{

	public function  query(){
		$counselorSet=Counselor::orderBy("id")
			->select('id', 'name')
			->get();
		return $counselorSet;
	}


}