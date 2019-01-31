<?php

class Distributors extends BaseController {
	public function addNewDistributor ($new_distributor) {
		$req = DBDistributors::addNewDistributor($new_distributor);
		if ($req) {
		// if (false) {
			Msg::createMessage("msg1", "Success.");
		} else {
			Msg::createMessage("msg1", "Unsuccess.");
		}
		header("Location: ".INCL_PATH."Storage/locations");
	}
}