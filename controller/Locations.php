<?php

class Locations extends BaseController {
	public function addNewLocation ($location, $priority, $distributor_id = 0) {
		$req = DBLocations::addNewLocation($location, intval($priority), intval($distributor_id));
		if ($req) {
		// if (false) {
			Msg::createMessage("msg1", "Success.");
		} else {
			Msg::createMessage("msg1", "Unsuccess.");
		}
		header("Location: ".INCL_PATH."Storage/locations");
	}
}