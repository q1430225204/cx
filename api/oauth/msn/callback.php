<?php
require '../../../common.inc.php';
require 'init.inc.php';
$_REQUEST['wrap_verification_code'] or exit;
$par = 'wrap_client_id='.urlencode(WRAP_CLIENT_ID)
	 . '&wrap_client_secret='.urlencode(WRAP_CLIENT_SECRET)
	 . '&wrap_callback='.urlencode(WRAP_CALLBACK)
	 . '&wrap_verification_code='.urlencode($_REQUEST['wrap_verification_code']);
$cur = curl_init(WRAP_ACCESS_URL);
curl_setopt($cur, CURLOPT_POST, 1);
curl_setopt($cur, CURLOPT_POSTFIELDS, $par);
curl_setopt($cur, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($cur, CURLOPT_HEADER, 0);
curl_setopt($cur, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($cur, CURLOPT_RETURNTRANSFER, 1);
$rec = curl_exec($cur);
curl_close($cur);
$pos = strpos($rec, 'wrap_access_token=');
if($pos !== false) {
	$str = substr($rec, $pos, strlen($rec));
	parse_str($str, $par);
	$_SESSION['wrap_access_token'] = $par['wrap_access_token'];
	$_SESSION['wrap_uid'] = $par['uid'];
	dheader('./');
} else {
	dalert('No matches for regular expression.', $MODULE[1]['linkurl']);
}
?>