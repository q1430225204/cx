<?php
require '../../../common.inc.php';
require 'init.inc.php';
$success = 0;
$DS = array();
if($_SESSION['token']) {
	function get_user_info($appid, $appkey, $access_token, $access_token_secret, $openid) {
		$url    = "http://openapi.qzone.qq.com/user/get_user_info";
		$info   = do_get($url, $appid, $appkey, $access_token, $access_token_secret, $openid);
		$arr = array();
		$arr = json_decode($info, true);
		return $arr;
	}
	$arr = get_user_info(QQ_APPID, QQ_APPKEY, $_SESSION["token"], $_SESSION["secret"], $_SESSION["openid"]);
	$arr or dalert('Error calling API. Please try later.', $MODULE[1]['linkurl']);
	$success = 1;
	$openid = $_SESSION['openid'];
	$nickname = convert($arr['nickname'], 'utf-8', DT_CHARSET);
	$avatar = $arr['figureurl_1'];
	$url = '';
	$DS = array('token', 'secret', 'openid');
}
require '../destoon.inc.php';
?>