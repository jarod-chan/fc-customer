<?php
class SysparamController extends Controller{

	public function toList(){
		$sysparamSet=SysParam::allParams();
		$paramVal=SysParam::all()->lists('value','key');
		$this->addValueToSet($sysparamSet,$paramVal);
		return View::make('sysparam.list')
		->with('sysparamSet',$sysparamSet);
	}

	private function addValueToSet(&$sysparamSet,$paramVal){
		foreach ($sysparamSet as &$sysparam){
			$key=$sysparam['key'];
			if(array_key_exists($key,$paramVal)){
				$sysparam['value']=$paramVal[$key];
			}else {
				$sysparam['value']='';
			}
		}
	}

	public function toEdit($key){
		$sysparam=SysParam::find($key);
		if(!$sysparam){
			$sysparam=new SysParam;
			$sysparam->key=$key;
		}
		return View::make('sysparam.edit')
		->with('sysparam',$sysparam);
	}

	public function  save(){
		$key=Input::get('key');
		$arr=Input::all();
		$sysparam=SysParam::find($key);
		if(!$sysparam){
			$sysparam=new SysParam;
		}
		$sysparam->fill($arr);
		$sysparam->save();
		Session::flash('message', '保存成功');
		return Redirect::action('SysparamController@toList');
	}

}