<?php

class Linkedin {
	private static $api_key = 'nrip06wg8d7p';
	private static $secret_key = 'yo0Jsuxbf7GgA1ra';
	private static $oauth_token = 'e8e3a7e9-7e93-4874-a3cc-a023cf1d0ab4';
	private static $oauth_key = '50c9decd-446d-42a5-b1f1-3b4a1d47837b';
	private $request_token;
	private $access_token;
	public $oauth;
	// public $loggedin = FALSE;
/*
	public function __construct($api_key, $secret_key) {
		$this->oauth = new OAuth($api_key, $secret_key);
	}

	public static function start() {
		if(!isset($_SESSION['linkedin'])) {
			$_SESSION['linkedin'] = new Linkedin(static::$api_key, static::$secret_key);
		}
	}

	public function getAuthURL() {
		$request_url = 'https://api.linkedin.com/uas/oauth/requestToken';
		$callback_url = URL::to('home/index');
		if(isset($this->request_token)){
			$this->request_token = $this->oauth->getRequestToken($request_url, $callback_url);
		}
		$url = 'https://api.linkedin.com/uas/oauth/authorize?oauth_token='.$this->request_token['oauth_token'];
		return $url;
	}

	public function validate($oauth_verifier) {
		$oauth = new OAuth(static::$api_key, static::$secret_key);
		$oauth->setToken(
			$_SESSION['linkedin']->request_token['oauth_token'], 
			$_SESSION['linkedin']->request_token['oauth_token_secret']
		);

		$access_token_url = 'https://api.linkedin.com/uas/oauth/accessToken';
		$access_token_response = $oauth->getAccessToken($access_token_url, '', $oauth_verifier);
		 
		if($access_token_response === FALSE) {
		        throw new Exception("Failed fetching request token, response was: " . $oauth->getLastResponse());
		} else {
		        $this->access_token = $access_token_response;
		        $this->loggedin = TRUE;
		}
	}
	*/

	public static function getProfileById($id) {
		// Specify LinkedIn API endpoint to retrieve your own profile
		$pub_prof_url = Roster::getBrother($id)->linkedin;
		if($pub_prof_url == null) {
			return null;
		}
		$pub_prof_url = urlencode($pub_prof_url);
		$url = "http://api.linkedin.com/v1/people/url=$pub_prof_url";
		$url .= ":(first-name,last-name,headline,location:(name),industry,picture-url)";

		$oauth = new OAuth(static::$api_key, static::$secret_key);
		$oauth->setToken(static::$oauth_token, static::$oauth_key);

		$params = array();
		$headers = array();
		$method = OAUTH_HTTP_METHOD_GET;
		 
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

	private static function updateProfile($id, $details) {
		DB::table('roster')->where('bro_id','=', $id)
			->update(array(
				'headline' => $details->headline,
				'location' => $details->location->name,
				'industry' => $details->industry,
				'photo_url' => $details->{'picture-url'},
				'lnkd_updated' => time()
			));
	}

	// public static function updateAllProfiles() {
	// 	foreach (Roster::all() as $bro) {
	// 		if($bro->linkedin != null) {
	// 			Linkedin::getProfileById($bro->bro_id);
	// 		}
	// 	}
	// }

}