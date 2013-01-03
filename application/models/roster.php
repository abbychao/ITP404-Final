<?php

class Roster {
	public static function all() {
		/*
		$results = DB::table('roster')->get();
		return $results;
		*/
		
		$query = DB::table('roster')
			->join('family','roster.family_id','=','family.family_id')
			->join('status','roster.status_id','=','status.status_id')
			->join('semester AS grad_sem','roster.grad_sem_id', '=', 'grad_sem.semester_id')
			->join('semester AS pc_sem', 'roster.pc_sem_id', '=', 'pc_sem.semester_id')
			->order_by('status_id','asc')
			->order_by('bro_lname', 'asc');
			// ->get();

		$results = $query->get(array('roster.*','family_name','status_name',
			'grad_sem.semester_name AS grad_sem','pc_sem.semester_name AS pc_sem'));

		return $results;
		/*
		SELECT roster.*, family.family_name, status.status_name, 
		grad_sem.semester_name AS grad_sem_name, pc_sem.semester_name AS pc_sem_name
		FROM roster, family, status, semester AS grad_sem, semester AS pc_sem
		WHERE roster.family_id = family.family_id
		AND roster.status_id = status.status_id
		AND roster.grad_sem_id = grad_sem.semester_id
		AND roster.pc_sem_id = pc_sem.semester_id

		Alternate Syntax
		SELECT roster.*, family.family_name, status.status_name, 
		grad_sem.semester_name AS grad_sem_name, pc_sem.semester_name AS pc_sem_name
		FROM roster
		INNER JOIN family
		ON roster.family_id = family.family_id
		INNER JOIN status
		ON roster.status_id = status.status_id
		INNER JOIN semester AS grad_sem
		ON roster.grad_sem_id = grad_sem.semester_id
		INNER JOIN semester AS pc_sem
		ON roster.pc_sem_id = pc_sem.semester_id

		*/
	}

	public static function getByQuery($data) {
		$sql = 'SELECT roster.*, family.family_name, status.status_name, 
		grad_sem.semester_name AS grad_sem, pc_sem.semester_name AS pc_sem
		FROM roster, family, status, semester AS grad_sem, semester AS pc_sem
		WHERE roster.family_id = family.family_id
		AND roster.status_id = status.status_id
		AND roster.grad_sem_id = grad_sem.semester_id
		AND roster.pc_sem_id = pc_sem.semester_id';

		// Adding Search Clauses
		if(!empty($data['fname'])) {
			$sql .= ' AND roster.bro_fname LIKE "%'.$data['fname'].'%"';
		}
		if(!empty($data['lname'])) {
			$sql .= ' AND roster.bro_lname LIKE "%'.$data['lname'].'%"';
		}
		if(!empty($data['grad_sem_id'])) {
			$sql .= ' AND roster.grad_sem_id = '.$data['grad_sem_id'];
		}
		if(!empty($data['grad_year'])) {
			$sql .= ' AND roster.grad_year LIKE "%'.$data['grad_year'].'%"';
		}
		if(!empty($data['pc_sem_id'])) {
			$sql .= ' AND roster.pc_sem_id = '.$data['pc_sem_id'];
		}
		if(!empty($data['pc_year'])) {
			$sql .= ' AND roster.pc_year LIKE "%'.$data['pc_year'].'%"';
		}
		if(!empty($data['bigbro_id'])) {
			$sql .= ' AND roster.bigbro_id = '.$data['bigbro_id'];
		}
		if(!empty($data['family_id']) && $data['family_id'] != 1) {
			$sql .= ' AND roster.family_id = '.$data['family_id'];
		}
		if(!empty($data['status_id'])) {
			$sql .= ' AND roster.status_id = '.$data['status_id'];
		}
		if(!empty($data['industry'])) {
			$sql .= ' AND roster.industry = "'.$data['industry'].'"';
		}
		if(!empty($data['location'])) {
			$sql .= ' AND roster.location = "'.$data['location'].'"';
		}

		// from master search form... does not find big bros
		if(!empty($data['query'])) {
			$terms = explode(' ',$data['query']);
			foreach ($terms as $term) {
				$sql .= ' AND (roster.bro_fname LIKE "%'.$term.'%"';
				$sql .= ' OR roster.bro_lname LIKE "%'.$term.'%"';
				$sql .= ' OR grad_sem.semester_name LIKE "%'.$term.'%"';
				$sql .= ' OR roster.grad_year LIKE "%'.$term.'%"';
				$sql .= ' OR pc_sem.semester_name LIKE "%'.$term.'%"';
				$sql .= ' OR roster.pc_year LIKE "%'.$term.'%"';
				$sql .= ' OR family.family_name LIKE "%'.$term.'%"';
				$sql .= ' OR status.status_name LIKE "%'.$term.'%"';
				$sql .= ' OR roster.industry LIKE "%'.$term.'%"';
				$sql .= ' OR roster.location LIKE "%'.$term.'%")';
			}

		}

		$sql .= ' ORDER BY status_id ASC, bro_lname ASC';
		$results = DB::query($sql);
		return $results;
	}

	public static function getBrother($id) {
		if($id == 0) {
			return null;
		}

		$query = DB::table('roster')
			->join('family','roster.family_id','=','family.family_id')
			->join('status','roster.status_id','=','status.status_id')
			->join('semester AS grad_sem','roster.grad_sem_id', '=', 'grad_sem.semester_id')
			->join('semester AS pc_sem', 'roster.pc_sem_id', '=', 'pc_sem.semester_id')
			->where('bro_id','=', $id);
			// ->get();

		$results = $query->get(array('roster.*','family_name','status.status_id','status_name',
			'grad_sem.semester_name AS grad_sem','pc_sem.semester_name AS pc_sem'));
		$results = $results[0];
		return $results;
	}

	// public static function getUnlinkedBros() {
	// 	$all = Roster::all();
	// 	$results = array();
	// 	foreach ($all as $bro) {
	// 		if(empty($bro->linkedin)) {
	// 			array_push($results, $bro);
	// 		}
	// 	}
	// 	return $results;
	// }

	public static function getNameById($id) {
		$bro = Roster::getBrother($id);
		if(empty($bro)) {
			return null;
		}
		return $bro->bro_fname.' '.$bro->bro_lname;
	}

	public static function getSemById($id) {
		if($id == null) {return null;}
		$results = DB::table('semester')->where('semester_id','=',$id)->get(array('semester_name'));
		$results = $results[0]->semester_name;
		return $results;
	}

	public static function getFamilyById($id) {
		if($id == null) {return null;}
		$results = DB::table('family')->where('family_id','=',$id)->get(array('family_name'));
		$results = $results[0]->family_name;
		return $results;
	}

	public static function getStatusById($id) {
		if($id == null) {return null;}
		$results = DB::table('status')->where('status_id','=',$id)->get(array('status_name'));
		return $results[0]->status_name;
	}

	public static function getOptions() {

		$roster = Roster::all();
		$semesters = DB::table('semester')->get();
		$families = DB::table('family')->order_by('family_name', 'ASC')->get();
		$statuses = DB::table('status')->get();
		$industries = Roster::getOptionsByField('industry');
		$locations = Roster::getOptionsByField('location');

		$results = array(
			'roster' => $roster,
			'semesters' => $semesters,
			'families' => $families,
			'statuses' => $statuses,
			'industries' => $industries,
			'locations' => $locations,
		);
		return $results;
	}

	private static function getOptionsByField($field) {
		$sql = "SELECT DISTINCT $field AS field FROM roster ORDER BY $field ASC";
		$results = array();
		$db_results = DB::query($sql);
		foreach ($db_results as $db_result) {
			array_push($results, $db_result->field);
		}
		return $results;
	}

	public static function formatInput($data) {
		if(empty($data)) {
			$desc = "<i>Showing all results.</i>";
		}
		else{
			$desc = "<i>Showing results for...</i><br>";
			if(!empty($data['query'])) {$desc.="<br><label>Search Term:</label> ".$data['query']; }
			if(!empty($data['fname'])) { $desc .= "<br><label>First Name:</label> ".$data['fname']; }
			if(!empty($data['lname'])) { $desc .= "<br><label>Last Name:</label> ".$data['lname']; }
			if(!empty($data['grad_sem_id']) or !empty($data['grad_year'])) { 
				$desc .= "<br><label>Graduated:</label> ".Roster::getSemById($data['grad_sem_id'])." ".$data['grad_year'];
				if($_SESSION['admin']['edit_multiple']) {
					$desc .= Admin::getTransitionHTML($data);
				}
			}
			if(!empty($data['pc_sem_id']) or !empty($data['pc_year'])) { 
				$desc .= "<br><label>Pledged:</label> ".Roster::getSemById($data['pc_sem_id'])." ".$data['pc_year']; 
			}
			if(!empty($data['bigbro_id'])) {
				$desc .= "<br><label>Big Bro:</label> ".Roster::getNameById($data['bigbro_id']); 
			}
			if(!empty($data['family_id']) && $data['family_id'] != 1) { 
				$desc .= "<br><label>Family:</label> ".Roster::getFamilyById($data['family_id']); 
			}
			if(!empty($data['status_id'])) { 
				$desc .= "<br><label>Status:</label> ".Roster::getStatusById($data['status_id']); 
			}
			if(!empty($data['industry'])) { $desc .= "<br><label>Industry:</label> ".$data['industry']; }
			if(!empty($data['location'])) { $desc .= "<br><label>Location:</label> ".$data['location']; }
			$desc .= "<br>";
		}
		return $desc;
	}

	public static function add($data) {
		// dd($data);
		DB::table('roster')->insert_get_id(array(
			'bro_fname' => $data['fname'],
			'bro_lname' => $data['lname'],
			'grad_sem_id' => $data['grad_sem_id'],
			'grad_year' => $data['grad_year'],
			'pc_sem_id' => $data['pc_sem_id'],
			'pc_year' => $data['pc_year'],
			'bigbro_id' => $data['bigbro_id'],
			'family_id' => $data['family_id'],
			'status_id' => $data['status_id'],
			'email' => rtrim($data['email']),
			'linkedin' => rtrim($data['linkedin'])
		));
		// if($data['linkedin']) {
		// 	Linkedin::getProfileById('');
		// }
	}

	public static function edit($data) {
		// dd($data);
		DB::table('roster')
			->where('bro_id','=',$data['bro_id'])->update(array(
				'bro_fname' => $data['fname'],
				'bro_lname' => $data['lname'],
				'grad_sem_id' => $data['grad_sem_id'],
				'grad_year' => $data['grad_year'],
				'pc_sem_id' => $data['pc_sem_id'],
				'pc_year' => $data['pc_year'],
				'bigbro_id' => $data['bigbro_id'],
				'family_id' => $data['family_id'],
				'status_id' => $data['status_id'],
				'email' => rtrim($data['email']),
				'linkedin' => rtrim($data['linkedin'])
		));
		if($data['linkedin']) {
			Linkedin::getProfileById($data['bro_id']);
		}
	}

	public static function editAll($data) {
		for ($i=0; $i < count(Roster::all()); $i++) { 
			DB::table('roster')->where('bro_id','=',$data['bro_id'.$i])->update(array(
				'email' => rtrim($data['email'.$i]),
				'linkedin' => rtrim($data['linkedin'.$i])
			));
			Linkedin::getProfileById($data['bro_id'.$i]);
		}
	}

	public static function delete($id) {
		DB::table('roster')->where('bro_id','=',$id)->delete();
	}

	public static function transitionByGradSem($data) {
		$bros = Roster::getByQuery($data);
		foreach ($bros as $bro) {
			DB::table('roster')->where('bro_id','=',$bro->bro_id)->update(array(
				'status_id' => 2
			));
		}
	}

	public static function addFamily($family_name) {
		DB::table('family')->insert_get_id(array('family_name' => $family_name));
	}

	public static function editFamilies($data) {
		for ($i=0; $i < count($data)/2; $i++) { 
			DB::table('family')->where('family_id','=',$data['family_id'.$i])->update(array(
				'family_name' => $data['family_name'.$i]
			));
		}
	}

	public static function mergeFamilies($id1, $id2) {
		// Transfer brothers from family 2 to family 1
		DB::table('roster')->where('family_id', '=', $id2)->update(array('family_id' => $id1));

		// Check that no brothers are remaining
		if(!DB::table('roster')->where('family_id','=',$id2)->get()) {
			// Delete family 2
			DB::table('family')->where('family_id','=',$id2)->delete();
		}
		else {
			dd(DB::table('roster')->where('family_id','=',$id2));
		}

	}

}

?>