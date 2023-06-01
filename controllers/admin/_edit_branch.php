<?php

namespace controllers\admin;

\System::useModel('branch');

use models\Branch;

class _edit_branch {

	function __construct(){
		if(!\Session::is_auth()){
			header('HTTP/1.1 401 Unauthorized');
			header('Location: /admin/auth');
			exit;
		}
	}

	function main(){

	}

}