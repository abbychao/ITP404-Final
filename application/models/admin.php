<?php

class Admin {
	private static $password = 'may1922';

	public static function verifyPass($input) {
		if($input == static::$password) {
			$_SESSION['admin'] = true;
		}
		else {
			$_SESSION['admin'] = false;
		}
		return $_SESSION['admin'];
	}

	public static function getPassword() {
		$query = DB::table('user')->get();
		return $query;
	}
}