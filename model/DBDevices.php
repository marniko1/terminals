<?php

class DBDevices extends DB {
	public static function getAllDevices ($skip) {
		$sql = "select d.*, 
		t.title as type, 
		l.title as location, 
		dis.title as distributor, 
		m.title as model, 
		s.title as software, 
		(select count(*) from devices) as total 

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
		left join devices_softwares as ds 
		on ds.device_id = d.id 
		left join software as s 
		on s.id = ds.software_id 

		order by sn limit " .PG_RESULTS. "offset $skip";
		return self::queryAndFetchInObj($sql);
	}
	public static function getSingleDevice ($id) {
		$sql = "select d.*, 
		l.title as location,
		m.title as model, 
		t.title as type, 
		sc.num as sim, sc.iccid as iccid, 
		dis.title as distributor 

		from devices as d 

		left join devices_models as dm 
		on dm.device_id = d.id 
		left join models as m 
		on m.id = dm.model_id 
		join types as t 
		on t.id = d.type_id 
		left join terminals_sim_cards as tsc 
		on tsc.terminal_id = d.id 
		left join sim_cards as sc 
		on sc.id = tsc.sim_card_id
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id)
		left join locations as l 
		on l.id = dl.location_id 
		left join locations_distributors as ld 
		on ld.location_id = l.id 
		left join distributors as dis 
		on dis.id = ld.distributor_id 
		

		where d.id = $id";
		return self::queryAndFetchInObj($sql);
	}
	public static function getAllDevicesInStorage ($type_id) {
		$sql = "select d.* from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		where l.title = 'magacin' and d.type_id = $type_id";
		return self::queryAndFetchInObj($sql);
	}
	public static function getAllDevicesInLanus () {
		$sql = "select d.* from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		where l.title = 'lanus'";
		return self::queryAndFetchInObj($sql);
	}
	public static function getAllDevicesInService () {
		$sql = "select d.* from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		where l.title = 'servis'";
		return self::queryAndFetchInObj($sql);
	}
	public static function getFilteredDevices ($cond_name, $cond, $skip, $sql_addon) {
		$sql = "select d.sn, d.id, 
		m.title as model,
		s.title as software,  
		l.title as location, 
		dis.title as distributor, 
		t.title as type, 
		(select count(*) from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id)
		left join locations as l 
		on l.id = dl.location_id 
		left join devices_softwares as ds 
		on ds.device_id = d.id 
		left join software as s 
		on s.id = ds.software_id
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

		left join devices_softwares as ds 
		on ds.device_id = d.id 
		left join software as s 
		on s.id = ds.software_id 


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
		left join locations as l 
		on l.id = dl.location_id 
		where sn like '%$cond%' and l.title = 'magacin' 
		limit 6
		";
		return self::queryAndFetchInObj($sql);
	}

	public static function getFilteredDevicesInLanus ($cond) {
		$sql = "select d.id, d.sn as ajax_data from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		where sn like '%$cond%' and l.title = 'lanus' 
		limit 6
		";
		return self::queryAndFetchInObj($sql);
	}

	public static function getFilteredDevicesOnOtherLocations ($cond) {
		$sql = "select d.id, d.sn as ajax_data, 
		l.title as location, l.id as location_id 
		from devices as d 
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
		left join locations as l 
		on l.id = dl.location_id  
		where sn like '%$cond%' and l.title = 'servis' 
		limit 6
		";
		return self::queryAndFetchInObj($sql);
	}
	public static function getFilteredTerminalsForSIMs ($cond) {
		$sql = "select d.id, d.sn as ajax_data from devices as d 
		left join terminals_sim_cards as tsc 
		on tsc.terminal_id = d.id 
		where sn like '%$cond%' and tsc.id is null 
		limit 6
		";
		return self::queryAndFetchInObj($sql);
	}


	// *************************************************************************************
	// DEVICES COUNTER FOR CHARTS **********************************************************
		// terminals ***********************************************************************
	public static function countTerminalsInStorage () {
		$sql = "select count(dl.*) from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		where l.title = 'magacin' and d.type_id = 2";
		return self::queryAndFetchInObj($sql);
	}
	public static function countTerminalsInService () {
		$sql = "select count(dl.*) from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		where l.title = 'servis' and d.type_id = 2";
		return self::queryAndFetchInObj($sql);
	}
	public static function countTerminalsInLanus () {
		$sql = "select count(dl.*) from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		where l.title = 'lanus' and d.type_id = 2";
		return self::queryAndFetchInObj($sql);
	}
	// ***************************************************************************************************
	public static function countLanusTerminalsInStorage () {
		$sql = "select count(dl.*) from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		left join devices_models as dm  
		on dm.device_id = d.id 
		left join models as m 
		on m.id = dm.model_id 
		where l.title = 'magacin' and d.type_id = 2 and m.title = 'lanus'";
		return self::queryAndFetchInObj($sql);
	}
	public static function countLanusTerminalsInService () {
		$sql = "select count(dl.*) from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		left join devices_models as dm  
		on dm.device_id = d.id 
		left join models as m 
		on m.id = dm.model_id 
		where l.title = 'servis' and d.type_id = 2 and m.title = 'lanus'";
		return self::queryAndFetchInObj($sql);
	}
	public static function countLanusTerminalsInLanus () {
		$sql = "select count(dl.*) from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		left join devices_models as dm  
		on dm.device_id = d.id 
		left join models as m 
		on m.id = dm.model_id 
		where l.title = 'lanus' and d.type_id = 2 and m.title = 'lanus'";
		return self::queryAndFetchInObj($sql);
	}
	// *****************************************************************************************************
	public static function countCertusTerminalsInStorage () {
		$sql = "select count(dl.*) from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		left join devices_models as dm  
		on dm.device_id = d.id 
		left join models as m 
		on m.id = dm.model_id 
		where l.title = 'magacin' and d.type_id = 2 and m.title = 'certus'";
		return self::queryAndFetchInObj($sql);
	}
	public static function countCertusTerminalsInService () {
		$sql = "select count(dl.*) from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		left join devices_models as dm  
		on dm.device_id = d.id 
		left join models as m 
		on m.id = dm.model_id 
		where l.title = 'servis' and d.type_id = 2 and m.title = 'certus'";
		return self::queryAndFetchInObj($sql);
	}
	public static function countCertusTerminalsInLanus () {
		$sql = "select count(dl.*) from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		left join devices_models as dm  
		on dm.device_id = d.id 
		left join models as m 
		on m.id = dm.model_id 
		where l.title = 'lanus' and d.type_id = 2 and m.title = 'certus'";
		return self::queryAndFetchInObj($sql);
	}
		// qprox ***************************************************************************
	public static function countQproxInStorage () {
		$sql = "select count(dl.*) from devices as d 
		left join devices_locations as dl 
		on dl.device_id = d.id and dl.id = (select max(id) from devices_locations where device_id = d.id) 
		left join locations as l 
		on l.id = dl.location_id 
		where l.title = 'magacin' and d.type_id = 1";
		return self::queryAndFetchInObj($sql);
	}
	// *************************************************************************************

	
	public static function changeDeviceLocation ($location_id, $device_id) {
		$sql = "insert into devices_locations values(default,$device_id,$location_id,".$_SESSION['user_id'].",default)";
		return self::executeSQL($sql);
	}
	public static function insertNewDevice ($type_id, $model_id, $sn) {
		$sql = "select insert_new_device('$sn', $type_id, $model_id)";
		return self::executeSQL($sql);
	}
}