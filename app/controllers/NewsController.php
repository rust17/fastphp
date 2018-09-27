<?php

namespace app\controllers;

use fastphp\base\Controller;
use app\models\NewModel;

class NewsController extends Controller
{
	public function index()
	{
		$news = (new NewModel)->where()->order(['id DESC'])->fetchAll();

		$this->assign('title', '新闻列表');
		$this->assign('news', $news);
		$this->render();
	}
}