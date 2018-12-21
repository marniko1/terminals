<?php

class Charges extends BaseController {
	public function __construct () {
		parent::__construct();
		$this->data['title'] = 'Zaduženja';
	}
	public function index ($pg = 1) {
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
		$this->show_view('charges');
	}
	public function makeCharge () {
		$user_id = $_SESSION['user_id'];
		$params = func_get_args();
		$sql_values = ' ';
		foreach ($params as $key => $param) {
			if ($key != 0) {
				$sql_values .= "(default, $param, $params[0], $user_id, default),";
			}
		}
		$sql_values = rtrim($sql_values, ',');
		DBCharges::makeNewCharge($sql_values);
		header("Location: " . INCL_PATH . "Charges/index");
	}
}