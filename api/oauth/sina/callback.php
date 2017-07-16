<?php
require '../../../common.inc.php';
require 'init.inc.php';
$o = new WeiboOAuth(WB_AKEY, WB_SKEY, $_SESSION['keys']['oauth_token'], $_SESSION['keys']['oauth_token_secret']);
$last_key = $o->getAccessToken($_REQUEST['oauth_verifier']);
$_SESSION['last_key'] = $last_key;
dheader('./');
?>