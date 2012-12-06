<?php

class Family {
	public static function getMembers($family_id) {
		$data = array('family_id' => $family_id);
		return Roster::getByQuery($data);		
	}

	public static function getNodeIds($family_id) {
		$members = Family::getMembers($family_id);
		$results = array();
		foreach ($members as $bro) {
			if($bro->bigbro_id == 0) {
				array_push($results, $bro->bro_id);
			}
		}
		return $results;
	}

	public static function hasLittle($bro_id) {
		$data = array('bigbro_id' => $bro_id);
		if(count(Roster::getByQuery($data)) == 0) {
			$results = false;
		}
		else {$results = true;}
		return $results;
	}

	public static function getLittleIds($bro_id) {
		$data = array('bigbro_id' => $bro_id);
		$littles = Roster::getByQuery($data);
		$results = array();
		foreach ($littles as $little) {
			array_push($results, $little->bro_id);
		}
		return $results;
	}

	public static function createTree2($node_ids) {
		foreach ($node_ids as $node_id) {
			while(Family::hasLittle($node_id)) {
				echo Roster::getNameById($node_id).' ';
				$littleIds = Family::getLittleIds($node_id);
				Family::createTree2($littleIds);
			}
		}
		exit();
	}

	public static function createTree($family_id) {
		$node_ids = Family::getNodeIds($family_id);
		//dd(Roster::getNameById($node_ids[0]));
		Family::createTree2($node_ids);
	}
}