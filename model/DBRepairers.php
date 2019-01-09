<?php

class DBRepairers extends DB {
	public static function getAllRepairers () {
		$sql = "select id, concat(initcap(first_name), ' ', initcap(last_name)) as repairer from repairers";
		return self::queryAndFetchInObj($sql);
	}
}