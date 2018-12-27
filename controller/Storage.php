<?php

class Storage extends BaseController {
	public function __construct () {
		parent::__construct();
		$this->data['title'] = 'Magacin';
	}
	public function index () {
		$this->data['locations'] = DBLocations::getAllLocationsForCharges();
		$this->show_view('storage/storage_charges');
	}
	public function showLocationsPage () {
		
		$this->show_view('storage/storage_locations');
	}
	public function showDevicesInPage () {
		$this->data['devices_in_lanus'] = DBDevices::getAllDevicesInLanus();
		$this->show_view('storage/storage_in');
	}
}