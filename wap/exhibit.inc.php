<?php
/*
	
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$table = $DT_PRE.'exhibit';
$table_data = $DT_PRE.'exhibit_data';
if($itemid) {
	$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
	($item && $item['status'] > 2) or wap_msg($L['msg_not_exist']);
	extract($item);
	$CAT = get_cat($catid);
	if(!check_group($_groupid, $MOD['group_show']) || !check_group($_groupid, $CAT['group_show'])) wap_msg($L['msg_no_right']);
	$description = '';
	$user_status = 3;
	$fee = get_fee($item['fee'], $MOD['fee_view']);
	require $action == 'pay' ? 'pay.inc.php' : 'content.inc.php';
	$content_table = content_table($moduleid, $itemid, $MOD['split'], $table_data);
	$content = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
	$content = $content['content'];
	$content = strip_tags($content);
	$content = preg_replace("/\&([^;]+);/i", '', $content);
	if($user_status == 2) $description = get_description($content, $MOD['pre_view']);
	$contentlength = strlen($content);
	if($cat=='appshow' or $cat=='wxappshow'){
		//APP取消详情页详细信息分页
	}else{
	if($contentlength > $maxlength) {
		$start = ($page-1)*$maxlength;
		$content = dsubstr($content, $maxlength, '', $start);
		$pages = wap_pages($contentlength, $page, $maxlength);
	}
	}
	$content = nl2br($content);
	$fromdate = timetodate($fromtime, 3);
	$todate = timetodate($totime, 3);
	if($page == 1) $db->query("UPDATE {$table} SET hits=hits+1 WHERE itemid=$itemid");
	$head_title = $title.$DT['seo_delimiter'].$MOD['name'].$DT['seo_delimiter'].$head_title;
} else {
	if($kw) {
		check_group($_groupid, $MOD['group_search']) or wap_msg($L['msg_no_search']);
	} else if($catid) {
		$CAT or wap_msg($L['msg_not_cate']);
		if(!check_group($_groupid, $MOD['group_list']) || !check_group($_groupid, $CAT['group_list'])) {
			wap_msg($L['msg_no_right']);
		}
	} else {
		check_group($_groupid, $MOD['group_index']) or wap_msg($L['msg_no_right']);
	}
	$head_title = $MOD['name'].$DT['seo_delimiter'].$head_title;
	if($kw) $head_title = $kw.$DT['seo_delimiter'].$head_title;
	$condition = "status>2";
	if($keyword) $condition .= " AND keyword LIKE '%$keyword%'";
	if($catid) $condition .= $CAT ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";
	if($areaid) $condition .= $ARE['child'] ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition", 'CACHE');
	$items = $r['num'];
	$pages = wap_pages($items, $page, $pagesize);
	$lists = array();
	if($items) {
		$order = $MOD['order'];
		$result = $db->query("SELECT itemid,catid,title,fromtime,totime,city FROM {$table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['title'] = dsubstr($r['title'], $len);
			$lists[] = $r;
		}
		$db->free_result($result);
	}
}
$moduleid = 8;
if($cat=="app"){
	//$areaid=0;
$lists=array();
//var_dump("SELECT itemid,catid,title,addtime,edittime,areaid,vip FROM {$table} WHERE chexing='高栏'  LIMIT 0,5");
$condition='WHERE status=3 ';
//var_dump("SELECT * FROM {$table} $condition order by addtime desc LIMIT 0,5");
	$result = $db->query("SELECT * FROM {$table} $condition order by addtime desc LIMIT 0,10");
	while($r = $db->fetch_array($result)) {
			//$result2 = $db->get_one("SELECT * FROM {$DT_PRE}category WHERE catid =".$r['catid']."");
			//$r['catname']=$result2['catname'];
			$lists[] = $r;
		}
		//var_dump($lists);
	include template('list-exhibit_app', 'app');
	exit;
}
if($cat=="wxapp"){
	//$areaid=0;
$lists=array();
//var_dump("SELECT itemid,catid,title,addtime,edittime,areaid,vip FROM {$table} WHERE chexing='高栏'  LIMIT 0,5");
if($list=='list'){
	$pagesize = '10';
}elseif($list=='search'){
	$pagesize = '20';	
}else{
	$pagesize = '5';
}
$page = isset($page) ? max(intval($page), 1) : 1;
$offset = ($page-1)*$pagesize;
$condition='WHERE status=3 ';
	$result = $db->query("SELECT * FROM {$table} $condition order by addtime desc LIMIT {$offset},{$pagesize}");
	while($r = $db->fetch_array($result)) {
			if(!$r['thumb'])$r['thumb']='http://'.$_SERVER['SERVER_NAME']."/app/img/nopic.png";
			$r['adddate']=timetodate($r['addtime'], 3);
			$lists[] = $r;
		}
		//var_dump($lists);
		echo json_encode($lists) ;
	//include template('list-exhibit_app', 'app');
	exit;
}
if($cat=='appshow'){
	include template('show-exhibit_app', 'app');
	exit;
}
if($cat=='wxappshow'){
	$z=strpos($item['thumb'],".thumb");  
	if($z )$item['thumb']=substr($item['thumb'], 0,$z);
	$result2 = $db->get_one("SELECT * FROM {$DT_PRE}category WHERE catid =".$item['catid']."");
	$item['catname']=$result2['catname'];
	$item['adddate']=timetodate($item['addtime'], 3);
	$item['fromdate']=timetodate($item['fromdate'], 3);
	$item['todate']=timetodate($item['todate'], 3);
	$content=str_replace("<br />","",$content);
	$search = array ("'<script[^>]*?>.*?</script>'si", // 去掉 javascript 
"'<[\/\!]*?[^<>]*?>'si", // 去掉 HTML 标记 
"'([\r\n])[\s]+'", // 去掉空白字符 
"'&(quot|#34);'i", // 替换 HTML 实体 
"'&(amp|#38);'i", 
"'&(lt|#60);'i", 
"'&(gt|#62);'i", 
"'&(nbsp|#160);'i" 
); // 作为 PHP 代码运行 
$replace = array ("","","\\1","\"","&","<",">"," "); 
$content = preg_replace($search, $replace, $content); 
	$item['content']=$content;
	echo json_encode($item) ;
	exit;
}
include template('exhibit', 'wap');
?>