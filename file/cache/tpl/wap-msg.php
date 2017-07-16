<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header', 'wap');?>
<!--
<meta http-equiv="refresh" content="2;URL=<?php echo $forward;?>">
-->
<div class="tip_box">
   <div class="top">&nbsp;&nbsp;&nbsp;提示信息</div>
   <div class="tip_main" style="text-align:center">
   <?php echo $msg;?><p>
   <div class="djtcdl"><a href="<?php echo $forward;?>">点击跳转</a></div>
   <div class="c_b"></div>
   </div>
</div>
<?php include template('footer', 'wap');?>