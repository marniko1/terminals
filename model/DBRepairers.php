<?php

class DBRepairers extends DB {
	public static function getAllRepairers () {
		$sql = "select id, concat(initcap(first_name), ' ', initcap(last_name)) as repairer from repairers";
		return self::queryAndFetchInObj($sql);
	}
	public static function addNewRepairer ($new_repairer_first_name, $new_repairer_last_name) {
		$sql = "insert into repairers values (default, '$new_repairer_first_name', '$new_repairer_last_name')";
		$req = self::executeSQL($sql);
		return $req;
	}
}