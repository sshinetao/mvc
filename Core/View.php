<?php

namespace Core;

/**
 * Views
 *
 * PHP version 7.0
 */
class View {

	/**
	 * Render a view file
	 *
	 * @param string $view  The view file
	 * @param array $args  Associative array of data to display in the view (optional)
	 *
	 * @return void
	 */
	protected $variables = array();
	public function assign($name, $value) {
		$this->variables[$name] = $value;
	}
	public function render($view, $module) {

		//echo $_SERVER['QUERY_STRING'];
		//$router->dispatch($_SERVER['QUERY_STRING']);
		//echo MODULE . CONTROLLER . ACTION;
		//var_dump($router);

		extract($this->variables);
		$route = new Router();
		$file = dirname(__DIR__) . "/app/" . $module . "/views/" . $view . ".html"; // relative to Core directory

		if (is_readable($file)) {
			require $file;
		} else {
			throw new \Exception("$file not found");
		}
	}

	/**
	 * Render a view template using Twig
	 *
	 * @param string $template  The template file
	 * @param array $args  Associative array of data to display in the view (optional)
	 *
	 * @return void
	 */
	//echo MODULE . CONTROLLER . ACTION;
	public static function renderTemplate($template = ACTION . ".html", $args = []) {
		static $twig = null;

		if ($twig === null) {
			$loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . "/app/" . MODULE . "/views/" . CONTROLLER . "/");
			$twig = new \Twig_Environment($loader);
		}

		echo $twig->render($template, $args);
	}
	public static function getView() {
		$path = [dirname(__DIR__) . "/app/" . MODULE . "/views/" . CONTROLLER];
		$cachePath = dirname(__DIR__) . '/app/cache';
		$compiler = new \Xiaoler\Blade\Compilers\BladeCompiler($cachePath);
		$engine = new \Xiaoler\Blade\Engines\CompilerEngine($compiler);
		$finder = new \Xiaoler\Blade\FileViewFinder($path);
		$finder->addExtension('html');
		$factory = new \Xiaoler\Blade\Factory($engine, $finder);
		return $factory;
	}
}
