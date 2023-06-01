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
		if(isset($_POST['new'], $_POST['hash'])
			&& $_POST['hash'] == $_SESSION['hash']
			&& isset($_POST['name'], $_POST['description'], $_POST['parent_id'])
		)
			Branch::new($_POST['parent_id'], $_POST['name'], $_POST['description']);

		if(isset($_POST['edit'], $_POST['edit_hash'], $_POST['id'])
			&& $_POST['edit_hash'] == md5($_SESSION['hash'] . $_POST['id'])
			&& isset($_POST['name'], $_POST['description'], $_POST['parent_id'])
		)
			Branch::edit($_POST['id'], $_POST['parent_id'], $_POST['name'], $_POST['description']);


		$branchs = Branch::getAll();

		return [
			'branchs' => $branchs,
			'_title' => "Редактирование"
		];
	}
}