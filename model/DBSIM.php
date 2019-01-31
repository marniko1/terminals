<?php

class DBSIM extends DB {
	public static function getAllSIM ($skip) {
		$sql = "select *, (select count(*) from sim_cards) as total from sim_cards order by num limit ".PG_RESULTS. "offset $skip";
		return self::queryAndFetchInObj($sql);
	}
	public static function getSingleSIM ($sim_id) {
		$sql = "select sc.*, d.id as device_id, d.sn from sim_cards as sc 
		left join terminals_sim_cards as tsc 
		on tsc.sim_card_id = sc.id 
		left join devices as d 
		on d.id = tsc.terminal_id 
		where sc.id = $sim_id";
		return self::queryAndFetchInObj($sql);
	}
	// for pagination
	public static function getFilteredSIMs ($cond_name, $cond, $skip, $sql_addon) {
		$sql = "select id, num, iccid, 
		(select count(*) from sim_cards where (cast(iccid as text) like '%$cond%' 
		or cast(num as text) like '%$cond%') " . $sql_addon . ") as total 
		from sim_cards 
		where (cast(iccid as text) like '%$cond%' or cast(num as text) like '%$cond%') " . $sql_addon . "
		order by num limit ".PG_RESULTS. " offset $skip";
		return self::queryAndFetchInObj($sql);
	}
	// for proposals *****************************************************************************************
	public static function getFilteredSIMsForTerminal ($cond) {
		$sql = "select sc.id, sc.iccid as ajax_data from sim_cards as sc 
		left join terminals_sim_cards as tsc 
		on tsc.sim_card_id = sc.id   
		where iccid like '%$cond%' and tsc.id is null 
		limit 6";
		return self::queryAndFetchInObj($sql);
	}
	// **********************
	public static function putSIMInTerminal ($sim_id, $terminal_id) {
		$sql = "insert into terminals_sim_cards values (default, $terminal_id, $sim_id)";
		$req = self::executeSQL($sql);
		return $req;
	}
	public static function splitSIMFromTerminal ($sim_id, $terminal_id) {
		$sql = "delete from terminals_sim_cards where terminal_id = $terminal_id and sim_card_id = $sim_id";
		$req = self::executeSQL($sql);
		return $req;
	}
	public static function addNewSIM ($num, $iccid) {
		$sql = "insert into sim_cards values (default, $num, '$iccid')";
		$req = self::executeSQL($sql);
		return $req;
	}
}