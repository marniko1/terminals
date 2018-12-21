<?php

class DBTypes extends DB {
	public static function getAllTypes () {
		$sql = "select * from types";
		return self::queryAndFetchInObj($sql);
	}
}