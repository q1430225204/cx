<?php
require '../../../common.inc.php';
require 'init.inc.php';
$o = new WeiboOAuth( WB_AKEY , WB_SKEY);
$keys = $o->getRequestToken();
$aurl = $o->getAuthorizeURL($keys['oauth_token'], false, DT_PATH.'api/oauth/'.$site.'/callback.php');
$_SESSION['keys'] = $keys;
dheader($aurl);
?>