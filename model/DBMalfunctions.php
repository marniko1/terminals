<?php

class DBMalfunctions extends DB {
	public static function getAllMalfunctions () {
		$sql = "select * from malfunctions";
		return self::queryAndFetchInObj($sql);
	}
	public static function getMalfunctionsHistory ($skip) {
		$sql = "select mh.*, to_char(mh.date, 'DD.MM.YYYY') as date, 
		d.sn, 
		t.title as type, 
		m.title as model, 
		l.title as location, 
		mf.title as malfunction, 
		at.title as action, 
		concat(initcap(first_name), ' ', initcap(last_name)) as repairer, 

		(select count(*) from malfunctions_history) as total 

		from malfunctions_history as mh 

		join malfunctions as mf 
		on mf.id = mh.malfunction_id 
		join devices as d 
		on d.id = mh.device_id 
		join types as t 
		on t.id = d.type_id 
		left join devices_models as dm 
		on dm.device_id = d.id 
		left join models as m 
		on m.id = dm.model_id 
		join locations as l 
		on l.id = mh.location_id 
		join action_types as at 
		on at.id = mh.action_type_id 
		join repairers as r 
		on r.id = mh.repairer_id 

		order by mh.id limit " .PG_RESULTS. " offset $skip";
		return self::queryAndFetchInObj($sql);
	}
	public static function getFilteredMalfunctionHistory ($cond_name, $cond, $skip, $sql_addon) {
		$sql = "select d.sn, 
		t.title as type, 
		m.title as model, 
		l.title as location, 
		mf.title as malfunction, 
		at.title as action, 
		concat(initcap(first_name), ' ', initcap(last_name)) as repairer, 
		mh.comment, 
		to_char(mh.date, 'DD.MM.YYYY') as date, 

		(select count(*) from malfunctions_history where d.sn like '%$cond%') as total 

		from malfunctions_history as mh 
		join malfunctions as mf 
		on mf.id = mh.malfunction_id 
		join devices as d 
		on d.id = mh.device_id 
		join types as t 
		on t.id = d.type_id 
		left join devices_models as dm 
		on dm.device_id = d.id 
		left join models as m 
		on m.id = dm.model_id 
		join locations as l 
		on l.id = mh.location_id 
		join action_types as at 
		on at.id = mh.action_type_id 
		join repairers as r 
		on r.id = mh.repairer_id 

		where d.sn like '%$cond%' 

		order by mh.id limit " .PG_RESULTS. " offset $skip";
		return self::queryAndFetchInObj($sql);
	}
}