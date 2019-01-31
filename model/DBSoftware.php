<?php

class DBSoftware extends DB {
	public static function getAllSoftwares () {
		$sql = "select * from software";
		return self::queryAndFetchInObj($sql);
	}
	public static function addNew ($new_software) {
		$sql = "insert into software values (default, '$new_software')";
		$req = self::executeSQL($sql);
		return $req;
	}
	public static function softwareChange ($device_id, $software_id) {
		$sql = "select device_software_change($device_id, $software_id)";
		$req = self::executeSQL($sql);
		return $req;
	}
}