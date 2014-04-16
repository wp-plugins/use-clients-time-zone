<?php
/**
 * @package Use Client's Time Zone
 * @version 1.0
 */

/*
Plugin Name: Use Client's Time Zone
Plugin URI:
Description: Retrieves the time zone of the IP number of the client using http://api.easyjquery.com/ips/. It then uses the PHP date_default_timezone_set() function to set the default time zone. Since it runs just after all of the plugins are loaded, it changes the time zone for all of the PHP that follows. It is useful in cases where one wants users to see certain posts on certain days. E.g., if the post slug contains the day number, like "xyz-daynr," then the post can be specified by "$slug = 'xyz'.date(j);" in a theme template.
Version: 1.0
Author: M.D. Green
Author URI: http://saesolved.com/

Copyright 2012 M.D. Green, SaeSolved:: LLC

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the
Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

*/

	include_once('use-clients-timezone-class.inc.php');
	include_once('use-clients-timezone-hooks.inc.php');

?>