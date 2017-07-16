<?php
require '../../../common.inc.php';
require 'init.inc.php';
$success = 0;
$DS = array();
if($_SESSION['wrap_access_token']) {
	$openid = $_SESSION['wrap_uid'];
	$url = 'http://apis.live.net/V4.1/cid-'.$openid.'/Profiles/1-'.$openid;
	$head = array(
		'Accept: application/json',
		'Content-Type: application/json',
		'Authorization: WRAP access_token='.$_SESSION['wrap_access_token']
	);
	$cur = curl_init($url);
	curl_setopt($cur, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($cur, CURLOPT_HEADER, 0);
	curl_setopt($cur, CURLOPT_HTTPHEADER, $head);
	curl_setopt($cur, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($cur, CURLOPT_RETURNTRANSFER, 1);
	$rec = curl_exec($cur);
	curl_close($cur);
	$arr = json_decode($rec, true);
	if(isset($arr['Emails'])) {
		$success = 1;
		if(isset($arr['FirstName'])) {
			$nickname = convert($arr['FirstName'], 'utf-8', DT_CHARSET);
		} else {
			$nickname = $arr['Emails'][0]['Address'];
			$nickname = str_replace(strstr($nickname, '@'), '', $nickname);
		}
		$avatar = isset($arr['ThumbnailImageLink']) ? $arr['ThumbnailImageLink'] : '';
		$url = isset($arr['UxLink']) ? $arr['UxLink'] : 'http://cid-'.$openid.'.profile.live.com/';
		$DS = array('wrap_access_token', 'wrap_uid');
	}
}
require '../destoon.inc.php';
?>