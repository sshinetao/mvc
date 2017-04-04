<?php

namespace Core;

/**
 * Base controller
 *
 * PHP version 7.0
 */

abstract class Controller {

	/**
	 * Parameters from the matched route
	 * @var array
	 */
	protected $route_params = [];

	/**
	 * Class constructor
	 *
	 * @param array $route_params  Parameters from the route
	 *
	 * @return void
	 */
	public function __construct($route_params) {

        $this->route_params = $route_params;
		$this->view = new View();
	}
	protected function assign($name, $value = '') {
		$this->view->assign($name, $value);
		return $this;
	}
	protected function render($templateFile = '',$modulename='Home') {
		$this->view->render($templateFile,$modulename);
	}

    protected function success($message='',$url=''){
	    $url==''?$_SERVER["HTTP_REFERER"]:$url;
        $this->assign('title', "操作成功！"); // 提示信息
        $this->assign('message', $message); // 提示信息
        $this->assign('jumpUrl', $url);
        $this->render('message');
    }
    protected function failure($message=''){
        $this->assign('title', "操作失败！"); // 提示信息
        $this->assign('error', $message); // 提示信息
       $this->assign('jumpUrl', "javascript:history.back(-1);");
        $this->render('message');
        /* echo "<SCRIPT LANGUAGE=\"JavaScript\">history.back(-1)</SCRIPT>";*/
    }
	/**
	 * Magic method called when a non-existent or inaccessible method is
	 * called on an object of this class. Used to execute before and after
	 * filter methods on action methods. Action methods need to be named
	 * with an "Action" suffix, e.g. indexAction, showAction etc.
	 *
	 * @param string $name  Method name
	 * @param array $args Arguments passed to the method
	 *
	 * @return void
	 */
	public function __call($name, $args) {
		$method = $name . 'Action';

		if (method_exists($this, $method)) {
			if ($this->before() !== false) {
				call_user_func_array([$this, $method], $args);
				$this->after();
			}
		} else {
			throw new \Exception("Method $method not found in controller " . get_class($this));
		}
	}

	/**
	 * Before filter - called before an action method.
	 *
	 * @return void
	 */

	protected function before() {
	}

	/**
	 * After filter - called after an action method.
	 *
	 * @return void
	 */
	protected function after() {
	}



}
