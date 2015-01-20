/* This script sets a cookie containing the time zone for the client computer so that PHP can read that time zone offset in order to set the time zone
 * for PHP scripts to be that of the client. It uses jquery-cookie (https://github.com/carhartl/jquery-cookie/tree/v1.4.1) and Automatic Timezone 
 * Detection Using JavaScript (http://pellepim.bitbucket.org/jstz/).
 */
var uct_timezone		= jstz.determine();
var uct_timezone_name	= uct_timezone.name();
var exp_days			= 3650; // ten years until expiration. 
var uct_cookie_name		= 'wordpress_useclientstimezone_timezone';
jQuery.cookie.raw = true;
if (jQuery.cookie(uct_cookie_name) === undefined) {
	// No cookie set. Set one, then reload.
	jQuery.cookie(uct_cookie_name, uct_timezone_name, {expires: exp_days});
	location.reload(true);
} else {
	if (jQuery.cookie(uct_cookie_name) != uct_timezone_name) {
		// Time zone has changed. Change cookie, then reload.
		jQuery.cookie(uct_cookie_name, uct_timezone_name, {expires: exp_days});
		location.reload(true);	
	}
}
// Cookie is either there and correct or has been set or changed, as appropriate, and the page reloaded if changes are made. 
// It is now there for PHP to read.