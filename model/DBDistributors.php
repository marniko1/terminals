<?php

class DBDistributors extends DB {
	public static function getAllDistributors () {
		$sql = "select * from distributors";
		return self::queryAndFetchInObj($sql);
	}
	public static function addNewDistributor ($new_distributor) {
		$sql = "insert into distributors values (default,'$new_distributor')";
		$req = self::executeSQL($sql);
		return $req;
	}
}