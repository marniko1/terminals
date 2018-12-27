<?php

class DBDevices extends DB {
	public static function getAllDevices ($skip) {
		$sql = "select d.*, 
		t.title as type, 
		l.title as location, 
		dis.title as distributor, 
		m.title as model, 
		(select count(*) from devices) as total from devices as d 
		join types as t 
		on t.id = d.type_id 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id)
		left join locations as l 
		on l.id = dl.location_id 
		left join locations_distributors as ld 
		on ld.location_id = l.id 
		left join distributors as dis 
		on dis.id = ld.distributor_id 
		left join devices_models as dm 
		on dm.device_id = d.id 
		left join models as m 
		on m.id = dm.model_id 

		order by sn limit " .PG_RESULTS. "offset $skip";
		return self::queryAndFetchInObj($sql);
	}
	// public static function getSingleDevice ($id) {
	// 	$sql = "select d.*, 
	// 	l.title as location,
	// 	m.title as model, 
	// 	dt.title as type, 
	// 	swv.software as sw_ver, 
	// 	dwo.id as writed_off, 
	// 	t.id as terminal_id, 
	// 	tn.terminal_num 

	// 	from devices as d 
	// 	join devices_locations as dl 
	// 	on d.id = dl.device_id 
	// 	join locations as l 
	// 	on dl.location_id = l.id 

	// 	join models as m 
	// 	on m.id = d.model_id 
	// 	join devices_types as dt 
	// 	on dt.id = d.device_type_id 
	// 	left join devices_softwares as dsw 
	// 	on dsw.device_id = d.id and dsw.id = (select max(id) from devices_softwares where device_id = d.id) 
	// 	left join software_v as swv 
	// 	on swv.id = dsw.software_v_id
	// 	left join devices_writes_off as dwo 
	// 	on dwo.device_id = d.id 

	// 	left join terminals as t 
	// 	on (t.pda_id = d.id or t.printer_id = d.id) and t.id not in (select terminal_id from terminals_disassembled) 
	// 	left join terminals_num as tn 
	// 	on tn.id = t.terminals_num_id 

	// 	where d.id = $id";
	// 	return self::queryAndFetchInObj($sql);
	// }
	public static function getAllDevicesInLanus () {
		$sql = "select * from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		where dl.location_id = 4";
		return self::queryAndFetchInObj($sql);
	}
	public static function getAllDevicesInService () {
		$sql = "select * from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		where dl.location_id = 3";
		return self::queryAndFetchInObj($sql);
	}
	public static function getFilteredDevices ($cond_name, $cond, $skip, $sql_addon) {
		$sql = "select d.sn, d.id, 
		m.title as model, 
		l.title as location, 
		dis.title as distributor, 
		t.title as type, 
		(select count(*) from devices as d 
		where 
		(d.sn like '%$cond%' or lower(l.title) like lower('%$cond%'))" . $sql_addon . ") 
		as total 
		from devices as d 
		join types as t 
		on t.id = d.type_id 

		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id)
		left join locations as l 
		on l.id = dl.location_id 

		left join locations_distributors as ld 
		on ld.location_id = l.id 
		left join distributors as dis 
		on dis.id = ld.distributor_id 

		left join devices_models as dm 
		on dm.device_id = d.id 
		left join models as m 
		on m.id = dm.model_id 

		where (d.sn like '%$cond%' or lower(l.title) like lower('%$cond%'))" . 
		$sql_addon
		. "	order by d.sn limit " .PG_RESULTS. " offset $skip";
		return self::queryAndFetchInObj($sql);
	}


	// FILTERED DATA FOR PROPOSALS *******************************************************
	public static function getFilteredDevicesForLocationChange ($cond) {
		$sql = "select id, sn as ajax_data from devices  
		where sn like '%$cond%' 
		limit 6
		";
		return self::queryAndFetchInObj($sql);
	}

	public static function getFilteredDevicesForCharge ($cond) {
		$sql = "select d.id, d.sn as ajax_data from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id)  
		where sn like '%$cond%' and dl.location_id = 2 
		limit 6
		";
		return self::queryAndFetchInObj($sql);
	}

	public static function getFilteredDevicesInLanus ($cond) {
		$sql = "select d.id, d.sn as ajax_data from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id)  
		where sn like '%$cond%' and dl.location_id = 4 
		limit 6
		";
		return self::queryAndFetchInObj($sql);
	}

	public static function getFilteredDevicesOnOtherLocations ($cond) {
		$sql = "select d.id, l.title as location, d.sn as ajax_data from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		where sn like '%$cond%' and l.priority = 2  
		limit 6
		";
		return self::queryAndFetchInObj($sql);
	}

	public static function getFilteredDevicesInService ($cond) {
		$sql = "select d.id, d.sn as ajax_data from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id)  
		where sn like '%$cond%' and dl.location_id = 3 
		limit 6
		";
		return self::queryAndFetchInObj($sql);
	}
	// *************************************************************************************

	public static function changeDeviceLocation ($location_id, $device_id) {
		$sql = "insert into devices_locations values(default,$device_id,$location_id,".$_SESSION['user_id'].",default)";
		return self::executeSQL($sql);
	}
	// public static function countAllPDA () {
	// 	$sql = "select count(*) as pda_num from devices as d 
	// 	left join devices_writes_off as dwo 
	// 	on dwo.device_id = d.id 
	// 	where d.device_type_id = 1 and dwo.id is null";
	// 	return self::queryAndFetchInObj($sql);
	// }
	// public static function countAllPDAInService () {
	// 	$sql = "select count(*) as pda_num_in_storage from devices as d 
	// 	left join devices_writes_off as dwo 
	// 	on dwo.device_id = d.id 
	// 	left join terminals as t 
	// 	on (t.pda_id = d.id or t.printer_id = d.id) and t.id not in (select terminal_id from terminals_disassembled) 
	// 	join devices_locations as dl 
	// 	on dl.device_id = d.id 
	// 	where device_type_id = 1 and dwo.id is null and dl.location_id = 1 and t.id is null";
	// 	return self::queryAndFetchInObj($sql);
	// }
	// public static function countAllPDAInTerminals () {
	// 	$sql = "select count(*) as pda_num_in_terminals from devices as d 
	// 	left join devices_writes_off as dwo 
	// 	on dwo.device_id = d.id 
	// 	left join terminals as t 
	// 	on (t.pda_id = d.id or t.printer_id = d.id) and t.id not in (select terminal_id from terminals_disassembled) 
	// 	join devices_locations as dl 
	// 	on dl.device_id = d.id 
	// 	where device_type_id = 1 and dwo.id is null and t.id is not null";
	// 	return self::queryAndFetchInObj($sql);
	// }
	// public static function countAllPDAOnOtherLocations () {
	// 	$sql = "select count(*) as pda_num_on_other_locations from devices as d 
	// 	left join devices_writes_off as dwo 
	// 	on dwo.device_id = d.id 
	// 	left join terminals as t 
	// 	on (t.pda_id = d.id or t.printer_id = d.id) and t.id not in (select terminal_id from terminals_disassembled) 
	// 	join devices_locations as dl 
	// 	on dl.device_id = d.id 
	// 	where device_type_id = 1 and dwo.id is null and t.id is null and dl.location_id != 1 and dl.location_id != 3";
	// 	return self::queryAndFetchInObj($sql);
	// }


	// public static function countAllPrinters () {
	// 	$sql = "select count(*) as printers_num from devices as d 
	// 	left join devices_writes_off as dwo 
	// 	on dwo.device_id = d.id 
	// 	where d.device_type_id = 2 and dwo.id is null";
	// 	return self::queryAndFetchInObj($sql);
	// }
	// public static function countAllPrintersInService () {
	// 	$sql = "select count(*) as printers_num_in_storage from devices as d 
	// 	left join devices_writes_off as dwo 
	// 	on dwo.device_id = d.id 
	// 	left join terminals as t 
	// 	on (t.pda_id = d.id or t.printer_id = d.id) and t.id not in (select terminal_id from terminals_disassembled) 
	// 	join devices_locations as dl 
	// 	on dl.device_id = d.id 
	// 	where device_type_id = 2 and dwo.id is null and dl.location_id = 1 and t.id is null";
	// 	return self::queryAndFetchInObj($sql);
	// }
	// public static function countAllPrintersInTerminals () {
	// 	$sql = "select count(*) as printers_num_in_terminals from devices as d 
	// 	left join devices_writes_off as dwo 
	// 	on dwo.device_id = d.id 
	// 	left join terminals as t 
	// 	on (t.pda_id = d.id or t.printer_id = d.id) and t.id not in (select terminal_id from terminals_disassembled) 
	// 	join devices_locations as dl 
	// 	on dl.device_id = d.id 
	// 	where device_type_id = 2 and dwo.id is null and t.id is not null";
	// 	return self::queryAndFetchInObj($sql);
	// }
	// public static function countAllPrintersOnOtherLocations () {
	// 	$sql = "select count(*) as printers_num_on_other_locations from devices as d 
	// 	left join devices_writes_off as dwo 
	// 	on dwo.device_id = d.id 
	// 	left join terminals as t 
	// 	on (t.pda_id = d.id or t.printer_id = d.id) and t.id not in (select terminal_id from terminals_disassembled) 
	// 	join devices_locations as dl 
	// 	on dl.device_id = d.id 
	// 	where device_type_id = 2 and dwo.id is null and t.id is null and dl.location_id != 1 and dl.location_id != 3";
	// 	return self::queryAndFetchInObj($sql);
	// }
}



// select d.sn, d.id, 
// 		l.title as location, 
// 		dis.title as distributor, 
// 		t.title as type, 
// 		(select count(*) from devices as d 
// 		where 
// 		(d.sn like '%%' or lower(l.title) like lower('%%')) and cast(t.id as text) = '1' ) 
// 		as total 
// 		from devices as d 
// 		join types as t 
// 		on t.id = d.type_id 

// 		left join devices_locations as dl 
// 		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id)
// 		left join locations as l 
// 		on l.id = dl.location_id 

// 		left join locations_distributors as ld 
// 		on ld.location_id = l.id 
// 		left join distributors as dis 
// 		on dis.id = ld.distributor_id 

// 		where d.sn like '%%' or lower(l.title) like lower('%%') 
// 		and cast(t.id as text) = '1'
// 		order by d.sn limit 5 offset 0