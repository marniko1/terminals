<?php

class Devices extends BaseController {
	public function __construct () {
		parent::__construct();
		$this->data['title'] = 'Uređaji';
	}
	public function index ($pg = 1) {
		if ($pg !== 1) {
			$pg = substr($pg, 1);
			$this->skip = $pg*PG_RESULTS-PG_RESULTS;
		}
		$this->data['devices'] = DBDevices::getAllDevices($this->skip);
		$this->data['types'] = DBTypes::getAllTypes();
		$this->data['models'] = DBModels::getAllDevicesModels();
		$this->data['softwares'] = DBSoftware::getAllSoftwares();
		$total_devices_num = $this->data['devices'][0]->total;
		$this->data['pagination_links'] = $this->preparePaginationLinks($total_devices_num, $pg);
		$this->show_view('devices');
	}
	public function showSingleDevice ($id) {
		$this->data['device'] = DBDevices::getSingleDevice($id);
		$this->show_view('device');
	}
	public function changeDeviceLocation ($location_id, $device_id) {
		$req = DBDevices::changeDeviceLocation($location_id, $device_id);
		if ($req) {
		// if (false) {
			Msg::createMessage("msg1", "Success.");
		} else {
			Msg::createMessage("msg1", "Unsuccess.");
		}
		header("Location: ".INCL_PATH."Storage/locations");
	}
	public function addNewDevice ($type_id, $model_id = 0, $sn) {
		$req = DBDevices::insertNewDevice(intval($type_id), intval($model_id), $sn);
		if ($req) {
		// if (false) {
			Msg::createMessage("msg1", "Success.");
		} else {
			Msg::createMessage("msg1", "Unsuccess.");
		}
		header("Location: ".INCL_PATH."Storage/device");
	}
}