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
			->join('semester AS pc_sem', 'roster.pc_sem_id', '=', 'pc_sem.semester_id');
			// ->get();

		$results = $query->get(array('roster.*','family_name','status_name',
			'grad_sem.semester_name AS grad_sem','pc_sem.semester_name AS pc_sem'));

		return $results;
		/*
		SELECT roster.*, family.family_name, status.status_name, 
		grad_sem.semester_name AS grad_sem_name, pc_sem.semester_name AS pc_sem_name
		FROM roster, family, status, semester AS grad_sem, semester AS pc_sem_name
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

	public static function getOptions() {

		$roster = DB::table('roster')->get();
		$semesters = DB::table('semester')->get();
		$families = DB::table('family')->get();
		$statuses = DB::table('status')->get();

		$results = array(
			'roster' => $roster,
			'semesters' => $semesters,
			'families' => $families,
			'statuses' => $statuses,
		);

		// dd($results);

		return $results;
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
			'linkedin' => $data['linkedin']
		));
		return $success;
	}

	public static function getBrother($id) {
		$query = DB::table('roster')
			->join('family','roster.family_id','=','family.family_id')
			->join('status','roster.status_id','=','status.status_id')
			->join('semester AS grad_sem','roster.grad_sem_id', '=', 'grad_sem.semester_id')
			->join('semester AS pc_sem', 'roster.pc_sem_id', '=', 'pc_sem.semester_id')
			->where('bro_id','=', $id);
			// ->get();

		$results = $query->get(array('roster.*','family_name','status_name',
			'grad_sem.semester_name AS grad_sem','pc_sem.semester_name AS pc_sem'));

		return $results;
	}

}

?>