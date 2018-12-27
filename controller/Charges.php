<?php

class Charges extends BaseController {
	public function __construct () {
		parent::__construct();
		$this->data['title'] = 'Zaduženja';
	}
	public function index ($pg = 1) {
		$this->data['locations'] = DBLocations::getAllLocationsForCharges();
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
		header("Location: " . INCL_PATH . "Storage/panel");
	}
}