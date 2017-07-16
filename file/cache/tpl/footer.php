<?php defined('IN_DESTOON') or exit('Access Denied');?>﻿<div class="m">
<div class="b10">&nbsp;</div>
<div class="foot_search">
<div class="foot_search_m" id="foot_search_m">
<?php if(is_array($MODULE)) { foreach($MODULE as $m) { ?><?php if($m['ismenu'] && !$m['islink']) { ?><span id="foot_search_m_<?php echo $m['moduleid'];?>" onclick="setFModule(<?php echo $m['moduleid'];?>)" class="<?php if($m['moduleid']==$searchid) { ?>f_b<?php } else { ?><?php } ?>"><?php echo $m['name'];?></span> | <?php } ?><?php } } ?>
</div>
<div>
<form id="foot_search" action="<?php echo DT_PATH;?>search.php" onsubmit="return Fsearch();">
<input type="hidden" name="moduleid" value="<?php echo $searchid;?>" id="foot_moduleid"/>
<input type="text" name="kw" class="foot_search_i" id="foot_kw" value="<?php if($kw) { ?><?php echo $kw;?><?php } else { ?>请输入关键词<?php } ?>" onfocus="if(this.value=='请输入关键词') this.value='';"/>&nbsp;&nbsp;
<input type="submit" class="foot_search_s" id="foot_search_s" value="搜索"/>
</form>
</div>
</div>
<div class="b10">&nbsp;</div>
</div>
<div class="m">
<div class="foot">
<div id="webpage">
<a href="<?php echo $MODULE['1']['linkurl'];?>">网站首页</a>
<?php echo tag("table=webpage&condition=item=1&areaid=$cityid&order=listorder desc,itemid desc&template=list-webpage");?>
| <a href="<?php echo $MODULE['1']['linkurl'];?>sitemap/">网站地图</a>
<?php if($EXT['guestbook_enable']) { ?> | <a href="<?php echo $EXT['guestbook_url'];?>">网站留言</a><?php } ?>
<?php if($EXT['ad_enable']) { ?> | <a href="<?php echo $EXT['ad_url'];?>">广告服务</a><?php } ?>
<?php if($EXT['gift_enable']) { ?> | <a href="<?php echo $EXT['gift_url'];?>">积分换礼</a><?php } ?>
<?php if($EXT['feed_enable']) { ?> | <a href="<?php echo $EXT['feed_url'];?>">RSS订阅</a><?php } ?>
<?php if($DT['icpno']) { ?> | <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $DT['icpno'];?></a><?php } ?>
</div>
<div id="copyright"><?php echo $DT['copyright'];?></div>
<div>免责声明：本网所展示的供求信息由企业自行提供，内容的真实性、准确性和合法性由发布企业负责。本网对此不承担任何保证责任。<br/>(最佳分辨率1024*768,IE6或以上)</div>
<div><a href="http://www.nbnetcop.gov.cn/index.cgi" align="absmiddle" target="_blank"><img src="<?php echo DT_PATH;?>file/upload/foot/link4.jpg"/></a>　<img src="<?php echo DT_PATH;?>file/upload/foot/link1.jpg"/>　<a href="http://police.cnool.net" target="_blank"><img src="<?php echo DT_PATH;?>file/upload/foot/link2.jpg"/></a>　<a href="http://www.miibeian.gov.cn/" target="_blank"><img src="<?php echo DT_PATH;?>file/upload/foot/link3.jpg"/></a>　<a href="http://www.nbnetcop.gov.cn/index.cgi" align="absmiddle" target="_blank"><img src="<?php echo DT_PATH;?>file/upload/foot/link5.jpg"/></a></div>
<?php if(DT_DEBUG) { ?><div class="px11"><?php echo debug();?></div><?php } ?>
<div id="powered">&nbsp;</div>
</div>
</div>
<div id="destoon_toolbar">
<div class="tb_m">
<div class="tb_r">
<div>
<img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_newcart.gif" width="16" height="16" align="absmiddle" alt=""/>
<a href="<?php echo $MODULE['16']['linkurl'];?>cart.php">购物车</a>(<span id="destoon_cart">0</span>)&nbsp;&nbsp;&nbsp;
<img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_message.gif" width="16" height="16" align="absmiddle" alt=""/>
<a href="<?php echo $MODULE['2']['linkurl'];?>message.php">站内信</a>(<span id="destoon_message">0</span>)
<?php if($DT['im_web']) { ?>
&nbsp;&nbsp;&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/ico_newchat.gif" width="14" height="13" align="absmiddle" alt=""/>
<a href="<?php echo $MODULE['2']['linkurl'];?>chat.php">新对话</a>(<span id="destoon_chat">0</span>)
<?php } ?>
</div>
</div>
<div class="tb_l">
<div>
<img src="<?php echo DT_SKIN;?>image/vip.gif" alt="上网做生意，首选<?php echo VIP;?>会员" align="absmiddle"/> <a href="<?php echo $MODULE['2']['linkurl'];?>grade.php">会员服务</a>
| <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>">发布信息</a>
| <a href="<?php echo $MODULE['2']['linkurl'];?>">会员中心</a>
| <a href="<?php echo $MODULE['1']['linkurl'];?>">返回首页</a>
</div>
</div>
<div class="tb_c" onclick="window.scrollTo(0,0);" title="返回顶部" id="tb_c"></div>
</div>
</div>
<script type="text/javascript">show_task('<?php echo $destoon_task;?>');</script>
</body>
</html>