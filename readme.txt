=== Use Client's Time Zone ===
Contributors: drmikegreen
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=XR9J849YUCJ3A
Tags: Time zone, default time zone, client's time zone,
Requires at least: 1.5
Tested up to: 4.3
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Sets the default time zone for PHP scripts to that of the client.

== Description ==

This plugin retrieves the time zone of the client using "Automatic Timezone Detection Using JavaScript" (http://pellepim.bitbucket.org/jstz/) the first time that a client accesses the site, sets a cookie containing the client's time zone on the client, and reloads the page. This cookie is then read by PHP and the date_default_timezone_set() function (requires PHP 5 >= 5.1.0) is used to set the default time zone for PHP scripts. Since it runs just after all of the plugins are loaded, it changes the time zone for all of the PHP that follows. It is useful in cases where one wants users to see certain posts on certain days. E.g., if the post slug contains the day number, like "xyz-daynr," then the post can be specified by "$slug = 'xyz'.date(j);" in a theme template. The cookie does not expire for ten years, but is reset if the user changes time zones. So, unless the user deletes cookies or moves the page reload only occurs once every ten years.

Copyright 2012-2015 M.D. Green, SaeSolved:: LLC

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

The information on the site (in the example "A Word for Today") will be for the day of the client, not the day of the server (which it would be without the plugin).

You can test this by changing the time on your computer to be in a time zone which is in a different day. E.g., if you live in New York, change the time zone on your computer to that of Sydney. You should see the information (in the case of the example) for the next day. (Check a site like http://www.timeanddate.com/ to be sure to get a time zone which is in a different day than the one normally set on your computer.)

== Other Notes ==

1. A note was posted in our forum stating that sites may experience problems if changing timezones using date_default_timezone_set. WP expects it to always be UTC and display of things in different timezones are achieved in other ways:
* <https://vip.wordpress.com/documentation/vip-development-tips-tricks/use-current_time-not-date_default_timezone_set/>
* <[https://weston.ruter.net/2013/04/02/do-not-change-the-default-timezone-from-utc-in-wordpress/>

1. To do: Develop, if possible, a way to effect the use of methods, other than using the date_default_timezone_set() function, to produce the same functionality the plugin currently has.

== Screenshots ==

1. Settings page.

== Upgrade Notice ==

= 1.1.4 =
Added advice to check that no dated-related operations were adversely impacted by this plugin.

= 1.1.3 =
Changed cookie path to be site-wide.

= 1.1.2 =
Changed JavaScript so that the page is not reloaded if cookies are not enabled on the client.

= 1.1.1 =
Glitch fix: JavaScript directory and files had not been properly SVN-added. This update is to correct that.

= 1.1 =
Method for obtaining client time zone changed from attempting to retrieve time zone of IP to setting a cookie containing the clients time zone, then reading that cookie.

= 1.0 =
Original release.

== Changelog ==

= 1.1.4 =
Added advice to check that no dated-related operations were adversely impacted by this plugin.

= 1.1.3 =
Changed cookie path to be site-wide.

= 1.1.2 =
Changed JavaScript so that the page is not reloaded if cookies are not enabled on the client.

= 1.1 =
Method for obtaining client time zone changed from attempting to retrieve time zone of IP to setting a cookie containing the clients time zone, then reading that cookie.

= 1.0 =
Original release.
