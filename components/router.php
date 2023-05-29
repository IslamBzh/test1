<?php

class Router {

	public static $domain = '';
	public static $uri    = '';
	public static $page   = [];

	function __construct(){
		self::$uri = strpos($_SERVER['REQUEST_URI'], '?') === false
			? substr($_SERVER['REQUEST_URI'], 1)
			: substr($_SERVER['REQUEST_URI'], 1, strpos($_SERVER['REQUEST_URI'], '?') - 1);

		self::$page = explode('/', self::$uri);

		$this->run();
	}

	public function run(){
		if(self::$page == '404');

		$app = empty(self::$page[0])
			? 'user'
			: mb_strtolower(self::$page[0]);

		$ppage = empty(self::$page[1])
			? 'index'
			: mb_strtolower(self::$page[1]);

		$controller_path = MAIN_DIR . "/controllers/$app/$ppage.php";
		$controller_class = "\controllers\\$app\\$ppage";

		if(!file_exists($controller_path))
			return $this->e404('controller_path');

		require_once $controller_path;

		if(!class_exists($controller_class))
			return $this->e404('controller_class');

		$controller_obj = new $controller_class;

		if(!method_exists($controller_obj, 'main'))
			return $this->e404('controller_fn');

		$res = $controller_obj->main();

		if(is_array($res)){
			$tm = new TemplateMaster($app);
			$tm->loadPage($ppage, $res);
		}
	}

	public function e404($details = ''){
		exit('404: ' . $details);
	}
}