<?php
/**
 * @package Use Client's Time Zone
 * @version 1.1.4
 */

/*
Plugin Name: Use Client's Time Zone
Plugin URI:
Description: The first time that a client accesses the site the time zone of the client is retrieved using "Automatic Timezone Detection Using JavaScript" (http://pellepim.bitbucket.org/jstz/), a cookie containing the client's time zone is set on the client, and the page is reloaded. This cookie is then read by the PHP of this script which uses the date_default_timezone_set() function (requires PHP 5 >= 5.1.0) to set the default time zone for PHP scripts. Since it runs just after all of the plugins are loaded, it changes the time zone for all of the PHP that follows. It is useful in cases where one wants users to see certain posts on certain days. E.g., if the post slug contains the day number, like "xyz-daynr," then the post can be specified by "$slug = 'xyz'.date(j);" in a theme template. The cookie does not expire for ten years, but is reset if the user changes time zones. So, unless the user deletes cookies or moves the page reload only occurs once every ten years.
Version: 1.1.4
Author: M.D. Green
Author URI: http://saesolved.com/

Copyright 2012-2015 M.D. Green, SaeSolved:: LLC

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the
Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

*/

	include_once('use-clients-timezone-class.inc.php');
	include_once('use-clients-timezone-hooks.inc.php');

?>