<?php

class Service extends BaseController {
	public function __construct () {
		parent::__construct();
		$this->data['title'] = 'Servis';
	}
	public function index () {
		$this->data['devices_in_service'] = DBDevices::getAllDevicesInService();
		$this->data['repairers'] = DBRepairers::getAllRepairers();
		$this->data['malfunctions'] = DBMalfunctions::getAllMalfunctions();
		$this->show_view('service/service');
	}
	public function showOtherServiceActionsPage () {
		$this->show_view('service/other_actions');
	}
	public function showMalHistory ($pg = 1) {
		if ($pg !== 1) {
			$pg = substr($pg, 1);
			$this->skip = $pg*PG_RESULTS-PG_RESULTS;
		}
		$this->data['malfunction_history'] = DBMalfunctions::getMalfunctionsHistory($this->skip);
		$total_malfunctions_num = $this->data['malfunction_history'][0]->total;
		$this->data['pagination_links'] = $this->preparePaginationLinks($total_malfunctions_num, $pg);
		$this->show_view('service/malfunction_history');
	}
	public function showServiceAdministrationPage () {
		$this->show_view('service/service_administration');
	}
	public function switchDevices($old_device_id, $locations_id, $new_device_id, $malfunction_id, $repairer_id, $comment, $action_type_id, $send_mail = 0) {
		$user_id = $_SESSION['user_id'];
		
		DBServices::makeTerminalSwitch(intval($old_device_id), intval($locations_id), intval($new_device_id), intval($malfunction_id), intval($repairer_id), $comment, intval($user_id), intval($action_type_id));
		header("Location: " . INCL_PATH . "Service/index");
	}
}