<?php

class Service extends BaseController {
	public function __construct () {
		parent::__construct();
		$this->data['title'] = 'Servis';
	}
	public function index () {
		$this->data['devices_in_service'] = DBDevices::getAllDevicesInService();
		$this->show_view('service/service');
	}
	public function malHistory () {
		$this->show_view('service/malfunction_history');
	}
	public function administration () {
		$this->show_view('service/service_administration');
	}
}