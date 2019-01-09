<?php

class DBServices extends DB {
	public static function makeTerminalSwitch ($old_device_id, $locations_id, $new_device_id, $malfunction_id, $repairer_id, $comment, $user_id, $action_type_id) {
		$sql = "select switch_devices($old_device_id, $locations_id, $new_device_id, $malfunction_id, $repairer_id, '$comment', $user_id, $action_type_id)";
		$req = self::executeSQL($sql);
		return $req;
	}
}