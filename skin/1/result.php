<form name="" method="get" action="">
<h2><label>搜索视频：<input type="text" name="uri" value="<?php echo $key ?>"></label><input type="submit" value="搜索"><input name="type" type="hidden" value="search"></h2>
</form>
<?php if (isset($_search_fail)) { ?>
<p>搜索失败.</p>
<?php } else { ?>
<table width="100%" border="0" cellspacing="2" cellpadding="0" class="guider">
  <tr>
    <td><a href="?<?php $_GET['page']=$page-1;echo http_build_query($_GET); ?>">上一页</a></td>
    <td align="center">当前第<?php echo $page ?>页</td>
    <td align="right"><a href="?<?php $_GET['page']=$page+1;echo http_build_query($_GET); ?>">下一页</a></td>
  </tr>
</table>
<?php foreach($xml->entry as $i) {
$id=substr($i->id,strrpos($i->id,':')+1); ?>
<div class="si" onClick="window.location.href='?uri=<?php echo $id ?>&type=watch'">
<img width="120" height="90" src="?type=thumb&uri=<?php echo $id ?>">
<br><?php echo $i->title; ?></div>
<?php } ?>
<table width="100%" border="0" cellspacing="2" cellpadding="0" class="guider">
  <tr>
    <td><a href="?<?php $_GET['page']=$page-1;echo http_build_query($_GET); ?>">上一页</a></td>
    <td align="center">当前第<?php echo $page ?>页</td>
    <td align="right"><a href="?<?php $_GET['page']=$page+1;echo http_build_query($_GET); ?>">下一页</a></td>
  </tr>
</table>
<?php } ?>