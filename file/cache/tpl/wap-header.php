<?php defined('IN_DESTOON') or exit('Access Denied');?><!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=yes" /> 
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
<meta http-equiv="Cache-Control" content="no-cache"/>
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" type="text/css" href="css/cehua.css">
<link rel="stylesheet" type="text/css" href="css/ttw.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/default.css">
<link href="css/offcanvas.min.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js"></script>
<title><?php echo $head_title;?></title>
<style>
*,body,div,span,a{ font-family:"微软雅黑" !important}
body{ background-color:#e9e9e9}
</style>
<script>
$(document).ready(function(){
$('.ydenglutip').click(function(){
   $('.ydenglutip_box').css('display','block');
})
$('.ydenglutip_guanbi').click(function(){
   $('.ydenglutip_box').css('display','none');
})
})
</script>
<script>
$(document).ready(function(){
$('.searc').click(function(){
   $("html,body").animate({scrollTop:0}, 500);
   $('.searc_box').css('display','block');
})
$('.searc_guanbi').click(function(){
   $('.searc_box').css('display','none');
})
})
</script>
</head>
<body>
<div class="ydenglutip_box">
   <div class="top">&nbsp;&nbsp;&nbsp;提示信息<span class="ydenglutip_guanbi">关闭</span></div>
   <div class="ydenglutip_main" style="text-align:center">
   您已登陆<p>
   <div class="djtcdl"><a href="index.php?moduleid=2&action=logout">点击退出登录</a></div>
   <div class="c_b"></div>
   </div>
</div>
<div class="overlay"></div>
<nav class="ttwnav navbar navbar-inverse navbar-static-top">
  <div class="container">
<div class="navbar-header">
    <table width="100%" height="50" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
  <td width="100"><button type="button" class="navbar-toggle collapsed pull-left" data-toggle="offcanvas">
<span class="sr-only"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
  </button>
      </td>
  <td><div class="logo">互联网+肥料手机版</div></td>
      <td width="100">
      <div class="catelogy">
      <?php if(!$_userid) { ?><a href="index.php?moduleid=2&amp;action=login"><img src="image/icon-my.png" /></a><?php } else { ?><a class="ydenglutip" href="javascript:void"><img src="image/icon-my.png" /></a><?php } ?></div>
      
      <div class="catelogy"><a class="searc" href="javascript:void"><img src="image/search.png" /></a></div>
      </td>
      </tr>
  </tbody>
</table>
</div>
<div id="navbar" class="collapse navbar-collapse sidebar-offcanvas">
    <div class="b80"></div>
    
    <?php if($_userid) { ?>
    
<?php $tags=tag("table=destoon_member m,destoon_company c&prefix=&condition=m.userid=c.userid and m.username='$username'&template=null")?>
    <div class="side_mem">
    <div class="touxiang"><?php if($xx['thumb']) { ?><img src="<?php echo imgurl($xx['thumb'], 1);?>" width="80" height="80" alt=""/><?php } else { ?><img src="image/default.jpg" width="80" height="80" alt=""/><?php } ?></div>
    <div class="yonghuming"><?php echo $_username;?></div>
    <div class="xiangqing"><?php echo $DT['credit_name'];?>(<?php echo $_credit;?>)&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?moduleid=2&amp;action=message">站内信(<?php if($_message) { ?><?php echo $_message;?><?php } else { ?>0<?php } ?>)</a></div>
    </div>
    <?php } else { ?>
    <div class="side_mem">
    <div class="touxiang"><?php if($xx['thumb']) { ?><img src="<?php echo imgurl($xx['thumb'], 1);?>" width="80" height="80" alt=""/><?php } else { ?><img src="image/default.jpg" width="80" height="80" alt=""/><?php } ?></div>
    <div class="yonghuming"><a href="index.php?moduleid=2&amp;action=login">立即登录</a></div>
    </div>
    <?php } ?>
    
  <ul class="nav navbar-nav">
<li><a href="<?php echo DT_PATH;?>wap/?moduleid=1"><span>网站首页</span></a></li>
<li <?php if($moduleid==5) { ?> class="i_item_on"<?php } ?>><a href="<?php echo DT_PATH;?>wap/?moduleid=5"><span>供应信息</span></a></li>
<li <?php if($moduleid==6) { ?> class="i_item_on"<?php } ?>><a href="<?php echo DT_PATH;?>wap/?moduleid=6"><span>求购信息</span></a></li>
<li <?php if($moduleid==21) { ?> class="i_item_on"<?php } ?>><a href="<?php echo DT_PATH;?>wap/?moduleid=21"><span>新闻资讯</span></a></li>
<li <?php if($moduleid==7) { ?> class="i_item_on"<?php } ?>><a href="<?php echo DT_PATH;?>wap/?moduleid=7"><span>市场行情</span></a></li>
<li <?php if($moduleid==8) { ?> class="i_item_on"<?php } ?>><a href="<?php echo DT_PATH;?>wap/?moduleid=8"><span>行业展会</span></a></li>
<li <?php if($moduleid==13) { ?> class="i_item_on"<?php } ?>><a href="<?php echo DT_PATH;?>wap/?moduleid=13"><span>品牌展示</span></a></li>
<li <?php if($moduleid==9) { ?> class="i_item_on"<?php } ?>><a href="<?php echo DT_PATH;?>wap/?moduleid=9"><span>人才招聘</span></a></li>
  </ul>
</div><!--/.nav-collapse -->
  </div>
</nav>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/offcanvas.js"></script>
<div class="b50"></div>
<div class="searc_box">
   <div class="searc_main" style="text-align:center">
   <form id="destoon_search" action="index.php" onsubmit="return Dsearch();">
<input type="hidden" name="moduleid" value="<?php if($moduleid==1) { ?>5<?php } else { ?><?php echo $moduleid;?><?php } ?>" id="destoon_moduleid"/>
<div class="head_search" >
<input name="kw" id="destoon_kw" type="text" class="search_i" value="<?php if($kw) { ?><?php echo $kw;?><?php } else { ?>请输入关键词<?php } ?>" onfocus="if(this.value=='请输入关键词') this.value='';"<?php if($DT['search_tips']) { ?> onkeyup="STip(this.value);" autocomplete="off"<?php } ?> />
<input type="submit" value="搜 索" class="search_s" style="float:right"/>
</div>
</form>
   <div class="c_b"></div>
   </div>
</div>
