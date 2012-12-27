<?php

class Message {
	public static function added($input) {
		$msg = "<h1>New Brother Added!</h1>";
		$msg .= "<p>".$input['fname'].' '.$input['lname']. " has been added.</p>";
		$msg .= "<a href=".URL::to('home/add').">Add Another.</a><br>";
		return $msg;
	}

	public static function edited($input) {
		$msg = '<h1>Updated Successfully!</h1><p>';
		if(!empty($input['fname'])) {
			$msg .= $input['fname'].' '.$input['lname'].' has';
		}
		else {
			$msg .= 'Selected records have';
		}
		$msg .= ' been edited.</p>';
		return $msg;
	}

	public static function deleted($id) {
		$msg = "<h1>Success!</h1><p>".Roster::getNameById($id)." has been deleted.</p>";
		return $msg;
	}

	public static function transitioned($input) {
		$msg = "<h1>Success!</h1><p>";
		$msg .= Roster::getSemById($input['grad_sem_id'])." ".$input['grad_year']." has been transitioned.</p>";
		return $msg;
	}
}

?>