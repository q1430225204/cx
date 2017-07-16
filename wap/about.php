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
defined('IN_DESTOON') or exit('Access Denied');
	$table = $DT_PRE.'webpage';
	if($itemid) {
		$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
		$content=$item['content'];
		$MOD['name']=$item['title'];
		
		if($itemid==1){
			include template('about', 'wap');
		}else if($itemid==2){
			include template('contactus', 'wap');
		}
	
	} 

?>