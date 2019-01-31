<?php

class SIMs extends BaseController {
	public function __construct () {
		parent::__construct();
		$this->data['title'] = 'SIM';
	}
	public function index ($pg = 1) {
		if ($pg !== 1) {
			$pg = substr($pg, 1);
			$this->skip = $pg*PG_RESULTS-PG_RESULTS;
		}
		$this->data['sim_cards'] = DBSIM::getAllSIM($this->skip);
		$total_sims_num = $this->data['sim_cards'][0]->total;
		$this->data['pagination_links'] = $this->preparePaginationLinks($total_sims_num, $pg);
		$this->show_view('sim/sims');
	}
	public function showSingleSIM($sim_id) {
		$this->data['sim'] = DBSIM::getSingleSIM($sim_id);
		$this->show_view('sim/sim');
	}
	public function putSIMInTerminal ($sim_id, $terminal_id) {
		$req = DBSIM::putSIMInTerminal($sim_id, $terminal_id);
		if ($req) {
		// if (false) {
			Msg::createMessage("msg1", "Success.");
		} else {
			Msg::createMessage("msg1", "Unsuccess.");
		}
		header("Location: ".INCL_PATH."SIMs/index");
	}
	public function splitSIMTerminal ($sim_id, $terminal_id) {
		$req = DBSIM::splitSIMFromTerminal(intval($sim_id), intval($terminal_id));
		if ($req) {
		// if (false) {
			Msg::createMessage("msg1", "Success.");
		} else {
			Msg::createMessage("msg1", "Unsuccess.");
		}
		header("Location: ".INCL_PATH."SIMs/".$sim_id);
	}
	public function addNewSIM ($num, $iccid) {
		$req = DBSIM::addNewSIM($num, $iccid);
		if ($req) {
		// if (false) {
			Msg::createMessage("msg1", "Success.");
		} else {
			Msg::createMessage("msg1", "Unsuccess.");
		}
		header("Location: ".INCL_PATH."SIMs/index");
	}
}