<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/

define('DT_MEMBER', true);
define('DT_WAP', true);
require '../common.inc.php';
$session = new dsession();
header("Content-type:text/html; charset=utf-8");
require DT_ROOT.'/include/module.func.php';
require 'global.func.php';
include load('wap.lang');
defined('IN_DESTOON') or exit('Access Denied');
		$MOD['name']='在线留言';
	$table = $DT_PRE.'message';
	
	if($action=='feedback') {
		
		if(md5(md5(strtoupper($code).DT_KEY.$DT_IP))!=$_SESSION['captchastr']){
			echo("<script type='text/javascript'> alert('验证码错误');window.history.back();</script>");
		    exit;
		}
		
		$nowtime=time();
		$query = "INSERT INTO $table SET
				  title             = '$para5',
				  content            = '$para5',
				  typeid            = '$para4',
				  addtime            = '$nowtime',
				  fromuser         = '$para7',
				  touser               = 'admin'";					  
		$db->query($query);
		echo("<script type='text/javascript'> alert('提交成功');window.location.href='/tanhuangw/wap/feedback.php';</script>");
	}	
		 
		include template('feedback', 'wap');
		

?>