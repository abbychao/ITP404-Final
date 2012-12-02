<?php

class Linkedin {
	private static $api_key = 'nrip06wg8d7p';
	private static $secret_key = 'yo0Jsuxbf7GgA1ra';
	private static $oauth_token = '97337796-4f7f-4bc9-9cbd-987399f9aa56';
	private static $oauth_secret = '73d7bf90-f1be-4998-8f25-6981970aa09b';
	public $oauth_verifier = null;

	public static function getAuthURL() {
		$consumer = new OAuth(static::$api_key, static::$secret_key);
		$request_url = 'https://api.linkedin.com/uas/oauth/requestToken';
		$callback_url = URL::to('home/index');
		$request_token = $consumer->getRequestToken($request_url, $callback_url);
		$url = 'https://api.linkedin.com/uas/oauth/authorize?oauth_token='.$request_token['oauth_token'];
		return $url;
	}

	public static function getProfileById($id, $oauth_verifier = null) {
		// Fill the keys and secrets you retrieved after registering your app
		$oauth = new OAuth(static::$api_key, static::$secret_key);
		$oauth->setToken(static::$oauth_token, static::$oauth_secret);
		$access_token_info = $oauth->getAccessToken('https://api.linkedin.com/uas/oauth/accessToken', '', $oauth_verifier);
	    if(!empty($access_token_info)) {
	        print_r($access_token_info);
	    } else {
	        print "Failed fetching access token, response was: " . $oauth->getLastResponse();
	    }
	    exit();

		$params = array();
		$headers = array();
		$method = OAUTH_HTTP_METHOD_GET;
		 
		// Specify LinkedIn API endpoint to retrieve your own profile
		$pub_prof_url = Roster::getBrother($id)->linkedin;
		$pub_prof_url = urlencode($pub_prof_url);
		$url = "http://api.linkedin.com/v1/people/url=$pub_prof_url";
		$url .= ":(first-name,last-name,headline,location:(name),industry,picture-url)";
		// dd($url);

		// By default, the LinkedIn API responses are in XML format. If you prefer JSON, simply specify the format in your call
		// $url = "http://api.linkedin.com/v1/people/~?format=json";

		// Make call to LinkedIn to retrieve your own profile
		$oauth->fetch($url, $params, $method, $headers);
		 
		$xmlString = $oauth->getLastResponse();
		$simpleXML = simplexml_load_string($xmlString);
		$results = array($simpleXML);
		$results = $results[0];
		Linkedin::updateProfile($id, $results);
		// dd($results);
		return $results;
	}

	public static function updateProfile($id, $details) {
		DB::table('roster')->where('bro_id','=', $id)
			->update(array(
				'headline' => $details->headline,
				'location' => $details->location->name,
				'industry' => $details->industry,
				'photo_url' => $details->{'picture-url'},
				'lnkd_updated' => time()
			));
	}

	public static function updateAllProfiles() {
		foreach (Roster::all() as $bro) {
			if(!empty(Roster::getBrother($bro->bro_id)->linkedin)) {
				Linkedin::getProfileById($bro->bro_id);
			}
		}
	}

}