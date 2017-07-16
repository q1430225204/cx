<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
if(in_array($step, array('refund', 'add_time', 'receive_goods', 'get_pay', 'send_goods'))) {
	dheader('https://lab.alipay.com/consume/queryTradeDetail.htm?tradeNo='.$td['trade_no']);
	//dheader($DT['trade_hm']);
} else if($step == 'xsend_goods') {
	include DT_ROOT.'/api/trade/'.$DT['trade'].'/config.inc.php';
	include DT_ROOT.'/api/trade/'.$DT['trade'].'/'.$api.'/send.inc.php';
} else {
	include DT_ROOT.'/api/trade/'.$DT['trade'].'/config.inc.php';
	$aliapy_config['seller_email'] = $seller['trade'];
	include DT_ROOT.'/api/trade/'.$DT['trade'].'/'.$api.'/pay.inc.php';
}
?>