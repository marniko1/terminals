<?php

class DBCharges extends DB {
	public static function makeNewCharge ($values) {
		$sql = "insert into devices_locations values $values";
		$req = self::executeSQL($sql);
		return $req;
	}
}