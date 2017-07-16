<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$table = $DT_PRE.'brand';
$table_data = $DT_PRE.'brand_data';
if($itemid) {
	$item = $db->get_one("SELECT * FROM {$table} WHERE itemid=$itemid");
	($item && $item['status'] > 2) or wap_msg($L['msg_not_exist']);
	extract($item);
	$CAT = get_cat($catid);
	if(!check_group($_groupid, $MOD['group_show']) || !check_group($_groupid, $CAT['group_show'])) wap_msg($L['msg_no_right']);
	$member = array();
	$fee = get_fee($item['fee'], $MOD['fee_view']);
	require $action == 'pay' ? 'pay.inc.php' : 'contact.inc.php';
	$content_table = content_table($moduleid, $itemid, $MOD['split'], $table_data);
	$content = $db->get_one("SELECT content FROM {$content_table} WHERE itemid=$itemid");
	$content = $content['content'];
	$content = strip_tags($content);
	$content = preg_replace("/\&([^;]+);/i", '', $content);
	$contentlength = strlen($content);
	if($contentlength > $maxlength) {
		$start = ($page-1)*$maxlength;
		$content = dsubstr($content, $maxlength, '', $start);
		$pages = wap_pages($contentlength, $page, $maxlength);
	}
	$content = nl2br($content);
	$editdate = timetodate($edittime, 5);
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
	$condition = "status=3";
	if($keyword) $condition .= " AND keyword LIKE '%$keyword%'";
	if($catid) $condition .= $CAT ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";
	if($areaid) $condition .= $ARE['child'] ? " AND areaid IN (".$ARE['arrchildid'].")" : " AND areaid=$areaid";
	$r = $db->get_one("SELECT COUNT(*) AS num FROM {$table} WHERE $condition", 'CACHE');
	$items = $r['num'];
	$pages = wap_pages($items, $page, $pagesize);
	$lists = array();
	if($items) {
		$order = $MOD['order'];
		$result = $db->query("SELECT itemid,catid,title,addtime,areaid,edittime FROM {$table} WHERE $condition ORDER BY $order LIMIT $offset,$pagesize");
		while($r = $db->fetch_array($result)) {
			$r['title'] = dsubstr($r['title'], $len);
			$lists[] = $r;
		}
		$db->free_result($result);
	}
}
$moduleid = 13;
if($cat=="wxapp"){
$tags=array();
$condition='';
if($catid){
	$CAT = get_cat($catid);
	$condition .= $CAT ? " AND catid IN (".$CAT['arrchildid'].")" : " AND catid=$catid";

}
$page = isset($page) ? max(intval($page), 1) : 1;
if($list=='list'){
	$pagesize = '10';
}elseif($list=='search'){
	$pagesize = '20';	
}else{
	$pagesize = '10';
}
$offset = ($page-1)*$pagesize;
	$result = $db->query("SELECT * FROM {$table} WHERE status=3 AND thumb!=''  $condition order by addtime desc LIMIT {$offset},{$pagesize}");
	while($r = $db->fetch_array($result)) {
		//if(!$r['thumb'])$r['thumb']='http://'.$_SERVER['SERVER_NAME']."/app/img/nopic.png";
		//if(!$r['thumb2'])$r['thumb2']='http://'.$_SERVER['SERVER_NAME']."/app/img/nopic.png";
		//if(!$r['thumb3'])$r['thumb3']='http://'.$_SERVER['SERVER_NAME']."/app/img/nopic.png";
		$tags[] = $r;
		}
		//var_dump($tags);
	//include template('list-sell_wxapp', 'app');
	//json_encode($tags) ;
	//var_dump($tags);
	echo json_encode($tags) ;
	exit;
}
include template('brand', 'wap');
?>