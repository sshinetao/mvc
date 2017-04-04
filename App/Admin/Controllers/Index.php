<?php

namespace App\Admin\Controllers;

/**
 * Home controller
 *
 * PHP version 7.0
 */
use \Core\View;
use Gregwar\Captcha\CaptchaBuilder;

class Index extends \Core\Controller {

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction() {

        $User = new \App\Models\User();
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
        $this->render('Index/index','Admin');
    }

    public function buildCaptcha(){

        ob_clean();
        $builder = new CaptchaBuilder;
        $builder->build();
        $_SESSION['phrase'] = $builder->getPhrase();
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-type: image/jpeg');
        $builder->output();
    }


    public function test(){

        if($_SESSION['phrase']==$_POST['code']){
            echo 1;

        }
        else {
            echo 0;
        }
    }
}
