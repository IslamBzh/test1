<?php

use Config\GlobalConf as gConf;

class TemplateMaster {

	const DIR = MAIN_DIR . '/templates/';

	public $app;

	public function __construct($app){

		$this->setApp($app);
	}

	public function setApp($app){
		$this->app = $app;

		return $this;
	}

	public function loadPopup($path, $data){
		if(!file_exists(self::DIR . $path))
			return null;

		extract($data, EXTR_OVERWRITE);

		require self::DIR . $path;
	}

	public function loadPage($page, $data, $title = gConf::SITE_NAME){
		if(self::has($this->getPath($page)))
			return print("not found " . $this->getPath($page));

		if(isset($data['_title']))
			$title = $data['_title'];

		else
			$data['_title'] = $title;

		ob_start();

			extract($data, EXTR_OVERWRITE);
			require $this->getPath($page);

		$content = ob_get_clean();

		unset($page, $data);

		require self::DIR . '/' . $this->app . '/layouts/' . '/index.php';

		exit();
	}

	public function has($page) {

		return file_exists($this->getPath($page));
	}

	private function getPath($page){

		return self::DIR . $this->app . '/views/' . $page . '.phtml';
	}


}