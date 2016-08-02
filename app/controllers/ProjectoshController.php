<?php
class ProjectoshController extends Controller{

	public function toList(){
		$sellProjectSet=S::sellProject();
		$projectOshSet=ProjectOsh::all()->lists('onshow','sellproject_id');
		$this->addProjectosh($sellProjectSet,$projectOshSet);


		return View::make('projectosh.list')
 		->with('sellProjectSet',$sellProjectSet);
	}

	private function  addProjectosh(&$sellProjectSet,$projectOshSet){
		foreach ($sellProjectSet as &$sellProject){
			$sellProject["osh"]=true;
			$sellproject_id=$sellProject["id"];
			if(array_key_exists($sellproject_id, $projectOshSet)){
				$sellProject["osh"]=$projectOshSet[$sellproject_id];
			}

		}
	}


	public function  doswitch(){
		$id=Input::get('id');
		$projectosh=ProjectOsh::find($id);
		if($projectosh){
			$projectosh->onshow = !$projectosh->onshow;
		}else{
			$projectosh=new ProjectOsh;
			$projectosh->sellproject_id=$id;
			$projectosh->onshow=false;
		}
		$projectosh->save();
		Session::flash('message', '操作成功');
		return Redirect::action('ProjectoshController@toList');
	}


}