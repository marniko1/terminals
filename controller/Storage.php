<?php

class Storage extends BaseController {
	public function __construct () {
		parent::__construct();
		$this->data['title'] = 'Magacin';
	}
	public function index () {
		$this->data['locations'] = DBLocations::getAllLocationsForCharges();
		$this->data['terminals_in_storage'] = DBDevices::getAllDevicesInStorage(2);
		$this->data['qproxes_in_storage'] = DBDevices::getAllDevicesInStorage(1);
		$this->show_view('storage/storage_charges');
	}
	public function showLocationsPage () {
		$this->data['distributors'] = DBDistributors::getAllDistributors();
		$this->show_view('storage/storage_locations');
	}
	public function showDevicesInPage () {
		$this->data['devices_in_lanus'] = DBDevices::getAllDevicesInLanus();
		$this->show_view('storage/storage_in');
	}
	public function showDeviceAddingPage () {
		$this->data['types'] = DBTypes::getAllTypes();
		$this->data['models'] = DBModels::getAllDevicesModels();
		$this->show_view('storage/storage_device_adding');
	}
}