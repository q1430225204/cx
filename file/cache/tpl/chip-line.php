<?php defined('IN_DESTOON') or exit('Access Denied');?>var destoon_userid = <?php echo $_userid;?>;
var destoon_username = '<?php echo $_username;?>';
var destoon_message = <?php echo $_message;?>;
var destoon_chat = <?php echo $_chat;?>;
var destoon_stip = '';
var destoon_member = '<img src="<?php echo DT_SKIN;?>image/user.gif" width="24" height="13" align="absmiddle"/>&nbsp; 欢迎，';
<?php if($_userid) { ?>
destoon_member += '<span class="f_red f_b" title="<?php echo $MG['groupname'];?>"><?php echo $_truename;?></span> (<a href="<?php echo $MODULE['2']['linkurl'];?>line.php" title="<?php if($_online) { ?>点击隐身<?php } else { ?>点击上线<?php } ?>"><?php if($_online) { ?><span class="f_green">在线</span><?php } else { ?><span class="f_gray">隐身</span><?php } ?></a>) | <a href="<?php echo $MODULE['2']['linkurl'];?>">商务中心</a> | <a href="<?php echo $MODULE['2']['linkurl'];?>record.php"><?php echo $DT['money_name'];?>(<span class="px11"><?php echo $_money;?></span>)</a> | <a href="<?php echo $MODULE['2']['linkurl'];?>credit.php"><?php echo $DT['credit_name'];?>(<span class="px11"><?php echo $_credit;?></span>)</a> | <a href="<?php echo $MODULE['2']['linkurl'];?>logout.php">退出</a>';
<?php } else { ?>
destoon_member += '<span class="f_red">客人</span> | <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_register'];?>">免费注册</a> | <a href="<?php echo $MODULE['2']['linkurl'];?><?php echo $DT['file_login'];?>">会员登录</a> | <a href="<?php echo $MODULE['2']['linkurl'];?>send.php">忘记密码?</a>';
<?php } ?>
try{Dd('destoon_member').innerHTML=destoon_member;}catch(e){}
<?php if($DT['city']) { ?>
try{Dd('destoon_city').innerHTML='<?php echo $city_name;?>';}catch(e){}
<?php } ?>
<?php if($_message) { ?>
Dd('destoon_message').innerHTML='<strong class="f_red"><?php echo $_message;?></strong>';
<?php if($_sound) { ?>destoon_stip += sound('message_<?php echo $_sound;?>');<?php } ?>
<?php } ?>
<?php if($_chat && $DT['im_web']) { ?>
Dd('destoon_chat').innerHTML='<strong class="f_red"><?php echo $_chat;?></strong>';
destoon_stip += sound('chat_new');
<?php } ?>
var destoon_cart = substr_count(get_cookie('cart'), ',');
if(destoon_cart > 0) Dd('destoon_cart').innerHTML='<strong class="f_red">'+destoon_cart+'</strong>';
if(destoon_stip) Dd('tb_c').innerHTML = destoon_stip;
<?php if($push && $DT['pushtime']) { ?>window.setInterval('PushNew()',<?php echo $DT['pushtime'];?>*1000);<?php } ?>