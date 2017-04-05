<?php

namespace App\Home\Controllers;

/**
 * Home controller
 *
 * PHP version 7.0
 */
use Core\View;

class Index extends \Core\Controller {

	/**
	 * Show the index page
	 *
	 * @return void
	 */
	public function indexAction() {

		//$this->render('Index/index');
		//View::renderTemplate("index.html");
		echo View::getView()->make('index', ['a' => 'success!'])->render();
	}

	public function datalist() {
		$User = new \App\Home\Models\User();
		//分页
		$pagenum = isset($_GET['page']) ? $_GET['page'] : 1;
		$page_row = 10; //每页显示条数
		$count = $User->count("account", '*');
		$start = ($pagenum - 1) * $page_row;
		$end = $page_row;

		$datas = $User->select("account", '*', ["LIMIT" => ["$start", "$end"]]);
		$p = new \Core\Page($count, 4, $pagenum, $page_row);

		//$Page = new Page($total, 10);
		//$page = $page->showpage();
		//$this->assign('list', $datas);
		$data['list'] = $datas;
		$data['showPages'] = $p->showPages(4);
		//$this->assign('getPages', $p->getPages());
		//$this->assign('showPages', $p->showPages(4));
		//$this->render('Index/list');
		View::renderTemplate("list.html", $data);

	}

}
