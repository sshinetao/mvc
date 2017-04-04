<?php

namespace App\Home\Controllers;

/**
 * Home controller
 *
 * PHP version 7.0
 */
use \Core\View;
use Gregwar\Captcha\CaptchaBuilder;
use Nette\Mail\Message;
use Nette\Mail\SmtpMailer;
class Index extends \Core\Controller {

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction() {

        $User = new \App\Home\Models\User();
        //分页
        $pagenum = isset($_GET['page']) ? $_GET['page'] : 1;
        $page_row =5; //每页显示条数
        $count = $User->count("account", '*');
        $start = ($pagenum - 1) * $page_row;
        $end = $page_row;

        $datas = $User ->select("account", '*', ["LIMIT" => ["$start", "$end"]]);
        $p = new \Core\Page($count, $page_row ,$pagenum,7);

        //$Page = new Page($total, 10);
        //$page = $page->showpage();
        $this->assign('list', $datas);
        $this->assign('getPages', $p->getPages());
        $this->assign('showPages', $p->showPages(1));
/*        $this->mail($p->showPages());*/
        $this->render('Index/index');

    }


}
