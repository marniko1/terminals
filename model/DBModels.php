<?php

class DBModels extends DB {
	public static function getAllDevicesModels () {
		$sql = "select * from models";
		return self::queryAndFetchInObj($sql);
	}
	public static function addNewModel ($model, $purpose) {
		$sql = "insert into models values (default, '$model', '$purpose')";
		$req = self::executeSQL($sql);
		return $req;
	}
}