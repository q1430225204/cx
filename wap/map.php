<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
define('DT_MEMBER', true);
define('DT_WAP', true);
require '../common.inc.php';
header("Content-type:text/html; charset=utf-8");
require DT_ROOT.'/include/module.func.php';
require 'global.func.php';
include load('wap.lang');
$EXT['wap_enable'] or wap_msg($L['msg_wap_close']);
$wap_modules = array('member', 'sell', 'buy', 'quote', 'company', 'exhibit', 'article', 'info', 'job', 'know', 'brand', 'mall', 'group');
$pagesize = $EXT['wap_pagesize'] ? $EXT['wap_pagesize'] : 10;
$offset = ($page-1)*$pagesize;
$maxlength = $EXT['wap_maxlength'] ? $EXT['wap_maxlength'] : 200;
$pages = '';
$areaid = isset($areaid) ? intval($areaid) : 0;
$head_title = $DT['sitename'].$L['wap_version'];
$kw = $kw ? trim($kw) : '';
if(strtolower($CFG['charset'] != 'utf-8') && $kw) {
	$kw = convert($kw, 'utf-8', $CFG['charset']);
	$DT_URL = convert(urldecode($DT_URL), 'utf-8', $CFG['charset']);
}
if(strlen($kw) < $DT['min_kw'] || strlen($kw) > $DT['max_kw']) $kw = '';
$keyword = $kw ? str_replace(array(' ', '*'), array('%', '%'), $kw) : '';
$len = 30;//title length
$WAP_MODULE = array();
foreach($MODULE as $v) {
	if(in_array($v['module'], $wap_modules) && $v['module'] != 'member' && $v['ismenu']) $WAP_MODULE[] = $v;
}
if(in_array($module, $wap_modules)) {
	if($action == 'category' || $action == 'area') {
		include $action.'.inc.php';
	} else {
		include $module.'.inc.php';
	}
} else {
	include template('map', 'wap');
}
wap_output();
?>