<?php

class System {

	public static function useModel($model){
		$path = MAIN_DIR . '/models/' . $model . '.php';

		if(file_exists($path))
			require_once $path;
	}

	public static function redirect($url){
		header('Location: ' . $url);
	}
}