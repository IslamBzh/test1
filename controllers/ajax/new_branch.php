<?php

namespace controllers\ajax;

use System;

System::useModel('branch');

use models\Branch;
use TemplateMaster;

class new_branch {

	function __construct(){
		if(!\Session::is_auth() || !isset($_GET['hash']) || $_GET['hash'] != $_SESSION['hash']){
			header('HTTP/1.1 401 Unauthorized');
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode("Not authorized");
			exit;
		}
	}

	function main(){
		if(isset($_GET['parent_id'])){
			$parent_id = $_GET['parent_id'];

            include TemplateMaster::DIR . '/admin/views/popup/new_branch.phtml';

            exit;
		}

		if(isset($_POST['new'], $_POST['name'], $_POST['description'], $_POST['parent_id'])){
			Branch::new($_POST['parent_id'], $_POST['name'], $_POST['description']);
			System::redirect('/admin');
		}
	}
}