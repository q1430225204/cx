<?php
require '../../../common.inc.php';
require 'init.inc.php';
$success = 0;
$DS = array();
if($_SESSION['last_key']) {
	$c = new WeiboClient(WB_AKEY, WB_SKEY, $_SESSION['last_key']['oauth_token'], $_SESSION['last_key']['oauth_token_secret']  );
	$ms = $c->home_timeline();
	$me = $c->verify_credentials();
	if($me) {
		$success = 1;
		$openid = $me['id'];
		$nickname = convert($me['screen_name'], 'utf-8', DT_CHARSET);
		$avatar = $me['profile_image_url'];
		$url = $me['url'];
		$DS = array('keys', 'last_key');
	}
}
require '../destoon.inc.php';
?>