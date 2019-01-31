<?php

class AjaxCalls extends BaseController {

	public $method;
	public $pg;
	public $id;
	public $skip;
	public $search_value;
	public $device;
	public $params = [];
	public $counter_data = [];

	public function __construct () {
		$this->method = $_POST['ajax_fn'];
		if (isset($_POST['pg'])) {
			$this->pg = $_POST['pg'];
			$this->skip = $_POST['pg']*PG_RESULTS-PG_RESULTS;
		}
		if (isset($_POST['search_value'])) {
			$this->search_value = $_POST['search_value'];
		}
		if (isset($_POST['id'])) {
			$this->id = $_POST['id'];
		}
		if (isset($_POST['device'])) {
			$this->device = $_POST['device'];
		}
	}

	public function index () {
		$method = $this->method;
		$this->$method();
	}

// for proposals

	public function SIMFilter () {
		$response = DBSIM::getFilteredSIMsForTerminal($this->search_value);
		echo json_encode($response);
	}

	public function terminalFilter () {
		$response = DBDevices::getFilteredTerminalsForSIMs($this->search_value);
		echo json_encode($response);
	}

	public function locationFilter () {
		$response = DBLocations::getAllLocationsInProposals($this->search_value);
		echo json_encode($response);
	}

	public function deviceFilter () {
		$response = DBDevices::getFilteredDevicesForLocationChange($this->search_value);
		echo json_encode($response);
	}

	public function devicesInStorageFilter () {
		$response = DBDevices::getFilteredDevicesForCharge($this->search_value);
		echo json_encode($response);
	}

	public function devicesInLanusFilter () {
		$response = DBDevices::getFilteredDevicesInLanus($this->search_value);
		echo json_encode($response);
	}

	public function devicesOnOtherLocationsFilter () {
		$response = DBDevices::getFilteredDevicesOnOtherLocations($this->search_value);
		echo json_encode($response);
	}

	public function devicesInServiceFilter () {
		$response = DBDevices::getFilteredDevicesInService($this->search_value);
		echo json_encode($response);
	}
// **********************************************************************************************
// for filter and pagination*********************************************************************

	public function serviceFilter () {
		$this->params = json_decode($_POST['params']);
		$sql_addon = $this->makeAdditionalConditionsStringSQL($this->params);
		$filtered_data = DBMalfunctions::getFilteredMalfunctionHistory('malfunctions', $this->search_value, $this->skip, $sql_addon);
		$this->ajaxResponse($filtered_data);
	}

	public function devicesFilter () {
		$this->params = json_decode($_POST['params']);
		$sql_addon = $this->makeAdditionalConditionsStringSQL($this->params);
		$filtered_data = DBDevices::getFilteredDevices('device', $this->search_value, $this->skip, $sql_addon);
		$this->ajaxResponse($filtered_data);
	}

	public function simsFilter () {
		$this->params = json_decode($_POST['params']);
		$sql_addon = $this->makeAdditionalConditionsStringSQL($this->params);
		$filtered_data = DBSIM::getFilteredSIMs('sim', $this->search_value, $this->skip, $sql_addon);
		$this->ajaxResponse($filtered_data);
	}
// *********************************************************************************************
// for counters*********************************************************************************

	public function terminalsCounter () {

		$this->counter_data[] = DBDevices::countTerminalsInStorage()[0]->count;
		$this->counter_data[] = DBDevices::countTerminalsInService()[0]->count;
		$this->counter_data[] = DBDevices::countTerminalsInLanus()[0]->count;
		$final_counter_data[] = $this->counter_data;
		$this->counter_data = [];
		$this->counter_data[] = DBDevices::countLanusTerminalsInStorage()[0]->count;
		$this->counter_data[] = DBDevices::countLanusTerminalsInService()[0]->count;
		$this->counter_data[] = DBDevices::countLanusTerminalsInLanus()[0]->count;
		$final_counter_data[] = $this->counter_data;
		$this->counter_data = [];
		$this->counter_data[] = DBDevices::countCertusTerminalsInStorage()[0]->count;
		$this->counter_data[] = DBDevices::countCertusTerminalsInService()[0]->count;
		$this->counter_data[] = DBDevices::countCertusTerminalsInLanus()[0]->count;
		$final_counter_data[] = $this->counter_data;
		$this->counter_data = [];


		
		
		echo json_encode($final_counter_data);
	}

	public function qproxCounter () {
		$this->counter_data[] = DBDevices::countQproxInStorage()[0]->count;
		$final_counter_data[] = $this->counter_data;
		echo json_encode($final_counter_data);
	}
// *********************************************************************************************

	public function ajaxResponse ($filtered_data) {
		$total_num = 0;
		if (isset($filtered_data[0]->total)) {
			$total_num = $filtered_data[0]->total;
		}
		$pagination_data = $this->preparePaginationLinks($total_num, $this->pg);
		$response = [$filtered_data, $pagination_data, $this->skip];
		echo json_encode($response);
	}
	public function makeAdditionalConditionsStringSQL ($params_obj) {
		$sql_addon = '';
		$table = '';
		foreach ($params_obj as $key => $param) {
			if ($param != '' && $key != 'active' && $key != 'sim_purpose' && $key != 'date_from' && $key != 'date_to') {
				switch ($key) {
					case 'type':
						$table = 't';
						break;

					case 'model':
						$table = 'm';
						break;

					case 'location':
						$table = 'l';
						break;

					case 'software':
						$table = 's';
						break;
					
					default:
						// do nothing here
						break;
				}
				$sql_addon .= ' and ' . "cast($table.id as text) = '$param' ";
			}
			if ($key == 'date_from' && $param != '') {
				$sql_addon .= " and to_char(mh.date, 'YYYY-MM-DD') >= '$param'";
			}
			if ($key == 'date_to' && $param != '') {
				$sql_addon .= " and to_char(mh.date, 'YYYY-MM-DD') <= '$param'";
			}
			if ($key == 'sim_purpose' && $param != '') {
				$sql_addon .= " and purpose = '$param' ";
			}
			if ($key == 'active' && $param == 1) {
				$sql_addon .= " and dwo.id is null ";
			} else if ($key == 'active' && $param == 2) {
				$sql_addon .= " and dwo.id is not null ";
			}
			
		}
		return $sql_addon;
	}
}