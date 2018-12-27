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
	public static function addNewLocation ($new_location, $priority) {
		$sql = "insert into locations values (default,'$new_location',$priority)";
		$req = self::executeSQL($sql);
		return $req;
	}
	public static function getAllLocationsInProposals ($cond) {
		$sql = "select id, title as ajax_data from locations
		where lower(title) like lower('%$cond%')";
		return self::queryAndFetchInObj($sql);
	}
}