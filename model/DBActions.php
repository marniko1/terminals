<?php

class DBActions extends DB {
	public static function getAllActionTypes () {
		$sql = "select * from action_types order by id";
		return self::queryAndFetchInObj($sql);
	}
	public static function addNew ($new_action_type) {
		$sql = "insert into action_types values (default, '$new_action_type')";
		$req = self::executeSQL($sql);
		return $req;
	}
}