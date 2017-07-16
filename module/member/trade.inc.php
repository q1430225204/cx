<?php 
defined('IN_DESTOON') or exit('Access Denied');
login();
require DT_ROOT.'/module/'.$module.'/common.inc.php';
require DT_ROOT.'/include/post.func.php';
$_status = $L['trade_status'];
$dstatus = $L['trade_dstatus'];
$step = isset($step) ? trim($step) : '';
$timenow = timetodate($DT_TIME, 3);
$memberurl = linkurl($MOD['linkurl'], 1);
$myurl = userurl($_username);
$table = $DT_PRE.'mall_order';
$STARS = $L['star_type'];
if($action == 'update') {
	$itemid or message();
	$td = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
	$td or message($L['trade_msg_null']);
	if($td['buyer'] != $_username && $td['seller'] != $_username) message($L['trade_msg_deny']);
	$td['adddate'] = timetodate($td['addtime'], 5);
	$td['updatedate'] = timetodate($td['updatetime'], 5);
	$mallid = $td['mallid'];
	$nav = $_username == $td['buyer'] ? 'action_order' : 'action';
	switch($step) {
		case 'edit_price'://修改价格||确认订单
			if($td['status'] != 0 || $td['seller'] != $_username) message($L['trade_msg_deny']);
			if($DT['trade'] && $_trade == '') message('系统采用了'.$DT['trade_nm'].'担保交易，请先绑定您的'.$DT['trade_nm'].'帐号', '?action=bind');
			if($submit) {
				$fee = dround($fee);
				$fee or message($L['trade_price_fee_null']);
				$fee_name = htmlspecialchars(trim($fee_name));
				$fee_name or message($L['trade_price_fee_name']);
				$status = isset($confirm_order) ? 1 : 0;
				$db->query("UPDATE {$table} SET fee='$fee',fee_name='$fee_name',status=$status,updatetime=$DT_TIME WHERE itemid=$itemid");
				if(isset($confirm_order)) {
					$touser = $td['buyer'];
					$title = lang($L['trade_message_t1'], array($itemid));
					$url = $memberurl.'trade.php?action=order&itemid='.$itemid;
					$content = lang($L['trade_message_c1'], array($myurl, $_username, $timenow, $url));
					$content = ob_template('messager', 'mail');
					send_message($touser, $title, $content);
					//send sms
					if($DT['sms'] && $_sms && $touser && isset($sendsms)) {
						$touser = memberinfo($touser);
						if($touser['mobile'] && $touser['vmobile']) {
							$message = lang('sms->ord_confirm', array($itemid));
							$message = strip_sms($message);
							$word = word_count($message);
							$sms_num = ceil($word/$DT['sms_len']);
							if($sms_num <= $_sms) {
								$sms_code = send_sms($touser['mobile'], $message, $word);
								if(strpos($sms_code, $DT['sms_ok']) !== false) {
									$tmp = explode('/', $sms_code);
									if(is_numeric($tmp[1])) $sms_num = $tmp[1];
									if($sms_num) sms_add($_username, -$sms_num);
									if($sms_num) sms_record($_username, -$sms_num, $_username, $L['trade_sms_confirm'], $itemid);
								}
							}
						}
					}
					//send sms
				}
				message($L['trade_price_edit_success'], $forward, 3);
			} else {
				$head_title = $L['trade_price_title'];
			}
		break;
		case 'detail'://订单详情
			$td['total'] = $td['amount'] + $td['fee'];
			$head_title = $L['trade_detail_title'];
		break;
		case 'confirm_order'://确认订单
			if($td['status'] != 0 || $td['seller'] != $_username) message($L['trade_msg_deny']);
			if($DT['trade'] && $_trade == '') message('系统采用了'.$DT['trade_nm'].'担保交易，请先绑定您的'.$DT['trade_nm'].'帐号', '?action=bind');
			$db->query("UPDATE {$table} SET status=1,updatetime=$DT_TIME WHERE itemid=$itemid");
			$touser = $td['buyer'];
			$title = lang($L['trade_message_t1'], array($itemid));
			$url = $memberurl.'trade.php?action=order&itemid='.$itemid;
			$content = lang($L['trade_message_c1'], array($myurl, $_username, $timenow, $url));
			$content = ob_template('messager', 'mail');
			send_message($touser, $title, $content);
			message($L['trade_confirm_success'], $forward, 3);
		break;
		case 'pay'://买家付款
			if($td['status'] != 1 || $td['buyer'] != $_username) message($L['trade_msg_deny']);
			$money = $td['amount'] + $td['fee'];
			$seller = memberinfo($td['seller']);
			if($DT['trade']) exit(include DT_ROOT.'/api/trade/'.$DT['trade'].'/update.inc.php');
			if($money > $_money) message($L['money_not_enough'], 'charge.php?action=pay&amount='.($money-$_money));
			if($submit) {
				is_payword($_username, $password) or message($L['error_payword']);
				$db->query("UPDATE {$DT_PRE}member SET money=money-$money,locking=locking+$money WHERE username='$_username'");
				$db->query("UPDATE {$table} SET status=2,updatetime=$DT_TIME WHERE itemid=$itemid");

				$touser = $td['seller'];
				$title = lang($L['trade_message_t2'], array($itemid));
				$url = $memberurl.'trade.php?itemid='.$itemid;
				$content = lang($L['trade_message_c2'], array($myurl, $_username, $timenow, $url));
				$content = ob_template('messager', 'mail');
				send_message($touser, $title, $content);			
				//send sms
				if($DT['sms'] && $_sms && $touser && isset($sendsms)) {
					$touser = memberinfo($touser);
					if($touser['mobile'] && $touser['vmobile']) {
						$message = lang('sms->ord_pay', array($itemid, $money));
						$message = strip_sms($message);
						$word = word_count($message);
						$sms_num = ceil($word/$DT['sms_len']);
						if($sms_num <= $_sms) {
							$sms_code = send_sms($touser['mobile'], $message, $word);
							if(strpos($sms_code, $DT['sms_ok']) !== false) {
								$tmp = explode('/', $sms_code);
								if(is_numeric($tmp[1])) $sms_num = $tmp[1];
								if($sms_num) sms_add($_username, -$sms_num);
								if($sms_num) sms_record($_username, -$sms_num, $_username, $L['trade_sms_pay'], $itemid);
							}
						}
					}
				}
				//send sms
				message($L['trade_pay_order_success'], $forward, 3);
			} else {
				$head_title = $L['trade_pay_order_title'];
			}
		break;
		case 'refund'://买家退款
			if($DT['trade']) exit(include DT_ROOT.'/api/trade/'.$DT['trade'].'/update.inc.php');
			$gone = $DT_TIME - $td['updatetime'];
			if($td['status'] != 3 || $td['buyer'] != $_username || $gone > ($MOD['trade_day']*86400 + $td['add_time']*3600)) message($L['trade_msg_deny']);
			$money = $td['amount'] + $td['fee'];
			if($submit) {
				$content or message($L['trade_refund_reason']);
				$db->query("UPDATE {$table} SET status=5,updatetime=$DT_TIME,buyer_reason='$content' WHERE itemid=$itemid");
				message($L['trade_refund_success'], $forward, 3);
			} else {
				$head_title = $L['trade_refund_title'];
			}
		break;
		case 'send_goods'://卖家发货
			if($td['status'] != 2 || $td['seller'] != $_username) message($L['trade_msg_deny']);
			if($DT['trade']) exit(include DT_ROOT.'/api/trade/'.$DT['trade'].'/update.inc.php');
			if($submit) {
				$send_type = htmlspecialchars($send_type);
				$send_no = htmlspecialchars($send_no);
				$send_time = htmlspecialchars($send_time);
				if($DT['trade']) include DT_ROOT.'/api/trade/'.$DT['trade'].'/update.inc.php';
				$db->query("UPDATE {$table} SET status=3,updatetime=$DT_TIME,send_type='$send_type',send_no='$send_no',send_time='$send_time' WHERE itemid=$itemid");

				$touser = $td['buyer'];
				$title = lang($L['trade_message_t3'], array($itemid));
				$url = $memberurl.'trade.php?action=order&itemid='.$itemid;
				$content = lang($L['trade_message_c3'], array($myurl, $_username, $timenow, $url));
				$content = ob_template('messager', 'mail');
				send_message($touser, $title, $content);
			
				//send sms
				if($DT['sms'] && $_sms && $touser && isset($sendsms)) {
					$touser = memberinfo($touser);
					if($touser['mobile'] && $touser['vmobile']) {
						$message = lang('sms->ord_send', array($itemid, $send_type, $send_no, $send_time));
						$message = strip_sms($message);
						$word = word_count($message);
						$sms_num = ceil($word/$DT['sms_len']);
						if($sms_num <= $_sms) {
							$sms_code = send_sms($touser['mobile'], $message, $word);
							if(strpos($sms_code, $DT['sms_ok']) !== false) {
								$tmp = explode('/', $sms_code);
								if(is_numeric($tmp[1])) $sms_num = $tmp[1];
								if($sms_num) sms_add($_username, -$sms_num);
								if($sms_num) sms_record($_username, -$sms_num, $_username, $L['trade_sms_send'], $itemid);
							}
						}
					}
				}
				//send sms
				message($L['trade_send_success'], $forward, 3);
			} else {
				$head_title = $L['trade_send_title'];
				$send_types = explode('|', trim($MOD['send_types']));
				$send_time = timetodate($DT_TIME, 3);
			}
		break;
		case 'add_time'://增加确认收货时间
			if($DT['trade']) exit(include DT_ROOT.'/api/trade/'.$DT['trade'].'/update.inc.php');
			if($td['status'] != 3 || $td['seller'] != $_username) message($L['trade_msg_deny']);
			if($submit) {
				$add_time = intval($add_time);
				$add_time > 0 or message($L['trade_addtime_null']);
				$db->query("UPDATE {$table} SET add_time='$add_time' WHERE itemid=$itemid");
				message($L['trade_addtime_success'], $forward);
			} else {
				$head_title = $L['trade_addtime_title'];
			}
		break;
		case 'receive_goods'://确认收货
			if($DT['trade']) exit(include DT_ROOT.'/api/trade/'.$DT['trade'].'/update.inc.php');
			$gone = $DT_TIME - $td['updatetime'];
			if($td['status'] != 3 || $td['buyer'] != $_username || $gone > ($MOD['trade_day']*86400 + $td['add_time']*3600)) message($L['trade_msg_deny']);
			$money = $td['amount'] + $td['fee'];
			money_lock($_username, -$money);
			money_record($_username, -$money, $L['in_site'], 'system', $L['trade_record_pay'], $L['trade_order_id'].$itemid);
			money_add($td['seller'], $money);
			money_record($td['seller'], $money, $L['in_site'], 'system', $L['trade_record_pay'], $L['trade_order_id'].$itemid);
			$db->query("UPDATE {$table} SET status=4,updatetime=$DT_TIME WHERE itemid=$itemid");
			//更新商品数据
			$db->query("UPDATE {$DT_PRE}mall SET orders=orders+1,sales=sales+$td[number],amount=amount-$td[number] WHERE itemid=$mallid");

			$touser = $td['seller'];
			$title = lang($L['trade_message_t4'], array($itemid));
			$url = $memberurl.'trade.php?itemid='.$itemid;
			$content = lang($L['trade_message_c4'], array($myurl, $_username, $timenow, $url));
			$content = ob_template('messager', 'mail');
			send_message($touser, $title, $content);

			message($L['trade_success'], $forward, 3);//交易成功
		break;
		case 'get_pay'://买家确认超时 卖家申请直接付款
			if($DT['trade']) exit(include DT_ROOT.'/api/trade/'.$DT['trade'].'/update.inc.php');
			$gone = $DT_TIME - $td['updatetime'];
			if($td['status'] != 3 || $td['seller'] != $_username || $gone < ($MOD['trade_day']*86400 + $td['add_time']*3600)) message($L['trade_msg_deny']);
			$money = $td['amount'] + $td['fee'];
			money_lock($td['buyer'], -$money);
			money_record($td['buyer'], -$money, $L['in_site'], 'system', $L['trade_record_pay'], lang($L['trade_buyer_timeout'], array($itemid)));
			money_add($_username, $money);
			money_record($_username, $money, $L['in_site'], 'system', $L['trade_record_pay'], lang($L['trade_buyer_timeout'], array($itemid)));
			$db->query("UPDATE {$table} SET status=4,updatetime=$DT_TIME WHERE itemid=$itemid");
			//更新商品数据
			$db->query("UPDATE {$DT_PRE}mall SET orders=orders+1,sales=sales+$td[number],amount=amount-$td[number] WHERE itemid=$mallid");
			message($L['trade_success'], $forward, 3);//交易成功
		break;
		case 'comment'://交易评价
			if($submit) {
				$star = intval($star);
				in_array($star, array(1, 2, 3)) or $star = 3;
				$content = htmlspecialchars($content);
			}
			if($_username == $td['seller']) {
				if($td['buyer_star']) message('您已经评价过此交易');
				if($submit) {
					$db->query("UPDATE {$table} SET buyer_star=$star WHERE itemid=$itemid");
					$s = 'b'.$star;
					$db->query("UPDATE {$DT_PRE}mall_comment SET buyer_star=$star,buyer_comment='$content',buyer_ctime=$DT_TIME WHERE itemid=$itemid");
					$db->query("UPDATE {$DT_PRE}mall_stat SET bcomment=bcomment+1,`$s`=`$s`+1 WHERE mallid=$mallid");
					message('评价提交成功', $forward);
				}
			} else if($_username == $td['buyer']) {
				if($td['seller_star']) message('您已经评价过此交易');
				if($submit) {
					$db->query("UPDATE {$DT_PRE}mall SET comments=comments+1 WHERE itemid=$mallid");
					$db->query("UPDATE {$table} SET seller_star=$star WHERE itemid=$itemid");
					$s = 's'.$star;
					$db->query("UPDATE {$DT_PRE}mall_comment SET seller_star=$star,seller_comment='$content',seller_ctime=$DT_TIME WHERE itemid=$itemid");
					$db->query("UPDATE {$DT_PRE}mall_stat SET scomment=scomment+1,`$s`=`$s`+1 WHERE mallid=$mallid");
					message('评价提交成功', $forward);
				}
			}
		break;
		case 'comment_detail'://评价详情
			$cm = $db->get_one("SELECT * FROM {$DT_PRE}mall_comment WHERE itemid=$itemid");
			if($submit) {
				$content = htmlspecialchars($content);
				$content or message('解释内容不能为空');
				if($_username == $td['seller']) {
					if($cm['buyer_reply']) message('您已经解释过此评价');
					$db->query("UPDATE {$DT_PRE}mall_comment SET buyer_reply='$content',buyer_rtime=$DT_TIME WHERE itemid=$itemid");
				} else {
					if($cm['seller_reply']) message('您已经解释过此评价');
					$db->query("UPDATE {$DT_PRE}mall_comment SET seller_reply='$content',seller_rtime=$DT_TIME WHERE itemid=$itemid");
				}
				dmsg('解释成功', '?action='.$action.'&step='.$step.'&itemid='.$itemid);
			}
		break;
		case 'close'://关闭交易
			if($_username == $td['seller']) {
				if($td['status'] == 0) {
					$db->query("UPDATE {$table} SET status=9,updatetime=$DT_TIME WHERE itemid=$itemid");
					dmsg($L['trade_close_success'], $forward);
				} else if($td['status'] == 1) {
					$db->query("UPDATE {$table} SET status=9,updatetime=$DT_TIME WHERE itemid=$itemid");
					dmsg($L['trade_close_success'], $forward);
				} else if($td['status'] == 2) {
					$money = $td['amount'] + $td['fee'];
					$db->query("UPDATE {$DT_PRE}member SET money=money+$money,locking=locking-$money WHERE username='$td[buyer]'");
					$db->query("UPDATE {$table} SET status=9,updatetime=$DT_TIME WHERE itemid=$itemid");
					dmsg($L['trade_close_success'], $forward);
				} else if($td['status'] == 8) {
					$db->query("DELETE FROM {$table} WHERE itemid=$itemid");
					dmsg($L['trade_delete_success'], $forward);
				} else { 
					message($L['trade_msg_deny']);
				}
				message($L['trade_close_success'], $forward);
			} else if($_username == $td['buyer']) {
				if($td['status'] == 0) {
					$db->query("DELETE FROM {$table} WHERE itemid=$itemid");
					dmsg($L['trade_delete_success'], $forward);
				} else if($td['status'] == 1) {
					$db->query("UPDATE {$table} SET status=8,updatetime=$DT_TIME WHERE itemid=$itemid");
					dmsg($L['trade_close_success'], $forward);
				} else if($td['status'] == 9) {
					$db->query("DELETE FROM {$table} WHERE itemid=$itemid");
					dmsg($L['trade_delete_success'], $forward);
				} else {
					message($L['trade_msg_deny']);
				}
			}
		break;
	}
} else if($action == 'pay') {
	$MG['trade_pay'] or dalert(lang('message->without_permission_and_upgrade'), 'goback');
	if($submit) {
		$seller = trim($seller);
		$seller or message($L['trade_pay_seller']);
		$seller == $_username and message($L['trade_pay_self']);
		is_user($seller) or message($L['trade_pay_seller_bad']);
		$amount = dround($amount);
		$amount > 0 or message($L['trade_pay_amount']);
		$note = htmlspecialchars($note);
		is_payword($_username, $password) or message($L['error_payword']);
		$amount <= $_money or message($L['money_not_enough'], $MOD['linkurl'].'charge.php?action=pay&amount='.($amount-$_money));
		clear_upload($thumb);
		money_add($_username, -$amount);
		money_record($_username, -$amount, $L['in_site'], 'system', $L['trade_record_payfor'], '('.$seller.')'.$note);
		money_add($seller, $amount);
		money_record($seller, $amount, $L['in_site'], 'system', $L['trade_record_receive'], '('.$_username.')'.$note);
		$touser = $seller;
		$title = $L['trade_message_t5'];
		$content = lang($L['trade_message_c5'], array($myurl, $_username, $timenow, $amount, $note));
		$content = ob_template('messager', 'mail');
		send_message($touser, $title, $content);
		
		//send sms
		if($DT['sms'] && $_sms && $touser && isset($sendsms)) {
			$touser = memberinfo($touser);
			if($touser['mobile'] && $touser['vmobile']) {
				$message = lang('sms->ord_income', array($_username, $amount));
				$message = strip_sms($message);
				$word = word_count($message);
				$sms_num = ceil($word/$DT['sms_len']);
				if($sms_num <= $_sms) {
					$sms_code = send_sms($touser['mobile'], $message, $word);
					if(strpos($sms_code, $DT['sms_ok']) !== false) {
						$tmp = explode('/', $sms_code);
						if(is_numeric($tmp[1])) $sms_num = $tmp[1];
						if($sms_num) sms_add($_username, -$sms_num);
						if($sms_num) sms_record($_username, -$sms_num, $_username, $L['trade_sms_income'], $itemid);
					}
				}
			}
		}
		//send sms

		message(lang($L['trade_pay1_success'], array($seller)), 'record.php', 3);
	} else {
		$m = $db->get_one("SELECT m.truename,m.mobile,c.postcode,c.address FROM {$DT_PRE}member m,{$DT_PRE}company c WHERE m.userid=c.userid AND m.userid=$_userid");
		$send_types = explode('|', trim($MOD['send_types']));
		$head_title = $L['trade_pay_title'];
	}
} else if($action == 'bind') {
	$DT['trade'] or message('系统未开启担保交易接口');
	$member = $db->get_one("SELECT trade,vtrade FROM {$DT_PRE}member WHERE userid=$_userid");
	if($submit) {
		if($member['trade'] && $member['vtrade']) message('您的帐号已经绑定，不可再修改<br/>如果需要修改，请与网站联系');
		if($trade) {
			if($DT['trade'] == 'alipay' && !is_email($trade) && !is_mobile($trade)) message($DT['trade_nm'].'帐号格式不正确');
			$r = $db->get_one("SELECT userid FROM {$DT_PRE}member WHERE trade='$trade' AND vtrade=1");
			if($r) message('帐号绑定已经存在，请检查您的帐号');
		} else {
			$trade = '';
		}
		$db->query("UPDATE {$DT_PRE}member SET trade='$trade',vtrade=0 WHERE userid=$_userid");
		dmsg('更新成功', '?action=bind');
	} else {
		if(!$member['trade']) $member['vtrade'] = 0;
		$head_title = '绑定'.$DT['trade_nm'].'帐号';
	}
} else if($action == 'order') {
	$sfields = $L['trade_order_sfields'];
	$dfields = array('title', 'title ', 'amount', 'fee', 'fee_name', 'seller', 'send_type', 'send_no', 'note');
	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	$mallid = isset($mallid) ? intval($mallid) : 0;
	(isset($seller) && check_name($seller)) or $seller = '';
	isset($fromtime) or $fromtime = '';
	isset($totime) or $totime = '';
	$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
	$fields_select = dselect($sfields, 'fields', '', $fields);
	$status_select = dselect($dstatus, 'status', $L['status'], $status, '', 1, '', 1);
	$condition = "buyer='$_username'";
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
	if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
	if($status !== '') $condition .= " AND status='$status'";
	if($itemid) $condition .= " AND itemid='$itemid'";
	if($mallid) $condition .= " AND mallid=$mallid";
	if($seller) $condition .= " AND seller='$seller'";
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
	$pages = pages($r['num'], $page, $pagesize);		
	$trades = array();
	$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
	$amount = $fee = $money = 0;
	while($r = $db->fetch_array($result)) {
		if($r['status'] == 3) {
			$gone = $DT_TIME - $r['updatetime'];
			if($gone > ($MOD['trade_day']*86400 + $r['add_time']*3600)) {
				$r['lefttime'] = 0;
			} else {
				$r['lefttime'] = secondstodate($MOD['trade_day']*86400 + $r['add_time']*3600 - $gone);
			}
		}
		$r['addtime'] = str_replace(' ', '<br/>', timetodate($r['addtime'], 5));
		$r['updatetime'] = str_replace(' ', '<br/>', timetodate($r['updatetime'], 5));
		$r['dstatus'] = $_status[$r['status']];
		$r['money'] = $r['amount'] + $r['fee'];
		$r['money'] = number_format($r['money'], 2, '.', '');
		$amount += $r['amount'];
		$fee += $r['fee'];
		$trades[] = $r;
	}
	$money = $amount + $fee;
	$money = number_format($money, 2, '.', '');
	$forward = urlencode($DT_URL);
	$head_title = $L['trade_order_title'];
} else {
	$sfields = $L['trade_sfields'];
	$dfields = array('title', 'title ', 'amount', 'fee', 'fee_name', 'buyer', 'buyer_name', 'buyer_address', 'buyer_postcode', 'buyer_mobile', 'buyer_phone', 'send_type', 'send_no', 'note');
	$mallid = isset($mallid) ? intval($mallid) : 0;
	(isset($buyer) && check_name($buyer)) or $buyer = '';
	isset($fields) && isset($dfields[$fields]) or $fields = 0;
	isset($fromtime) or $fromtime = '';
	isset($totime) or $totime = '';
	$status = isset($status) && isset($dstatus[$status]) ? intval($status) : '';
	$fields_select = dselect($sfields, 'fields', '', $fields);
	$status_select = dselect($dstatus, 'status', $L['status'], $status, '', 1, '', 1);
	$condition = "seller='$_username'";
	if($keyword) $condition .= " AND $dfields[$fields] LIKE '%$keyword%'";
	if($fromtime) $condition .= " AND addtime>".(strtotime($fromtime.' 00:00:00'));
	if($totime) $condition .= " AND addtime<".(strtotime($totime.' 23:59:59'));
	if($status !== '') $condition .= " AND status='$status'";
	if($itemid) $condition .= " AND itemid=$itemid";
	if($mallid) $condition .= " AND mallid=$mallid";
	if($buyer) $condition .= " AND buyer='$buyer'";
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition");
	$pages = pages($r['num'], $page, $pagesize);
	$orders = $r['num'];
	$trades = array();
	$result = $db->query("SELECT * FROM {$table} WHERE $condition ORDER BY itemid DESC LIMIT $offset,$pagesize");
	$amount = $fee = $money = 0;
	while($r = $db->fetch_array($result)) {
		if($r['status'] == 3) {
			$gone = $DT_TIME - $r['updatetime'];
			if($gone > ($MOD['trade_day']*86400 + $r['add_time']*3600)) {
				$r['lefttime'] = 0;
			} else {
				$r['lefttime'] = secondstodate($MOD['trade_day']*86400 + $r['add_time']*3600 - $gone);
			}
		}
		$r['addtime'] = str_replace(' ', '<br/>', timetodate($r['addtime'], 5));
		$r['updatetime'] = str_replace(' ', '<br/>', timetodate($r['updatetime'], 5));
		$r['dstatus'] = $_status[$r['status']];
		$r['money'] = $r['amount'] + $r['fee'];
		$r['money'] = number_format($r['money'], 2, '.', '');
		$amount += $r['amount'];
		$fee += $r['fee'];
		$trades[] = $r;
	}
	$money = $amount + $fee;
	$money = number_format($money, 2, '.', '');
	$forward = urlencode($DT_URL);
	$head_title = $L['trade_title'];
}
include template('trade', $module);
?>