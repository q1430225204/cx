<?php
defined('IN_DESTOON') or exit('Access Denied');
$OAUTH = cache_read('oauth.php');
$site = 'msn';
$OAUTH[$site]['enable'] or dheader($MODULE[1]['linkurl']);
$session = new dsession();

// Application Specific Globals
define('WRAP_CLIENT_ID', $OAUTH[$site]['id']);
define('WRAP_CLIENT_SECRET', $OAUTH[$site]['key']);
define('WRAP_CALLBACK', DT_PATH.'api/oauth/'.$site.'/callback.php');

// Live URLs required for making requests.
define('WRAP_CONSENT_URL', 'https://consent.live.com/Connect.aspx');
define('WRAP_ACCESS_URL', 'https://consent.live.com/AccessToken.aspx');
define('WRAP_REFRESH_URL', 'https://consent.live.com/RefreshToken.aspx');
?>