<?php

class Home_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public function action_index() {
		session_start();
		Linkedin::start();

		$_SESSION['linkedin']->getProfileById(2);
		// Linkedin::updateAllProfiles();
		$input = Input::all();
		$query = null;

		// If directed from search page, display results
		if(!isset($input['from_search'])) {
			$roster = Roster::all();
		}
		else {
			$roster = Roster::getByQuery($input);
			$query = Roster::formatInput($input);
		}
		if(isset($input['oauth_verifier']) && !$_SESSION['linkedin']->loggedin) {
			$_SESSION['linkedin']->validate($input['oauth_verifier']);
		}

		$data = array(
			'query' => $query,
			'results' => $roster,
			'loggedin' => $_SESSION['linkedin']->loggedin,
			'login_url' => $_SESSION['linkedin']->getAuthURL()
		);

		return View::make('home.index', $data);
	}

	public function action_add() {
		session_start();
		$data = array(
			'options' => Roster::getOptions()
		);
		return View::make('home.add', $data);
	}

	public function action_added() {
		session_start();
		Roster::add(Input::all());
		$data = array(
			'input' => Input::all()
		);
		return View::make('home.added', $data);
	}

	public function action_edit() {
		session_start();
		$data = array(
			'bro' => Roster::getBrother($_REQUEST['bro_id']),
			// 'input' => Input::all(),
			'options' => Roster::getOptions()
		);
		return View::make('home.edit', $data);
	}

	public function action_edited() {
		session_start();
		Roster::edit(Input::all());
		$data = array('input' => Input::all());
		return View::make('home.edited', $data);
	}

	public function action_delete() {
		session_start();
		$data = array('name' => Roster::getNameById($_REQUEST['bro_id']));
		Roster::delete($_REQUEST['bro_id']);
		return View::make('home.delete', $data);
	}

	public function action_search() {
		session_start();
		$data = array('options' => Roster::getOptions());
		return View::make('home.search', $data);
	}

}