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
			$sql .= ' AND (roster.bro_fname LIKE "%'.$data['query'].'%"';
			$sql .= ' OR roster.bro_lname LIKE "%'.$data['query'].'%"';
			$sql .= ' OR grad_sem.semester_name LIKE "%'.$data['query'].'%"';
			$sql .= ' OR roster.grad_year LIKE "%'.$data['query'].'%"';
			$sql .= ' OR pc_sem.semester_name LIKE "%'.$data['query'].'%"';
			$sql .= ' OR roster.pc_year LIKE "%'.$data['query'].'%"';
			$sql .= ' OR family.family_name LIKE "%'.$data['query'].'%"';
			$sql .= ' OR status.status_name LIKE "%'.$data['query'].'%"';
			$sql .= ' OR roster.industry LIKE "%'.$data['query'].'%"';
			$sql .= ' OR roster.location LIKE "%'.$data['query'].'%")';
		}

		$sql .= ' ORDER BY status_id ASC, bro_lname ASC';
		$results = DB::query($sql);
		return $results;
	}

	public static function formatInput($data) {
		if(empty($data)) {
			$desc = "<i>Showing all results.</i>";
		}
		else{
			$desc = "<i>Showing results for...</i><br>";
			if(!empty($data['query'])) {$desc.="<br>Search Term: ".$data['query']; }
			if(!empty($data['fname'])) { $desc .= "<br>First Name: ".$data['fname']; }
			if(!empty($data['lname'])) { $desc .= "<br>Last Name: ".$data['lname']; }
			if(!empty($data['grad_sem_id']) or !empty($data['grad_year'])) { 
				$desc .= "<br>Graduated: ".Roster::getSemById($data['grad_sem_id'])." ".$data['grad_year'];
			}
			if(!empty($data['pc_sem_id']) or !empty($data['pc_year'])) { 
				$desc .= "<br>Pledged: ".Roster::getSemById($data['pc_sem_id'])." ".$data['pc_year']; 
			}
			if(!empty($data['bigbro_id'])) { $desc .= "<br>Big Bro: ".Roster::getNameById($data['bigbro_id']); }
			if(!empty($data['family_id']) && $data['family_id'] != 1) { 
				$desc .= "<br>Family: ".Roster::getFamilyById($data['family_id']); 
			}
			if(!empty($data['status_id'])) { $desc .= "<br>Status: ".Roster::getStatusById($data['status_id']); }
			if(!empty($data['industry'])) { $desc .= "<br>Industry: ".$data['industry']; }
			if(!empty($data['location'])) { $desc .= "<br>Location: ".$data['location']; }
			$desc .= "<br>";
		}
		return $desc;
	}

	public static function getOptions() {

		$roster = DB::table('roster')->get();
		$semesters = DB::table('semester')->get();
		$families = DB::table('family')->get();
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
		$sql = "SELECT DISTINCT $field AS field FROM roster";
		$results = array();
		$db_results = DB::query($sql);
		foreach ($db_results as $db_result) {
			array_push($results, $db_result->field);
		}
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

	public static function add($data) {
		// dd($data);
		$success = DB::table('roster')->insert_get_id(array(
			'bro_fname' => $data['fname'],
			'bro_lname' => $data['lname'],
			'grad_sem_id' => $data['grad_sem_id'],
			'grad_year' => $data['grad_year'],
			'pc_sem_id' => $data['pc_sem_id'],
			'pc_year' => $data['pc_year'],
			'bigbro_id' => $data['bigbro_id'],
			'family_id' => $data['family_id'],
			'status_id' => $data['status_id'],
			'email' => $data['email'],
			'linkedin' => $data['linkedin']
		));
		// if($data['linkedin']) {
		// 	Linkedin::getProfileById('');
		// }
		return $success;
	}

	public static function edit($data) {
		// dd($data);
		DB::table('roster')
			->where('bro_id','=',$data['bro_id'])
			->update(array(
				'bro_fname' => $data['fname'],
				'bro_lname' => $data['lname'],
				'grad_sem_id' => $data['grad_sem_id'],
				'grad_year' => $data['grad_year'],
				'pc_sem_id' => $data['pc_sem_id'],
				'pc_year' => $data['pc_year'],
				'bigbro_id' => $data['bigbro_id'],
				'family_id' => $data['family_id'],
				'status_id' => $data['status_id'],
				'email' => $data['email'],
				'linkedin' => $data['linkedin']
		));
		if($data['linkedin']) {
			Linkedin::getProfileById($data['bro_id']);
		}
	}

	public static function editAll($data) {
		for ($i=0; $i < count(Roster::all()) ; $i++) { 
			DB::table('roster')->where('bro_id','=',$data['bro_id'.$i])->update(array(
				'email' => $data['email'.$i],
				'linkedin' => $data['linkedin'.$i]
			));
		}
	}

	public static function delete($id) {
		DB::table('roster')->where('bro_id','=',$id)->delete();
	}

}

?>