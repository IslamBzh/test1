<?php

namespace controllers\ajax;

\System::useModel('branch');

use models\Branch;
use TemplateMaster;

class edit_branch {

	function __construct(){
		if(!\Session::is_auth() || !isset($_GET['hash']) || $_GET['hash'] != $_SESSION['hash']){
			header('HTTP/1.1 401 Unauthorized');
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode("Not authorized");
			exit;
		}
	}

	function main(){
		if(isset($_GET['id']) && ($branch = Branch::getID($_GET['id']))){

            include TemplateMaster::DIR . '/admin/views/popup/edit_branch.phtml';

            exit;
		}
	}
}