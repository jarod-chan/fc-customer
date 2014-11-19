<?php
class LoginController extends Controller{

	public function index()
	{
		if (C::isLogin()) {
			return Redirect::to('counselor/list');
		}
		return Redirect::to('login');
	}

	public function login()
	{

		return View::make('login.login');
	}

	public function loginPost(){

		$name = Input::get('name');
		$password = Input::get('password');

		$credentials = array('name' => $name, 'password' => $password);
		$password = Hash::make('secret');

		if($this->isAdmin($credentials))
		{
			Session::put('is_login',true);
			return Redirect::to('counselor/list');
		}
		else
		{
			Session::flash('message', '用户名或者密码错误！');
			return Redirect::action('LoginController@login');
		}
	}

	private function isAdmin($credentials){
		return $credentials['name']=='admin'&& $credentials['password']='$2y$10$dQ9JsW5dYpAXEhTaNyvJ4O8pQLF/d3Njp4H5mMtFIkYiOXZkFgiLu';
	}

	public function logout(){
		Session::forget('is_login');
		return Redirect::to('login');
	}
}