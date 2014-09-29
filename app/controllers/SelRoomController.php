<?php
class SelRoomController extends Controller{

	public function sellproject(){
		return S::sellProject();
	}

	public function building(){
		$val=Input::get("val");
		return S::building($val);
	}

	public function buildingunit(){
		$val=Input::get("val");
		return S::buildingunit($val);
	}

	public function room(){
		$val=Input::get("val");
		return S::room($val);
	}


}