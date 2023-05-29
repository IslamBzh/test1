<?php

namespace models;

use DB;

class Auth {

	public static function pass_verify($username, $password){


		$sql = "
			SELECT *
			FROM `admins`
			WHERE
				username = :username
		";
		$bind = [
			'username' => $username
		];

		$res = DB::_exc_sql('admins', $sql, $bind, 'fetch');

		if(!isset($res[0]))
			return false;

		if(password_verify($password, $res[0]['password']))
			return true;

		return false;
	}
}