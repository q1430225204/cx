<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header');?>
<div class="m">
<div class="left_box">
<div class="pos"><span class="f_r"><a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_my'];?>?mid=<?php echo $moduleid;?>&action=add&catid=<?php echo $catid;?>"><img src="<?php echo DT_SKIN;?>image/btn_add.gif" width="81" height="20" alt="发布信息" style="margin:3px 0 0 0;"/></a></span>当前位置: <a href="<?php echo $MODULE['1']['linkurl'];?>">首页</a> &raquo; <a href="<?php echo $MOD['linkurl'];?>"><?php echo $MOD['name'];?></a> &raquo; <?php echo cat_pos($CAT, ' &raquo; ');?> &raquo;</div>
<div class="b10 c_b"></div>
<table width="100%">
<tr>
<td width="10"> </td>
<td>
<table width="100%">
<tr>
<td colspan="3"><h1 class="title_trade"><?php echo $title;?></h1></td>
</tr>
<tr>
<td width="250" valign="top">
<div class="album">
<table width="100%" cellpadding="0" cellspacing="0">
<tr align="center">
<td width="250" valign="top"><div><span id="abm" title="点击查看大图"><img src="<?php echo $albums['0'];?>" onload="if(this.width>240){this.width=240;}" onmouseover="SAlbum(this.src);" onmouseout="HAlbum();" onclick="PAlbum(this);" id="DIMG"/></span></div></td>
</tr>
<tr>
<td>
<?php if(is_array($thumbs)) { foreach($thumbs as $k => $v) { ?><img src="<?php echo $v;?>" width="60" height="60" onmouseover="if(this.src.indexOf('nopic60.gif')==-1)Album(<?php echo $k;?>, '<?php echo $albums[$k];?>');"class="<?php if($k) { ?>ab_im<?php } else { ?>ab_on<?php } ?>" id="t_<?php echo $k;?>"/><?php } } ?></td>
</tr>
<tr align="center">
<td height="30" onclick="PAlbum(Dd('DIMG'));"><img src="<?php echo DT_SKIN;?>image/ico_zoom.gif" width="16" height="16" align="absmiddle"/> 点击图片查看原图</td>
</tr>
</table>
</div>
</td>
<td width="15"> </td>
<td valign="top">
<div id="imgshow" style="display:none;"></div>
<table width="100%" cellpadding="5" cellspacing="5">
<?php if($brand) { ?>
<tr>
<td class="f_dblue">品 牌：</td>
<td><?php echo $brand;?>&nbsp;</td>
</tr>
<?php } ?>
<?php if($model) { ?>
<tr>
<td class="f_dblue">型 号：</td>
<td><?php echo $model;?>&nbsp;</td>
</tr>
<?php } ?>
<?php if($standard) { ?>
<tr>
<td class="f_dblue">规 格：</td>
<td><?php echo $standard;?>&nbsp;</td>
</tr>
<?php } ?>
<tr>
<td class="f_dblue">单 价：</td>
<td class="f_b f_orange"><?php if($price>0) { ?><?php echo $price;?><?php echo $DT['money_unit'];?>/<?php echo $unit;?><?php } else { ?>面议<?php } ?>&nbsp;</td>
</tr>
<tr>
<td class="f_dblue">起 订：</td>
<td class="f_b f_orange"><?php if($minamount) { ?><?php echo $minamount;?> <?php echo $unit;?><?php } ?>&nbsp;</td>
</tr>
<tr>
<td class="f_dblue">供货总量：</td>
<td class="f_b f_orange"><?php if($amount) { ?><?php echo $amount;?> <?php echo $unit;?><?php } ?></td>
</tr>
<tr>
<td class="f_dblue">发货期限：</td>
<td>自买家付款之日起  <span class="f_b f_orange"><?php if($days) { ?><?php echo $days;?><?php } ?></span> 天内发货</td>
</tr>
<tr>
<td class="f_dblue">所在地：</td>
<td><?php echo area_pos($areaid, ' ');?></td>
</tr>
<tr>
<td class="f_dblue">有效期至：</td>
<td><?php if($todate) { ?><?php echo $todate;?><?php } else { ?>长期有效<?php } ?><?php if($expired) { ?> <span class="f_red">[已过期]</span><?php } ?></td>
</tr>
<tr>
<td class="f_dblue">最后更新：</td>
<td><?php echo $editdate;?></td>
</tr>
<tr>
<td width="80" class="f_dblue">浏览次数：</td>
<td><span id="hits"><?php echo $hits;?></span></td>
</tr>
<?php if($username && !$expired) { ?>
<tr>
<td colspan="2"><img src="<?php echo DT_SKIN;?>image/btn_inquiry.gif" alt="询价" class="c_p" onclick="Go('<?php echo $MOD['linkurl'];?><?php echo rewrite('inquiry.php?itemid='.$itemid);?>');"/></td>
</tr>
<?php } ?>
</table>
</td>
</tr>
</table>
</td>
<td width="10"> </td>
<td width="300" valign="top">
<div class="contact_head">公司基本资料信息</div>
<div class="contact_body" id="contact"><?php include template('contact', 'chip');?></div>
<?php if(!$username) { ?>
<br/>
&nbsp;<strong class="f_red">注意</strong>:发布人未在本站注册，建议优先选择<a href="<?php echo $MODULE['2']['linkurl'];?>grade.php"><strong><?php echo VIP;?>会员</strong></a>
<?php } ?>
</td>
<td width="10"> </td>
</tr>
</table>
<div class="b10">&nbsp;</div>
</div>
</div>
<div class="m">
<div class="b10">&nbsp;</div>
<div class="box_head_2">
<div>
<span class="f_r">
<form method="post" action="<?php echo $MODULE['2']['linkurl'];?>favorite.php">
<input type="hidden" name="action" value="add"/>
<input type="hidden" name="title" value="<?php echo $title;?>"/>
<input type="hidden" name="url" value="<?php echo $linkurl;?>"/>
<input type="image" src="<?php echo DT_SKIN;?>image/btn_fav.gif" class="c_p" style="margin-top:5px;"/>
</form>
</span>
<strong>产品详细说明</strong>
</div>
</div>
<div class="box_body" style="padding:0;">
<?php if($CP) { ?><?php include template('property', 'chip');?><?php } ?>
<div class="content c_b" id="content"><?php echo $content;?></div>
<?php include template('comment', 'chip');?>
</div>
</div>
<?php if($username) { ?>
<div class="m">
<div class="b10">&nbsp;</div>
<div class="box_head_2"><div><span class="f_r"><a href="<?php echo userurl($username, 'file=sell');?>">更多..</a></span><strong>本企业其它产品</strong></div></div>
<div class="box_body">
<div class="thumb" style="padding:10px;">
<?php echo tag("moduleid=$moduleid&length=20&condition=status=3 and thumb<>'' and username='$username'&pagesize=8&order=edittime desc&width=80&height=80&cols=8&template=thumb-table", -2);?>
</div>
</div>
</div>
<?php } ?>
<div class="m">
<form method="post" action="<?php echo $MODULE['2']['linkurl'];?>sendmail.php" name="sendmail" id="sendmail" target="_blank">
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/> 
<input type="hidden" name="title" value="<?php echo $title;?>"/>
<input type="hidden" name="linkurl" value="<?php echo $linkurl;?>"/>
</form>
<br/>
<center>
[ <a href="<?php echo $MOD['linkurl'];?>search.php"><?php echo $MOD['name'];?>搜索</a> ]&nbsp;
[ <script type="text/javascript">addFav('加入收藏');</script> ]&nbsp;
[ <a href="javascript:Dd('sendmail').submit();void(0);">告诉好友</a> ]&nbsp;
[ <a href="javascript:Print();">打印本文</a> ]&nbsp;
[ <a href="javascript:window.close()">关闭窗口</a> ]
</center>
<br/>
</div>
<?php include template('zoom', 'chip');?>
<?php include template('footer');?>