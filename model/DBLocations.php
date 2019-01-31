<?php

class DBLocations extends DB {
	public static function getAllLocations () {
		$sql = "select * from locations";
		return self::queryAndFetchInObj($sql);
	}
	public static function getAllLocationsForCharges () {
		$sql = "select * from locations where priority = 1 and title != 'magacin'";
		return self::queryAndFetchInObj($sql);
	}
	public static function addNewLocation ($new_location, $priority, $distributor_id) {
		$sql = "select insert_new_location('$new_location',$priority,$distributor_id)";
		$req = self::executeSQL($sql);
		return $req;
	}
	public static function getAllLocationsInProposals ($cond) {
		$sql = "select id, title as ajax_data from locations
		where lower(title) like lower('%$cond%') 
		order by title limit 6";
		return self::queryAndFetchInObj($sql);
	}
}