<?php

class Locations extends BaseController {
	public function addNewLocation ($location, $priority) {
		$req = DBLocations::addNewLocation($location, $priority);
		if ($req) {
		// if (false) {
			Msg::createMessage("msg1", "Success.");
		} else {
			Msg::createMessage("msg1", "Unsuccess.");
		}
		header("Location: ".INCL_PATH."Storage/locations");
	}
}