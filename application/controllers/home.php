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
		// echo Linkedin::getAuthURL();
		 Linkedin::getProfileById(3, $_REQUEST['oauth_verifier']);
		// Linkedin::updateAllProfiles();
		$input = Input::all();
		$query = null;

		// If directed from authentication flow, log keys
		if(isset($input['oauth_verifier'])) {
			$oauth_verifier = ($input['oauth_verifier']);
		}

		// If directed from search page, display results
		if(!isset($input['from_search'])) {
			$roster = Roster::all();
		}
		else {
			$roster = Roster::getByQuery($input);
			$query = Roster::formatInput($input);
		}

		$data = array(
			'query' => $query,
			'results' => $roster
		);

		return View::make('home.index', $data);
	}

	public function action_add() {
		$data = array(
			'options' => Roster::getOptions()
		);
		return View::make('home.add', $data);
	}

	public function action_added() {
		Roster::add(Input::all());
		$data = array(
			'input' => Input::all()
		);
		return View::make('home.added', $data);
	}

	public function action_edit() {
		$data = array(
			'bro' => Roster::getBrother($_REQUEST['bro_id']),
			// 'input' => Input::all(),
			'options' => Roster::getOptions()
		);
		return View::make('home.edit', $data);
	}

	public function action_edited() {
		Roster::edit(Input::all());
		$data = array('input' => Input::all());
		return View::make('home.edited', $data);
	}

	public function action_delete() {
		$data = array('name' => Roster::getNameById($_REQUEST['bro_id']));
		Roster::delete($_REQUEST['bro_id']);
		return View::make('home.delete', $data);
	}

	public function action_search() {
		$data = array('options' => Roster::getOptions());
		return View::make('home.search', $data);
	}

}