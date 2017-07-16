<?php defined('IN_DESTOON') or exit('Access Denied');?><?php $CSS = array('index', 'catalog');?>
<?php include template('header');?>
<div class="m">
<table width="100%" cellspacing="0" cellpadding="0">
<tr align="center">
<td><?php echo ad(20);?></td>
<td><?php echo ad(21);?></td>
<td><?php echo ad(22);?></td>
<td><?php echo ad(23);?></td>
<td><?php echo ad(24);?></td>
<td><?php echo ad(25);?></td>
</tr>
</table>
</div>
<div class="m b10">&nbsp;</div>
<div class="m">
<div class="m_l f_l">
<div class="topr">
<div><?php echo ad(14);?></div>
<div class="announce"><div class="announce_l"><a href="<?php echo $EXT['announce_url'];?>"><strong>公告栏：</strong></a></div><div class="announce_r" id="announce"><?php echo tag("table=announce&condition=totime=0 or totime>$today_endtime-86400&areaid=$cityid&pagesize=3&datetype=2&order=listorder desc,addtime desc&target=_blank");?></div></div>
</div>
<div class="topl" id="trades">
<div class="tab_head">
<ul>
<li class="tab_2" id="trade_t_1" onmouseover="Tb(1, 3, 'trade', 'tab');"><a href="<?php echo $MODULE['6']['linkurl'];?>">求购</a></li>
<li class="tab_1" id="trade_t_2" onmouseover="Tb(2, 3, 'trade', 'tab');"><a href="<?php echo $MODULE['5']['linkurl'];?>">供应</a></li>
<li class="tab_1" id="trade_t_3" onmouseover="Tb(3, 3, 'trade', 'tab');"><a href="<?php echo $MODULE['22']['linkurl'];?>">招商</a></li>
</ul>
</div>
<div class="box_body li_dot">
<div id="trade_c_1" class="itrade" style="display:">
<?php echo tag("moduleid=6&condition=status=3&areaid=$cityid&pagesize=7&target=_blank&order=addtime desc");?>
</div>
<div id="trade_c_2" class="itrade" style="display:none">
<?php echo tag("moduleid=5&condition=status=3&areaid=$cityid&pagesize=7&target=_blank&order=addtime desc");?>
</div>
<div id="trade_c_3" class="itrade" style="display:none">
<?php echo tag("moduleid=22&condition=status=3&areaid=$cityid&pagesize=7&target=_blank&order=addtime desc");?>
</div>
</div>
</div>
</div>
<div class="m_n f_l">&nbsp;</div>
<div class="m_r f_l">
<?php if($DT['page_login']) { ?>
<?php include template('user', 'chip');?>
<?php } ?>
</div>
</div>
<div class="m b10">&nbsp;</div>
<div class="m">
<div class="m_l f_l">
<?php if($DT['page_mall']) { ?>
<div class="tab_head">
<ul>
<li class="tab_2" id="mall_t_1" onmouseover="Tb(1, 2, 'mall', 'tab');"><a href="<?php echo $MODULE['5']['linkurl'];?>">推荐产品</a></li>
<li class="tab_1" id="mall_t_2" onmouseover="Tb(2, 2, 'mall', 'tab');"><a href="<?php echo $MODULE['16']['linkurl'];?>">热卖商品</a></li>
</ul>
</div>
<div class="box_body">
<div id="mall_c_1" class="isell" style="display:">
<?php echo tag("moduleid=5&length=14&condition=status=3 and level>0 and thumb<>''&areaid=$cityid&pagesize=".$DT['page_mall']."&order=addtime desc&width=100&height=100&cols=5&target=_blank&template=thumb-table");?>
</div>
<div id="mall_c_2" class="imall" style="display:none">
<?php echo tag("moduleid=16&length=14&condition=status=3&areaid=$cityid&pagesize=".$DT['page_mall']."&order=orders desc&width=90&height=90&cols=5&target=_blank&template=thumb-mall");?>
</div>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
</div>
<div class="m_n f_l">&nbsp;</div>
<div class="m_r f_l">
<?php if($DT['page_news']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['21']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['21']['linkurl'];?>"><strong>行业资讯</strong></a></div></div>
<div class="box_body" id="inews">
<?php if($DT['page_newsh']) { ?>
<div class="headline">
<?php echo tag("moduleid=21&condition=status=3 and level=5&areaid=$cityid&order=addtime desc&pagesize=1&target=_blank&template=list-hl");?>
</div>
<?php } ?>
<div class="li_dot f_gray">
<?php echo tag("moduleid=21&condition=status=3&areaid=$cityid&pagesize=".$DT['page_news']."&datetype=2&order=addtime desc&target=_blank");?></div>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
</div>
</div>
<div class="m">
<div class="m_l f_l">
<?php if($DT['page_catalog']) { ?>
<div class="catalog_menu">
<?php if($DT['page_letter']) { ?>
<div class="catalog_letter">
<ul>
<?php $LETTER = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');?>
<?php if(is_array($LETTER)) { foreach($LETTER as $l) { ?>
<li id="index_<?php echo $l;?>" class="catalog_letter_li" onmouseover="index_timer('<?php echo $l;?>');" onmouseout="index_out();"><?php echo $l;?></li>
<?php } } ?>
</ul>
</div>
<?php } ?>
</div>
<div class="dsn" id="catalog_index" onmouseout="index_leave(this, event);"></div>
<div class="catalog c_b">
<div id="catalog">
<?php $mid = 5;?>
<?php include template('catalog', 'chip');?>
</div>
</div>
<div class="b10 c_b"></div>
<?php } ?>
<?php if($DT['page_brand']) { ?>
<div class="box_head"><div><span class="f_r"><a href="<?php echo $MODULE['13']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['13']['linkurl'];?>"><strong>品牌展示</strong></a></div></div>
<div class="box_body">
<div class="thumb"><?php echo tag("moduleid=13&condition=status=3 and level>0&areaid=$cityid&pagesize=".$DT['page_brand']."&order=addtime desc&width=120&height=40&cols=4&target=_blank&template=thumb-brand");?></div>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
<?php if($DT['page_exhibit']) { ?>
<div class="box_head"><div><span class="f_r"><a href="<?php echo $MODULE['8']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['8']['linkurl'];?>"><strong>行业展会</strong></a></div></div>
<div class="box_body li_dot">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td valign="top" width="495">
<?php $tags=tag("moduleid=8&condition=status=3&areaid=$cityid&pagesize=".$DT['page_exhibit']."&order=addtime desc&template=null");?>
<ul>
<?php if(is_array($tags)) { foreach($tags as $t) { ?>
<li title="<?php echo $t['alt'];?>"><span class="f_r">[<?php echo $t['city'];?>]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo timetodate($t['fromtime'], 'Y年m月d日');?></span><a href="<?php echo $t['linkurl'];?>" target="_blank"><?php echo $t['title'];?></a></li>
<?php } } ?>
</ul>
</td>
<td> </td>
<td valign="top" width="155">
<div class="b5">&nbsp;</div>
<?php echo ad(5);?>
<div class="b5">&nbsp;</div>
<?php echo ad(6);?>
</td>
</tr>
</table>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
<?php if($DT['page_job']) { ?>
<div class="tab_head">
<ul>
<li class="tab_2" id="job_t_1" onmouseover="Tb(1, 2, 'job', 'tab');"><a href="<?php echo $MODULE['9']['linkurl'];?>">招聘信息</a></li>
<li class="tab_1" id="job_t_2" onmouseover="Tb(2, 2, 'job', 'tab');"><a href="<?php echo $MODULE['9']['linkurl'];?>">求职简历</a></li>
</ul>
</div>
<div class="box_body">
<div id="job_c_1" style="display:">
<?php echo tag("moduleid=9&condition=status=3&areaid=$cityid&pagesize=".$DT['page_job']."&length=30&order=edittime desc&template=table-job");?>
</div>
<div id="job_c_2" style="display:none">
<?php echo tag("moduleid=9&table=resume&condition=status=3 and open=3&areaid=$cityid&showcat=1&pagesize=".$DT['page_job']."&order=edittime desc&template=table-resume");?>
</div>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
<?php if($DT['page_photo']) { ?>
<div class="box_head"><div><span class="f_r"><a href="<?php echo $MODULE['12']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['12']['linkurl'];?>"><strong>图片中心</strong></a></div></div>
<div class="box_body">
<div class="thumb"><?php echo tag("moduleid=12&condition=status=3 and open=3 and level>0&pagesize=".$DT['page_photo']."&order=addtime desc&width=120&height=90&cols=4&target=_blank&template=list-photo");?></div>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
</div>
<div class="m_n f_l">&nbsp;</div>
<div class="m_r f_l">
<?php if($DT['page_com']) { ?>
<div class="tab_head">
<ul>
<li class="tab_2" id="com_t_1" onmouseover="Tb(1, 2, 'com', 'tab');"><a href="<?php echo $MODULE['4']['linkurl'];?>"><?php echo VIP;?>企业</a></li>
<li class="tab_1" id="com_t_2" onmouseover="Tb(2, 2, 'com', 'tab');"><a href="<?php echo $MODULE['4']['linkurl'];?>">最新企业</a></li>
<li>&nbsp;&nbsp;<a href="<?php echo $MODULE['2']['linkurl'];?>grade.php" class="f_n">如何加入?</a></li>
</ul>
</div>
<div class="box_body li_dot">
<div id="com_c_1" style="display:">
<?php echo tag("moduleid=4&condition=vip>0 and catids<>''&areaid=$cityid&pagesize=".$DT['page_com']."&order=fromtime desc&template=list-com");?>
</div>
<div id="com_c_2" style="display:none">
<?php echo tag("moduleid=4&condition=groupid>5 and catids<>''&areaid=$cityid&pagesize=".$DT['page_com']."&order=userid desc&template=list-com");?>
</div>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
<?php if($DT['page_group']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['17']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['17']['linkurl'];?>"><strong>今日团批</strong></a></div></div>
<div class="box_body li_dot f_gray">
<?php $tags=tag("moduleid=17&condition=status=3 and level>0&areaid=$cityid&pagesize=".$DT['page_group']."&datetype=2&order=addtime desc&template=null");?>
<?php if(is_array($tags)) { foreach($tags as $t) { ?>
<div class="imgtxt">
<div><a href="<?php echo $t['linkurl'];?>" target="_blank"><img src="<?php echo $t['thumb'];?>" width="100" alt="<?php echo $t['alt'];?>"/></a> <a href="<?php echo $t['linkurl'];?>" target="_blank" title="<?php echo $t['alt'];?>" class="f_b px13"><?php echo $t['title'];?></a><br/><cite>￥<?php echo $t['price'];?></cite> <?php echo $t['discount'];?>折 <a href="<?php echo $t['linkurl'];?>" target="_blank"><em>[参团]</em></a></div>
</div>
<?php } } ?>
<div class="b5 c_b"></div>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
<?php if($DT['page_special']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['11']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['11']['linkurl'];?>"><strong>推荐专题</strong></a></div></div>
<div class="box_body li_dot f_gray">
<?php $tags=tag("moduleid=11&condition=status=3 and level>0&pagesize=".$DT['page_special']."&datetype=2&order=addtime desc&template=null");?>
<?php if(is_array($tags)) { foreach($tags as $t) { ?>
<div class="imgtxt">
<p><a href="<?php echo $t['linkurl'];?>" target="_blank" title="<?php echo $t['alt'];?>"><?php echo $t['title'];?></a></p>
<div><a href="<?php echo $t['linkurl'];?>" target="_blank"><img src="<?php echo $t['thumb'];?>" width="100" alt="<?php echo $t['alt'];?>"/></a> <?php echo dsubstr($t['introduce'], 90, '..');?> <a href="<?php echo $t['linkurl'];?>" target="_blank"><em>[详细]</em></a></div>
</div>
<?php } } ?>
<div class="b5 c_b"></div>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
<?php if($DT['page_quote']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['7']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['7']['linkurl'];?>"><strong>行情报价</strong></a></div></div>
<div class="box_body li_dot f_gray">
<?php echo tag("moduleid=7&condition=status=3&areaid=$cityid&pagesize=".$DT['page_quote']."&datetype=2&order=addtime desc&target=_blank");?>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
<?php if($DT['page_comnews']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['4']['linkurl'];?><?php echo rewrite('news.php?more=1');?>">更多..</a></span><a href="<?php echo $MODULE['4']['linkurl'];?><?php echo rewrite('news.php?more=1');?>"><strong>企业新闻</strong></a></div></div>
<div class="box_body li_dot f_gray">
<?php echo tag("table=news&condition=status=3 and level>0&pagesize=".$DT['page_comnews']."&datetype=2&order=addtime desc&target=_blank");?>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
<?php if($DT['page_video']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['14']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['14']['linkurl'];?>"><strong>推荐视频</strong></a></div></div>
<div class="box_body f_gray video">
<?php echo tag("moduleid=14&condition=status=3 and level>0&pagesize=".$DT['page_video']."&datetype=2&order=addtime desc&target=_blank");?>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
<?php if($DT['page_know']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['10']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['10']['linkurl'];?>"><strong>行业知道</strong></a></div></div>
<div class="box_body li_dot f_gray">
<?php $tags=tag("moduleid=10&condition=status=3 and process>0&pagesize=".$DT['page_know']."&order=addtime desc&template=null");?>
<ul>
<?php if(is_array($tags)) { foreach($tags as $t) { ?>
<li><span class="f_r"><?php echo timetodate($t['addtime'], 2);?></span><?php if($t['credit']) { ?><span class="know_credit"><?php echo $t['credit'];?></span> <?php } ?><a href="<?php echo $t['linkurl'];?>" target="_blank" title="<?php echo $t['alt'];?>"><?php echo $t['title'];?></a></li>
<?php } } ?>
</ul>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
<?php if($DT['page_down']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MODULE['15']['linkurl'];?>">更多..</a></span><a href="<?php echo $MODULE['15']['linkurl'];?>"><strong>资料下载</strong></a></div></div>
<div class="box_body f_gray">
<?php echo tag("moduleid=15&condition=status=3&pagesize=".$DT['page_down']."&length=40&target=_blank&order=addtime desc&template=list-down");?>
</div>
<div class="b10">&nbsp;</div>
<?php } ?>
<?php if($DT['page_vote']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $EXT['vote_url'];?>">更多..</a></span><a href="<?php echo $EXT['vote_url'];?>"><strong>投票调查</strong></a></div></div>
<div class="box_body"><?php echo tag("table=vote&condition=level>0&pagesize=".$DT['page_vote']."&order=addtime desc&template=list-vote");?></div>
<div class="b10">&nbsp;</div>
<?php } ?>
</div>
</div>
<?php if($DT['page_logo'] || $DT['page_text']) { ?>
<div class="m">
<div class="tab_head">
<ul>
<li class="tab_2"><a href="<?php echo $EXT['link_url'];?>">友情链接</a></li>
<li class="tab_1"><a href="<?php echo $EXT['link_url'];?><?php echo rewrite('index.php?action=reg');?>">申请链接</a></li>
</ul>
</div>
<div class="box_body">
<?php if($DT['page_logo']) { ?>
<?php echo tag("table=link&condition=status=3 and level>0 and thumb<>'' and username=''&areaid=$cityid&pagesize=".$DT['page_logo']."&order=listorder desc,itemid desc&template=list-link&cols=9");?>
<?php } ?>
<?php if($DT['page_text']) { ?>
<?php echo tag("table=link&condition=status=3 and level>0 and thumb='' and username=''&areaid=$cityid&pagesize=".$DT['page_text']."&order=listorder desc,itemid desc&template=list-link&cols=9");?>
<?php } ?>
</div>
</div>
<?php } ?>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/index.js"></script>
<script type="text/javascript" src="<?php echo DT_PATH;?>file/script/marquee.js"></script>
<script type="text/javascript">new dmarquee(20, 20, 2000, 'announce');</script>
<?php include template('footer');?>