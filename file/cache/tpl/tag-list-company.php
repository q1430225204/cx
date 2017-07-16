<?php defined('IN_DESTOON') or exit('Access Denied');?><?php if(is_array($tags)) { foreach($tags as $k => $t) { ?>
<div class="list">
<table>
<tr align="center">
<td width="100"><div><a href="<?php echo $t['linkurl'];?>" target="_blank"><img src="<?php echo imgurl($t['thumb'], 1);?>" width="80" height="80" alt=""/></a></div></td>
<td width="10"> </td>
<td align="left">
<ul>
<li><?php if($t['vip']) { ?><span class="f_r"><img src="<?php echo DT_SKIN;?>image/vip.gif"/> <img src="<?php echo DT_SKIN;?>image/vip_<?php echo $t['vip'];?>.gif"/></span><?php } ?><a href="<?php echo $t['linkurl'];?>" target="_blank"><strong class="px14"><?php echo $t['company'];?></strong></a></li>
<li class="f_gray">主营：<?php echo $t['business'];?></li>
<li class="f_gray">
<?php if($t['mode']) { ?>(<?php echo $t['mode'];?>)&nbsp;&nbsp;<?php } ?>
<?php if($t['validated']) { ?>[已核实]<?php } else { ?>[未核实]<?php } ?>
</li>
</ul>
</td>
<td width="10"> </td>
<td width="100" class="f_orange">[<?php echo area_pos($t['areaid'], '/', 2);?>]</td>
</tr>
</table>
</div>
<?php } } ?>
<?php if($showpage && $pages) { ?><div class="pages"><?php echo $pages;?></div><?php } ?>