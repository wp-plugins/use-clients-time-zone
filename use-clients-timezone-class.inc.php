<?php

class UseClientsTimezone {
	/* Sets the default time zone for PHP scripts to that of the client.
	 * A cookie containing the client's time zone is set on the client the first time that client accesses the site and the page is reloaded.
	 * This cookie is then read by the PHP of this script and used to set the default time zone for PHP scripts.
	 */

	protected $doc_root				= '';
	protected $fallback_timezone	= 'GMT';
	protected $plugin_path			= '';
//	protected $uctz_use_for_admin	= false;

	public function __construct () {
		$this->doc_root				= 'http://'.$_SERVER['SERVER_NAME'];
		$this->plugin_path			= plugins_url('/use-clients-timezone/');
		$this->fallback_timezone	= get_option('use_clients_timezone_fallback_timezone');
		if (!$this->fallback_timezone) {
			$this->fallback_timezone = 'GMT';
			update_option('use_clients_timezone_fallback_timezone', $this->fallback_timezone);
		}
		if (is_admin()) {
/*			$this->uctz_use_for_admin	= get_option('uctz_use_for_admin');
			if ('' == $this->uctz_use_for_admin) {
				$this->uctz_use_for_admin = false;
				update_option('uctz_use_for_admin', $this->uctz_use_for_admin);
			}*/
			add_action('admin_init', array(&$this, 'initialize_admin'));
			add_action('admin_menu', array(&$this, 'admin_add_page'));
		}
	}

	public function admin_add_page() {
		add_options_page('Use Client&#039;s Time Zone Settings', 'Use Client&#039;s Time Zone', 'manage_options', 'use_clients_timezone_plugin', array(&$this, 'draw_options_page'));
	}

	public function draw_options_page () {
		echo '<div><h2>Use Client&#039;s Time Zone Options</h2>';
		echo '<div style="font-size: 0.85em;">Use of this plugin could cause problems with WordPress date operations, although it has not done so for the sites on which the author has tested it. This potential for such problems was pointed out at <a href="https://wordpress.org/support/topic/use-of-date_default_-timezone_set-not-recommended" target="_blank">"Use of date_default_timezone_set not recommended"</a>. Based on this post, it would be wise to check that no date-related operations are going awry -- even though no problems have been observed with the sites tested.</div>';
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

	public function enqueueScripts () {
		wp_register_script('jstimezonedetect', 'https://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js'); // Automatic Timezone Detection Using JavaScript: http://pellepim.bitbucket.org/jstz/
		wp_register_script('jquery-cookie', plugins_url('js/jquery-cookie-1.4.1/jquery.cookie.js', __FILE__), array('jquery')); // jquery-cookie https://github.com/carhartl/jquery-cookie/tree/v1.4.1
		wp_register_script('set_uct_timezone_cookie', plugins_url('js/set_uct_timezone_cookie.js', __FILE__), array('jquery', 'jquery-cookie', 'jstimezonedetect'));
		wp_enqueue_script('jstimezonedetect');
		wp_enqueue_script('jquery-cookie');
		wp_enqueue_script('set_uct_timezone_cookie');
	} 
	
	public function initialize_admin () {
		if (function_exists('register_setting')) {
			$page_for_settings		= 'use_clients_timezone_plugin';
			$section_for_settings	= 'use_clients_timezone_section';
			add_settings_section($section_for_settings, 'Use Client&#039;s Time Zone Settings', array(&$this, 'use_clients_timezone_section_heading'), $page_for_settings);
			add_settings_field('use_clients_timezone_fallback_timezone_id', 'Fallback time zone', array(&$this, 'use_clients_timezone_setting_values'), $page_for_settings, $section_for_settings);
//			add_settings_field('uctz_use_for_admin_id', 'Use client&#039;s time zone for dashboard, also', array(&$this, 'uctz_use_for_admin'), $page_for_settings, $section_for_settings);
			register_setting('use_clients_timezone_settings', 'use_clients_timezone_fallback_timezone', 'wp_filter_nohtml_kses');
//			register_setting('use_clients_timezone_settings', 'uctz_use_for_admin');
		}
	}

/*	public function is_use_for_admin () {
		return $this->uctz_use_for_admin;
	}*/

	public function setTimezone () {
		$uct_cookie_name = 'wordpress_useclientstimezone_timezone';
		if(isset($_COOKIE[$uct_cookie_name])) {
			if (!date_default_timezone_set($_COOKIE[$uct_cookie_name])) {
				date_default_timezone_set($this->fallback_timezone);
			}
		} else {
			date_default_timezone_set($this->fallback_timezone);
		}
	}

	public function use_clients_timezone_section_heading () {
		echo 'Enter the time zone to be used if the plugin is not able to retrieve the client&#039;s time zone (<a href="http://php.net/manual/en/timezones.php" target="_blank">list of supported timezones</a>).<br />Do not enclose entry in quotation marks, either single (&#039;) or double (&quot;).';
	}

	public function use_clients_timezone_setting_values () {
		$use_clients_timezone_fallback_timezone = get_option('use_clients_timezone_fallback_timezone');
		echo '<input id="use_clients_timezone_fallback_timezone_input" name="use_clients_timezone_fallback_timezone" size="35" type="text" value="'.$use_clients_timezone_fallback_timezone.'" />';
	}

/*	public function uctz_use_for_admin () {
		$uctz_use_for_admin = get_option('uctz_use_for_admin');
		echo '<div style="float: left;"><input id="uctz_use_for_admin_input" name="uctz_use_for_admin" type="checkbox" value="1" '.checked(true, $this->uctz_use_for_admin, false).' /></div>';
		echo '<div style="float: left; margin-left: 15px;">Dashboard date: '.date('r').'</div>';
	}*/

}

?>