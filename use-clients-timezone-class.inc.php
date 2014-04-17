<?php

class UseClientsTimezone {
	/* Sets the default time zone for PHP scripts to that of the IP number of the client.
	 */

	protected $document_root		= '';
	protected $fallback_timezone	= 'GMT';
	protected $plugin_path			= '';

	public function __construct () {
		$this->document_root		= 'http://'.$_SERVER['SERVER_NAME'];
		$this->plugin_path			= plugins_url('/use-clients-timezone/');
		$this->fallback_timezone	= get_option('use_clients_timezone_fallback_timezone');
		if (!$this->fallback_timezone) {
			$this->fallback_timezone = 'GMT';
			update_option('use_clients_timezone_fallback_timezone', $this->fallback_timezone);
		}
		add_action('admin_init', array(&$this, 'initialize_admin'));
		add_action('admin_menu', array(&$this, 'admin_add_page'));
	}

	public function initialize_admin () {
		if (function_exists('register_setting')) {
			$page_for_settings		= 'use_clients_timezone_plugin';
			$section_for_settings	= 'use_clients_timezone_section';
			add_settings_section($section_for_settings, 'Use Client&#039;s Time Zone Settings', array(&$this, 'use_clients_timezone_section_heading'), $page_for_settings);
			add_settings_field('use_clients_timezone_fallback_timezone_id', 'Fallback time zone', array(&$this, 'use_clients_timezone_setting_values'), $page_for_settings, $section_for_settings);
			register_setting('use_clients_timezone_settings', 'use_clients_timezone_fallback_timezone', 'wp_filter_nohtml_kses');
		}
	}

	public function use_clients_timezone_section_heading () {
		echo 'Enter the time zone to be used if the plugin is not able to retrieve the client&#039;s time zone (<a href="http://php.net/manual/en/timezones.php" target="_blank">list of supported timezones</a>).<br />Do not enclose entry in quotation marks, either single (&#039;) or double (&quot;).';
	}

	public function use_clients_timezone_setting_values () {
		$use_clients_timezone_fallback_timezone = get_option('use_clients_timezone_fallback_timezone');
		echo '<input id="use_clients_timezone_fallback_timezone_input" name="use_clients_timezone_fallback_timezone" size="35" type="text" value="'.$use_clients_timezone_fallback_timezone.'" />';
	}

	public function admin_add_page() {
		add_options_page('Use Client&#039;s Time Zone Settings', 'Use Client&#039;s Time Zone', 'manage_options', 'use_clients_timezone_plugin', array(&$this, 'draw_options_page'));
	}

	public function draw_options_page () {
		echo '<div><h2>Use Client&#039;s Time Zone Options</h2>';
		echo '<form method="post" action="options.php">';
		settings_fields('use_clients_timezone_settings');
		do_settings_sections('use_clients_timezone_plugin');
		echo '<p><input name="Submit" type="submit" value="';
		esc_attr_e('Save Changes');
		echo '" /></p>';
		echo '</form></div>';
		echo '<div style="width: 50%; margin-top: 25px;">If you find this plugin of value, please contribute to the cost of its developement:<div style="margin: auto; text-align: center"><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="RNEZMH62QWKQE">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form></div></div>';
	}

	public function setTimezone () {
		// Get time at user's IP, if possible, otherwise use the fallback time zone (GMT, if no time zone is specified in the dashboard settings).
		$ip		= $_SERVER['REMOTE_ADDR'];
		$json	= file_get_contents("http://api.easyjquery.com/ips/?ip=".$ip."&full=true");
		if (false === $json) {
			date_default_timezone_set($this->fallback_timezone);
		} else {
			$json_decoded	= json_decode($json, true);
			$time_zone		= $json_decoded['localTimeZone'];
			if ($time_zone) {
				date_default_timezone_set($time_zone);
			} else {
				date_default_timezone_set($this->fallback_timezone);
			}
		}
	}

}

?>