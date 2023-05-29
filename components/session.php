<?php

session_start();

class Session {

	public static function is_auth(){

		return isset($_SESSION['username'], $_SESSION['hash']);
	}

	public static function start($username){
		$time = time();

		$_SESSION = [
			'start' => $time,
			'username' => $username,
			'hash' => md5($_SERVER['HTTP_USER_AGENT'] . ':' . $_SERVER['REMOTE_ADDR'] . ":" . $time . ":" .	session_id()),
		];
	}

	public static function destroy(){
		$time = time();

		session_reset();
		$_SESSION = [
			'logout' => $time,
			'last_username' => @ $_SESSION['username'],
			'hash' => md5($_SERVER['HTTP_USER_AGENT'] . ':' . $_SERVER['REMOTE_ADDR'] . ":" . $time . ":" .	session_id()),
		];
	}
}