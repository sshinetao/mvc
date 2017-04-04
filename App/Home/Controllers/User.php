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
class User extends \Core\Controller {


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


    public function mail($data){

        $mail = new Message;
        $mail->setFrom('John <sshinetao@qq.com>')
            ->addTo('sshinetao@qq.com')
            ->addTo('sshinetao@qq.com')
            ->setSubject('Order Confirmation')
            ->setBody($data);

        $mailer = new  SmtpMailer([
            'host' => 'smtp.qq.com',
            'username' => 'sshinetao@qq.com',
            'password' => 'jgclsprublfyfhac'
        ]);
        $mailer->send($mail);
    }


    function login(){
    $this->render('Index/login');

}
    function register(){
        $this->render('Index/register');

    }
    function dologin(){
        $account =  new \App\Home\Models\User();

        if(!isset($_POST)){
            $this->failure( '请输入用户名和密码');
        }

        $datas =$account->select("account", "*", [
            "AND" => [
                "username" => $_POST['username'],
                "password" => md5($_POST['password'])
            ]
        ]);

        if(count($datas)>0){
            $_SESSION['username']=$datas[0]['username'];
            $this->success( '登陆成功！','?');
        }else{
            $this->failure( '用户名或密码错误');
        }

    }
    function logout(){
        session_unset();
        session_destroy();
        $_SESSION = array();
        if(count($_SESSION)==0){
            $this->success( '注销成功！','?');
        }else{
            $this->failure( '注销失败，请稍后再试','?');
        }
    }
}
