<?php

namespace app\Controllers;

use framework\base\Controller;
use app\models\NewsModel;
use Illuminate\Database\Capsule\Manager as Capsule;

class NewsController extends Controller
{
	public function index()
	{

		$news = Capsule::table('news')->get();

		// $news = (new NewsModel)->order(['id DESC'])->fetchAll();

		$this->assign('title', '新闻列表');
		$this->assign('news', $news);
		$this->render();
	}

	public function show($id)
	{
		$new = (new NewsModel())->where(["id = ?"], [$id])->fetch();

		$this->assign('title', '新闻详情');
		$this->assign('new', $new);
		$this->render();
	}

	public function create_and_edit($id = null)
	{
		session_start();
		if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
			echo "请先<a href='/users/showLogin'>登录</a>";
			return;
		}
		$new = (new NewsModel())->where(["id = ?"], [$id])->fetch();
		if ($new) {
			$this->assign('new', $new);
			$this->assign('title', '编辑新闻');
		} else {
			$this->assign('title', '添加新闻');
		}
		$token = md5('secrect');

		
		$_SESSION['token'] = $token;

		$this->assign('_csrf_token', $token);
		$this->render();
	}

	public function add_and_update()
	{
		$data = $_POST;
		session_start();
		$this->assign('title', '提示信息');
		if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
			$this->assign('msg', '请先登录');
			return $this->render();
		}
		if ($_SESSION['username'] != 'admin' && $_SESSION['password'] != '123456') {
			$this->assign('msg', '请先登录');
			return $this->render();
		}
		if (!$data || !isset($_SESSION['token'])) {
			$this->assign('msg', '添加失败');
			return $this->render();
		}
		$token = $_SESSION['token'];
		if ($token != md5('secrect')) {
			$this->assign('msg', '添加失败');
			return $this->render();
		}
		if (intval(strlen($data['news_title'])) < 3) {
			$return_url = isset($data['id']) ? "/news/create_and_edit/".$data['id'] : '/news/create_and_edit/';
			$this->assign('msg', '标题不能小于3个字符，<a href='.$return_url.'>返回</a>');
			return $this->render();
		}
		if (intval(strlen($data['news_body'])) < 3) {
			$this->assign('msg', '文章内容不能小于3个字符，<a href='.$return_url.'>返回</a>');
			return $this->render();
		}
		
		unset($data['_csrf_token']);
		unset($_SESSION['token']);
		$data['news_title'] = htmlspecialchars($data['news_title'], ENT_QUOTES);
		$data['news_body']  = htmlspecialchars($data['news_body'], ENT_QUOTES);
		
		if ($news_id = $data['id']) {
			$data['updated_at'] = date('Y-m-d H:i:s');
			(new NewsModel)->where(['id = :id'], [':id' => $news_id])->update($data);

			echo "修改成功，<a href='/'>返回首页</a>";
			return;
		} else {
			$data['user_id'] = 1;
			$data['created_at'] = date('Y-m-d H:i:s');
			unset($data['id']);

			$a = (new NewsModel)->add($data);
			echo "添加成功，<a href='/'>返回首页</a>";
			return;
		}
	}

	public function delete($id)
	{
		session_start();
		if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
			echo "请先<a href='/users/showLogin'>登录</a>";
			return;
		}

		$new = (new NewsModel())->where(["id = ?"], [$id])->fetch();
		if ($new) {
			(new NewsModel)->delete($id);
			echo "删除成功，<a href='/'>返回首页</a>";
			return;
		} else {
			echo "删除失败，新闻不存在，<a href='/'>返回首页</a>";
			return;
		}
		
	}
}