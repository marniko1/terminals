<?php

class Storage extends BaseController {
	public function __construct () {
		parent::__construct();
		$this->data['title'] = 'Magacin';
	}
	public function index () {
		// if ($pg !== 1) {
		// 	$pg = substr($pg, 1);
		// 	$this->skip = $pg*PG_RESULTS-PG_RESULTS;
		// }
		// $this->data['devices'] = DBDevices::getAllDevices($this->skip);
		// $this->data['models'] = DBModels::getAllDevicesModels();
		// $this->data['types'] = DBTypes::getAllTypes();
		$this->data['locations'] = DBLocations::getAllLocationsForCharges();
		// $this->data['software_v'] = DBSoftwareVersions::getAllSoftwareV();
		// $total_devices_num = $this->data['devices'][0]->total;
		// $this->data['pagination_links'] = $this->preparePaginationLinks($total_devices_num, $pg);
		$this->show_view('storage_charges');
	}
	public function showLocationsPage () {
		
		$this->show_view('storage_locations');
	}
	public function showDevicesInPage () {
		
		$this->show_view('storage_in');
	}
}