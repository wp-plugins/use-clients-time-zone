=== Use Client's Time Zone ===
Contributors: drmikegreen
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=XR9J849YUCJ3A
Tags: Time zone, default time zone, client's time zone,
Requires at least: 1.5
Tested up to: 3.9
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Sets the default time zone for PHP scripts to that of the IP number of the client.

== Description ==

This plugin retrieves the time zone of the IP number of the client using http://api.easyjquery.com/ips/. It then uses the PHP date_default_timezone_set() function to set the default time zone. Since it runs just after all of the plugins are loaded, it changes the time zone for all of the PHP that follows. It is useful in cases where one wants users to see certain posts on certain days. E.g., if the post slug contains the day number, like "xyz-daynr," then the post can be specified by "$slug = 'xyz'.date(j);" in a theme template.

Copyright 2012-2014 M.D. Green, SaeSolved:: LLC

== License ==

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the
Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

== Installation ==

1. Extract the use-clients-timezone folder and place in the wp-content/plugins folder.

1. Enable the plugin.

1. Set the fallback time zone under Settings->Use Client's Timezone. (The time zone to use if the script fails to get the client's time zone.)

== Frequently Asked Questions ==

= Where can I see a working example of this plugin? =

http://prayercentral.net/devotionals/a-word-for-today/.

== Screenshots ==

1. Settings page.

== Upgrade Notice ==

= 1.0 =
Original release.

== Changelog ==

= 1.0 =
Original release.
