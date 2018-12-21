<?php

class DBLocations extends DB {
	public static function getAllLocations () {
		$sql = "select * from locations";
		return self::queryAndFetchInObj($sql);
	}
	public static function getAllLocationsForCharges () {
		$sql = "select * from locations where priority = 1";
		return self::queryAndFetchInObj($sql);
	}
	public static function addNewLocation ($new_location) {
		$sql = "insert into locations values (default, '$new_location')";
		$req = self::executeSQL($sql);
		return $req;
	}
}