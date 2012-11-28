<?php

class Linkedin {
	private static $api_key = 'nrip06wg8d7p';
	private static $secret_key = 'yo0Jsuxbf7GgA1ra';
	private static $oauth_token = '97337796-4f7f-4bc9-9cbd-987399f9aa56';
	private static $oauth_secret = '73d7bf90-f1be-4998-8f25-6981970aa09b';

	public static function getProfile() {
		// Fill the keys and secrets you retrieved after registering your app
		$oauth = new OAuth($api_key, $secret_key);
		$oauth->setToken($oauth_token, $oauth_secret);

		$params = array();
		$headers = array();
		$method = OAUTH_HTTP_METHOD_GET;
		 
		// Specify LinkedIn API endpoint to retrieve your own profile
		$url = "http://api.linkedin.com/v1/people/~";

		// By default, the LinkedIn API responses are in XML format. If you prefer JSON, simply specify the format in your call
		// $url = "http://api.linkedin.com/v1/people/~?format=json";

		// Make call to LinkedIn to retrieve your own profile
		$oauth->fetch($url, $params, $method, $headers);
		 
		echo $oauth->getLastResponse();
		$results = array();
		return $results;
	}
}