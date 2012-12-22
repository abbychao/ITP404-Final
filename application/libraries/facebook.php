<?php 

class Facebook {

	public static function getInfoByUser($username) {
		$fql = "SELECT name, username, pic, about_me, contact_email FROM user WHERE username = '$username'";
		$url = "http://graph.facebook.com/fql?q=".urlencode($fql);
		dd($url);
	}

	public static function getUserByQuery() {
		$fql = "abby chao";
		$url = "https://graph.facebook.com/search?q=".$fql."&type=user";
		dd($url);
	}
}

?>