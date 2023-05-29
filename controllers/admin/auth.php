<?php

namespace controllers\admin;

\System::useModel('auth');

use models\Auth as A;

class auth {

	public function main(){
		if(isset($_POST['logout'], $_POST['hash']) && $_POST['hash'] == $_SESSION['hash'])
			\Session::destroy();

		elseif(\Session::is_auth()){
			header('Location: /admin');
			exit;
		}

		if(isset($_POST['auth'], $_POST['username'], $_POST['password'])){
			$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
			$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

			if(A::pass_verify($username, $password)){
				\Session::start($username);
				header('Location: /admin');
				exit;
			}
		}

		return [
			'_title' => "Авторизация"
		];
	}
}