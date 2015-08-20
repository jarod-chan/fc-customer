<?php
class SyenumService extends Controller {

	public function query(){
		$type_key=Input::get("type_key");
		return Syenum::where('type',$type_key)
			->select("key","name")
			->orderBy("sq")
			->get();
	}

}
