<?php

namespace controllers\ajax;

\System::useModel('branch');

use models\Branch;

class index {

	function __construct(){
		if(!\Session::is_auth() || !isset($_GET['hash']) || $_GET['hash'] != $_SESSION['hash']){
			header('HTTP/1.1 401 Unauthorized');
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode("Not authorized");
			exit;
		}
	}

	public function main(){
		$act = $_GET['act'];

		$result = [
			'success' => true,
		];

		if($act == 'new' && isset($_GET['id'])){
			$id = Branch::add($_GET['id']);

			if($id)
				$result['id'] = $id;

			else
				$result['success'] = false;
		}

		elseif($act == 'del' && isset($_GET['id'])){
			$res = Branch::del($_GET['id']);

			if(!$res)
				$result['success'] = false;
		}

		elseif($act == 'edit' && isset($_GET['id'], $_GET['name'], $_GET['value'])){
			$id = $_GET['id'];

			if($_GET['value'] == 'null')
				$_GET['value'] = null;

			$res = Branch::edit($id, $_GET['name'], $_GET['value']);

			if(!$res)
				$result['success'] = false;
		}

		else
			$result['success'] = false;

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
		exit;
	}
}