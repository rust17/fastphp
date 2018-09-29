<?php

namespace app\Controllers;

use framework\base\Controller;
use app\models\UserModel;

class UsersController extends Controller
{
	public function showLogin()
	{
		$this->assign('title', '管理员登录');
		$this->render();
	}

	public function login()
	{
		$data = $_POST;
		session_start();
		$username = $data['username'];
		$password = $data['password'];
		
		if ($username == 'admin' && $password == '123456') {
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
		} else {
			echo "登录失败，<a href='/users/showLogin'>返回重试</a>";
			return;
		}
		echo "登录成功，<a href='/'>返回首页</a>";
		return;
	}

	public function logout()
	{
		session_start();
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		echo '退出成功，' . '<a href="/">返回首页</a>';
	}
}