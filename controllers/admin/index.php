<?php

namespace controllers\admin;

\System::useModel('branch');

use models\Branch;

class index {

	function __construct(){
		if(!\Session::is_auth()){
			header('HTTP/1.1 401 Unauthorized');
			header('Location: /admin/auth');
			exit;
		}
	}

	public function main(){
		$branchs = Branch::getAll();

		return [
			'branchs' => $branchs,
			'_title' => "Редактирование"
		];
	}
}