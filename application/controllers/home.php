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
		// dd((bool)DB::table('roster')->where('family_id','=',13)->get());
		// Facebook::getInfoByUser('abbyc');
		session_start();
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

		$data = array(
			'query' => $query,
			'results' => $roster,
			'options' => Roster::getOptions()
		);

		return View::make('home.index', $data);
	}

	// Administrative & Account Functions
	public function action_login() {
		session_start();
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

		$data = array(
			'query' => $query,
			'results' => $roster,
			'options' => Roster::getOptions()
		);

		if(isset($input['logout'])) {
			Admin::logout();
		}
		if(isset($input['username']) && isset($input['pass'])) {
			Admin::login($input['username'], $input['pass']);
		}
		if($_SESSION['loggedin']) {
			return View::make('home.index', $data);
		} 
		else {
			return View::make('home.login', $data);
		}
	}

	public function action_help() {
		session_start();
		$data = array('options' => Roster::getOptions());
		return View::make('home.help',$data);
	}

	// Core Roster Functions
	public function action_add() {
		session_start();
		$data = array(
			'options' => Roster::getOptions()
		);
		return View::make('home.add', $data);
	}

	public function action_added() {
		session_start();

		$input = Input::all();
		// $rules = array(
		// 	'fname' => 'required',
		// 	'lname' => 'required',
		// 	'pc_year' => 'integer|between:1922,3000',
		// 	'grad_year' => 'integer|between:1922,3000',
		// 	'linkedin' => 'active_url'
		// );
		// $validation = Validator::make($input, $rules);
		// if($validation->fails()) {
		// 	return Redirect::to('home.add')->with_errors($validation);
		// }

		Roster::add($input);
		$data = array(
			'message' => Message::added($input),
			'options' => Roster::getOptions()
		);
		return View::make('home.message', $data);
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
		$input = Input::all();
		Roster::edit($input);
		$data = array(
			'message' => Message::edited($input),
			'options' => Roster::getOptions()
		);
		return View::make('home.message', $data);
	}

	public function action_edit_all() {
		session_start();
		$data = array(
			'results' => Roster::all(),
			'options' => Roster::getOptions()
		);

		return View::make('home.edit_all', $data);
	}

	public function action_edited_all() {
		session_start();
		$input = Input::all();
		Roster::editAll($input);
		$data = array(
			'message' => Message::edited($input),
			'options' => Roster::getOptions()
		);
		return View::make('home.message',$data);
	}

	public function action_delete() {
		session_start();
		$data = array(
			'message' => Message::deleted($_REQUEST['bro_id']),
			'options' => Roster::getOptions()
		);
		Roster::delete($_REQUEST['bro_id']);
		return View::make('home.message', $data);
	}

	public function action_search() {
		session_start();
		$data = array('options' => Roster::getOptions());
		return View::make('home.search', $data);
	}

	public function action_transition() {
		session_start();
		$input = Input::all();
		Roster::transitionByGradSem($input);
		$data = array(
			'message' => Message::transitioned($input),
			'options' => Roster::getOptions()
		);
		return View::make('home.message', $data);
	}

	public function action_view() {
		session_start();
		$bro_id = $_REQUEST['bro_id'];
		Linkedin::getProfileById($bro_id);
		$data = array(
			'bro' => Roster::getBrother($bro_id),
			'options' => Roster::getOptions()
		);
		return View::make('home.view', $data);
	}

	// Family Roster Functions
	public function action_edit_families() {
		session_start();
		$data = array('options' => Roster::getOptions());
		return View::make('home.edit_families', $data);
	}

	public function action_add_family() {
		session_start();
		$input = Input::all();
		Roster::addFamily($input['new_family_name']);
		$data = array(
			'message' => Message::familyAdded($input['new_family_name']),
			'options' => Roster::getOptions()
		);
		return View::make('home.message', $data);	
	}

	public function action_edit_family_names() {
		session_start();
		$input = Input::all();
		Roster::editFamilies($input);
		$data = array(
			'message' => Message::familiesEdited(),
			'options' => Roster::getOptions()
		);
		return View::make('home.message', $data);	
		}

	public function action_merge_families() {
		session_start();
		$input = Input::all();
		$family_name1 = Roster::getFamilyById($input[0]);
		$family_name2 = Roster::getFamilyById($input[1]);
		Roster::mergeFamilies($input[0], $input[1]);
		$data = array(
			'message' => Message::familiesMerged($family_name1, $family_name2),
			'options' => Roster::getOptions()
		);
		return View::make('home.message',$data);
	}

	// Additional Features & Areas of the Site
	public function action_map() {
		session_start();
		$data = array('options' => Roster::getOptions());
		return View::make('home.map', $data);
	}

	public function action_map_ajax() {
		echo json_encode(Roster::all());
	}

	public function action_family() {
		session_start();
		$data = array('options' => Roster::getOptions());
		return View::make('home.family', $data);
	}

	public function action_family_ajax() {
		echo json_encode(Family::getMembers($_REQUEST['family_id']));
	}

	public function action_bigbro_ajax() {
		echo json_encode(Roster::all());
	}

}