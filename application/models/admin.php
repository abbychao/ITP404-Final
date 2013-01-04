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
				'edit_multiple' => FALSE,
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
			Admin::logout();
		}
	}

	public static function logout() {
		$_SESSION['loggedin'] = false;
		$_SESSION['admin'] = array(
			'add' => FALSE,
			'edit' => FALSE,
			'delete' => FALSE,
			'edit_users' => FALSE,
			'edit_multiple' => FALSE,
			'edit_structure' => FALSE
		);
	}

	public static function setAdmin() {
		$_SESSION['admin'] = array(
			'add' => true,
			'edit' => true,
			'delete' => true,
			'edit_users' => true,
			'edit_multiple' => true,
			'edit_structure' => true
		);
	}

	public static function setMember() {
		$_SESSION['admin'] = array(
			'add' => true,
			'edit' => true,
			'delete' => false,
			'edit_users' => false,
			'edit_multiple' => false,
			'edit_structure' => false
		);
	}

	public static function getTransitionHTML($data) {
		$content = "
			<div id='transition'>
				<form action='".URL::to('home/transition')."' method='post'>
				<input type='hidden' name='grad_sem_id' value='".$data['grad_sem_id']."'>
				<input type='hidden' name='grad_year' value='".$data['grad_year']."'>
				<input type='submit' value='Transition to Alumni'>
				</form>
			</div>
		";
		return $content;
	}

}