<?php
class PorjectpctController extends Controller{

	public function toList(){
		$sellProjectSet=S::sellProject();
		$projectPctSet=ProjectPct::all()->lists('percent','sellproject_id');;
		$this->addProjectpct($sellProjectSet,$projectPctSet);


		return View::make('projectpct.list')
 		->with('sellProjectSet',$sellProjectSet);
	}

	private function  addProjectpct(&$sellProjectSet,$projectPctSet){
		foreach ($sellProjectSet as &$sellProject){
			$sellProject["pct"]=0;
			$sellproject_id=$sellProject["id"];
			if(array_key_exists($sellproject_id, $projectPctSet)){
				$sellProject["pct"]=$projectPctSet[$sellproject_id];
			}

			$sellProject["param"]=http_build_query(array('id' =>urlencode($sellProject['id']),'name' =>urlencode($sellProject['name'])));
		}
	}

	public function toEdit(){
		$id=urldecode(Input::get('id'));
		$name=urldecode(Input::get('name'));
		$percent=0;
		$projectpct=ProjectPct::find($id);
		if($projectpct){
			$percent=$projectpct->percent;
		}
		return View::make('projectpct.edit')
		->with('id',$id)
		->with('name',$name)
		->with('percent',$percent);
	}

	public function  save(){
		$id=Input::get('id');
		$percent=Input::get('percent');
		$projectpct=ProjectPct::find($id);
		if($projectpct){
			$projectpct->percent=$percent;
		}else{
			$projectpct=new Projectpct;
			$projectpct->sellproject_id=$id;
			$projectpct->percent=$percent;
		}
		$projectpct->save();
		return Redirect::action('PorjectpctController@toList');
	}

}