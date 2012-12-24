<?php

class Admin {

	public static function start() {
		if(!isset($_SESSION['loggedin'])) {
			$_SESSION['loggedin'] = FALSE;
		}
		if(!isset($_SESSION['admin'])) {
			$_SESSION['admin'] = array(
				'add' => FALSE,
				'edit' => FALSE,
				'delete' => FALSE,
				'edit_users' => FALSE,
				'edit_structure' => FALSE
			);
		}
	}

	public static function login($username, $password) {
		$user = DB::table('user')->where('username','=',$username)->get();
		if(isset($user[0]) && $password == $user[0]->password) {
			$_SESSION['loggedin'] = true;
			if($username == 'admin') {
				Admin::setAdmin();
			} 
			if($username == 'dspphi') {
				Admin::setMember();
			}
		}
		else {
			$_SESSION['loggedin'] = false;
		}
	}

	public static function logout() {
		$_SESSION['loggedin'] = false;
	}

	public static function setAdmin() {
		$_SESSION['admin'] = array(
			'add' => true,
			'edit' => true,
			'delete' => true,
			'edit_users' => true,
			'edit_structure' => true
		);
	}

	public static function setMember() {
		$_SESSION['admin'] = array(
			'add' => true,
			'edit' => true,
			'delete' => false,
			'edit_users' => false,
			'edit_structure' => false
		);
	}

}