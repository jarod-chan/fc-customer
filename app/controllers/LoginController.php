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

		$password = Hash::make($password);
		$credentials = array('name' => $name, 'password' => $password);

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
		return $credentials['name']==Config::get('app.admin')
		&& Hash::check(Config::get('app.password'), $credentials['password']);
	}

	public function logout(){
		Session::forget('is_login');
		return Redirect::to('login');
	}
}