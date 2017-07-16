<?php defined('IN_DESTOON') or exit('Access Denied');?>﻿<?php $CSS = array('catalog');?>
<?php include template('header');?>
<div class="m">
<div class="m_l f_l">
<div class="left_box">
<div class="pos">当前位置: <a href="<?php echo $MODULE['1']['linkurl'];?>">首页</a> &raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a></div>
<div class="category">
<p><img src="<?php echo DT_SKIN;?>image/arrow.gif" width="17" height="12" alt=""/> <strong>按地区浏览</strong></p>
<div>
<table width="100%" cellpadding="3">
<?php $mainarea = get_mainarea(0)?>
<?php if(is_array($mainarea)) { foreach($mainarea as $k => $v) { ?>
<?php if($k%10==0) { ?><tr><?php } ?>
<td><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?areaid='.$v['areaid']);?>"><?php echo $v['areaname'];?></a></td>
<?php if($k%10==9) { ?></tr><?php } ?>
<?php } } ?>
</table>
</div>
</div>
<?php if($page == 1) { ?><?php echo ad($moduleid,$catid,$kw,6);?><?php } ?>
<div style="padding:12px 10px 10px 15px;background:#F1F7FC;"><img src="<?php echo DT_SKIN;?>image/arrow.gif" width="17" height="12" alt=""/> <strong>按行业浏览</strong></div>
<div class="catalog" style="border:none;padding:0;">
<?php $mid = 4;?>
<?php include template('catalog', 'chip');?>
</div>
<?php echo load('catalog.css');?>
<div class="catalog c_b" style="border:none;padding:0;">
<div id="catalog">
<table width="100%" cellspacing="0" cellspacing="0">
<?php $child = get_maincat(0, $CATEGORY, 1);?>
<?php if(is_array($child)) { foreach($child as $i => $c) { ?>
<?php if($i%2==0) { ?><tr<?php if($i%4==2) { ?> bgcolor="#FAFCFE"<?php } ?>><?php } ?>
<td valign="top" width="50%" onmouseover="this.style.backgroundColor='#E2F0FB';" onmouseout="this.style.backgroundColor='';">
<p>
<a href="<?php echo $MOD['linkurl'];?><?php echo $c['linkurl'];?>" class="px15"><strong><?php echo set_style($c['catname'], $c['style']);?></strong></a> (<?php echo $ITEMS[$c['catid']];?>)
<?php if($c['child']) { ?>
<?php $sub = get_maincat($c['catid'], $CATEGORY, 2);?>
<?php if(is_array($sub)) { foreach($sub as $j => $s) { ?><?php if($j < 5) { ?> <a href="<?php echo $MOD['linkurl'];?><?php echo $s['linkurl'];?>" ><strong><?php echo set_style($s['catname'], $s['style']);?></strong></a><?php } ?><?php } } ?>
<?php } ?>
</p>
<?php if($c['child']) { ?>
<?php $sub = get_maincat($c['catid'], $CATEGORY, 1);?>
<ul>
<?php if(is_array($sub)) { foreach($sub as $j => $s) { ?>
<li><a href="<?php echo $MOD['linkurl'];?><?php echo $s['linkurl'];?>" class="g"><?php echo set_style($s['catname'], $s['style']);?></a></li>
<?php } } ?>
</ul>
<div class="c_b"></div>
<?php } ?>
</td>
<?php if($i%2==1) { ?></tr><?php } ?>
<?php } } ?>
</table>
</div>
</div>

<?php echo tag("moduleid=$moduleid&condition=groupid>5&pagesize=10&page=$page&showpage=1&update=1&datetype=5&order=".$MOD['order']."&fields=".$MOD['fields']."&template=list-company");?><br/>
</div>
</div>
<div class="m_n f_l">&nbsp;</div>
<div class="m_r f_l">
<?php if($MOD['page_irec']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?vip=1');?>">更多..</a></span><strong>名企推荐</strong></div></div>
<div class="box_body li_dot f_gray">
<?php echo tag("moduleid=$moduleid&condition=level>0 and catids<>''&areaid=$cityid&pagesize=".$MOD['page_irec']."&order=vip desc&template=list-com");?>
</div>
<div class="b10"> </div>
<?php } ?>
<?php if($MOD['page_ivip']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?vip=1');?>">更多..</a></span><strong>最新<?php echo VIP;?></strong></div></div>
<div class="box_body li_dot f_gray">
<?php echo tag("moduleid=$moduleid&condition=vip>0 and catids<>''&areaid=$cityid&pagesize=".$MOD['page_ivip']."&order=fromtime desc&template=list-com");?>
</div>
<div class="b10"> </div>
<?php } ?>
<?php if($MOD['page_inews']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('news.php?more=1');?>">更多..</a></span><strong>企业新闻</strong></div></div>
<div class="box_body li_dot f_gray">
<?php echo tag("table=news&condition=status=3 and level>0&pagesize=".$MOD['page_inews']."&datetype=2&order=addtime desc&target=_blank");?>
</div>
<div class="b10"> </div>
<?php } ?>
<?php if($MOD['page_inew']) { ?>
<div class="box_head_1"><div><span class="f_r"><a href="<?php echo $MOD['linkurl'];?><?php echo rewrite('search.php?new=1');?>">更多..</a></span><strong>最新加入</strong></div></div>
<div class="box_body li_dot f_gray">
<?php echo tag("moduleid=$moduleid&condition=groupid>5 and catids<>''&areaid=$cityid&pagesize=".$MOD['page_inew']."&order=userid desc&template=list-com");?>
</div>
<?php } ?>
</div>
</div>
<?php include template('footer');?>