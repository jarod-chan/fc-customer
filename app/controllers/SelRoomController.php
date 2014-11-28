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
		$roomstatus=Input::get("roomstatus");
		return S::buildingunit($val,$roomstatus);
	}

	public function room(){
		$val=Input::get("val");
		$roomstatus=Input::get("roomstatus");
		return S::room($val,$roomstatus);
	}


}