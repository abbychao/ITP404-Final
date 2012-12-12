<?php

class Admin {
	public static function verifyPass($input) {
		if($input == Admin::getPassword()) {
			$_SESSION['admin'] = true;
		}
		else {
			$_SESSION['admin'] = false;
		}
		return $_SESSION['admin'];
	}

	private static function getPassword() {
		$results = DB::table('user')->where('username','=','admin')->get(array('password'));
		$password = $results[0]->password;
		return $password;
	}
}