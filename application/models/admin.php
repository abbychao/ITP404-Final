<?php

class Admin {
	private static $password = 'may1922';

	public static function verifyPass($input) {
		if($input == getPassword()) {
			$_SESSION['admin'] = true;
		}
		else {
			$_SESSION['admin'] = false;
		}
		return $_SESSION['admin'];
	}

	public static function getPassword() {
		$results = DB::table('user')->where('username','=','admin')->get(array('password'));
		$password = $results[0]->password;
		return $password;
	}
}