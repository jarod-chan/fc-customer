<?php
class FangyuanController extends Controller
{

	public function  toProject(){
		$projects=S::sellProject();
		$this->filterProjectosh($projects);
		return View::make('fangyuan.project')
		->with('projects',$projects);
	}

	//过滤掉系统里设置不显示的项目
	private function  filterProjectosh(&$sellProjectSet){

		$projectOshSet=ProjectOsh::all()->lists('onshow','sellproject_id');
		foreach ($sellProjectSet as $key=>$sellProject){
			$sellproject_id=$sellProject["id"];
			if(array_key_exists($sellproject_id, $projectOshSet)){
				if ($projectOshSet[$sellproject_id]==false) {
					 unset($sellProjectSet[$key]);
				}
			}

		}
	}

	public function  toRooms(){
		$projectid=Input::get("projectid");
		$projectname=Input::get("projectname");


		$httpClient=new HttpClient();
		$param=array("projectid"=>$projectid);
		$data=$httpClient->get('fangyuan',$param);

		$rooms=array();
		if (isset($data['rooms'])) {
			$rooms=$data['rooms'];
		}


		return View::make('fangyuan.rooms')
		->with('rooms',$rooms)
		->with('projectname',$projectname);
	}

}

