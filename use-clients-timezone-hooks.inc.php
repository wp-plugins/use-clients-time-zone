<?php

if (class_exists('UseClientsTimezone')) {
	$use_clients_timezone = new UseClientsTimezone();
	if (isset($use_clients_timezone)) {
		add_action('plugins_loaded', array(&$use_clients_timezone, 'setTimezone'), 1);
	}
}

?>