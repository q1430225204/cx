<?php defined('IN_DESTOON') or exit('Access Denied');?><script src="js/jquery.js"></script>
<div style="width:100%; clear:both; height:50px"></div>
<script>
$(document).ready(function(){
$('#fenx').click(function(){
   $('.fenxiang_box').css('display','block');
   $('.weix_box').css('display','none');
})
$('.guanbi').click(function(){
  $('.fenxiang_box').css('display','none');
})
})
</script>
<script>
$(document).ready(function(){
$('#weix').click(function(){
   $('.weix_box').css('display','block');
   $('.fenxiang_box').css('display','none');
})
$('.weix_guanbi').click(function(){
  $('.weix_box').css('display','none');
})
})
</script>
<div class="fenxiang_box">
   <div class="top">&nbsp;&nbsp;&nbsp;点击图标快速分享<span class="guanbi">关闭</span></div>
   <div class="fenxiang_main">
   <div class="bdsharebuttonbox">
   <ul>
   <li><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>QQ空间</li>
   <li><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>QQ好友</li>
   <li><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>新浪微博</li>
   <li><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>腾讯微博</li>
   <li><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>人人网</li>
   <li><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>微信</li>
   </ul>
   <div class="c_b"></div>
   </div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
   
   </div>
</div>
<div class="weix_box">
   <div class="top">&nbsp;&nbsp;&nbsp;打开微信扫一扫<span class="weix_guanbi">关闭</span></div>
   <div class="weix_main">
   <img src="image/ewm.jpg" />
   <div class="c_b"></div>
   </div>
</div>
<div class="foot_tab">
<ul>
<li><a href="tel:10086"><img src="image/phone.png" /><br />电话</a></li>
<li><a href="map.php"><img src="image/map.png" /><br />地图</a></li>
<li class="fenxiang"><a id="fenx" href="javascript:void"><img src="image/share.png" /><br />分享</a></li>
<li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2144357596&site=qq&menu=yes"><img src="image/QQ.png" /><br />客服</a></li>
<li class="fenxiang"><a id="weix" href="javascript:void"><img src="image/wechat.png" /><br />微信</a></li>
</ul>
</div>
</body>
</html>