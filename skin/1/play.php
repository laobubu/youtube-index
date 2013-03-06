<table width="100%" height="80%" border="0" cellpadding="0" cellspacing="2">
  <tr>
  	<td width="20%" rowspan="2" valign="top"><iframe allowtransparency="true" frameborder="0" src="http://ng.laobubu.net/support/ad/lite.php" width="100%" height="100%"></iframe></td>
    <td width="60%" align="center">
	<?php 
	if (!isset($_SESSION["html5"]) && isset($_COOKIE["html5"])) {
		$_SESSION["html5"] = $_COOKIE["html5"];
	}
	if(isset($_GET["html5"])) {
		$_SESSION["html5"] = $_GET["html5"];
		setcookie("html5",$_GET["html5"],time()+3600*24*365);
	} ?>
	<?php if($_SESSION["html5"]=="on") { 
	 loadvideo($key,"webm,mp4");
	?>
    <div id="html5switch" align="right"><a href="?html5=off&type=watch&uri=<?php echo $key ?>">返回普通模式</a></div>
    <video controls="controls" preload="none" style="width:95%" poster="?type=thumb&uri=<?php echo $key ?>">
		<?php 
        $vlist = formatVListByType( $_SESSION['vurl_'.$key] ,"medium","quality",1);
        foreach ($vlist as $i){ ?>
        <source type='<?php echo $i["type"]; ?>' src="vs.php?id=<?php echo $key; ?>&q=<?php echo $i["itag"]; ?>">
        <?php } ?>
        
    </video>
    <?php }else{ ?>
      <div id="html5switch" align="right"><a href="?html5=on&type=watch&uri=<?php echo $key ?>">启动HTML5模式（需浏览器支持）</a></div>
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="100%" height="100%">
        <param name="movie" value="skin/1/player.swf?ID=<?php echo $key ?>">
        <param name="quality" value="high">
        <param name="allowFullScreen" value="true">
		<param name="allowScriptAccess" value="always">
        <param name="flashvars" value="ID=<?php echo $key ?>">
        <embed allowScriptAccess="always" allowFullScreen="true" src="skin/1/player.swf?ID=<?php echo $key ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="100%" height="100%" flashvars="ID=<?php echo $key ?>"></embed>
    </object>
    <?php } ?></td>
    <td rowspan="2" valign="bottom"><iframe allowtransparency="true" height="115" src="http://ng.laobubu.net/lib/postComment.php?v=<?php echo $key; ?>" width="100%" frameborder="0"></iframe></td>
  </tr>
  <tr>
    <td height="50">由<?php echo $a['author'] ?>上传，时长<?php echo dataformat(intval($a['length_seconds'])); ?>，共<?php echo $a['view_count'] ?>人观看，平均得分<?php echo round($a['avg_rating'],2) ?>/5<br>
	  <a onMouseOver="$('downlist').style.display=''" href="http://ng.laobubu.net/lib/downit.php?id=<?php echo $key; ?>">下载该视频</a></td>
  </tr>
</table><script>aniY(0)</script>
<div id="downlist" style="display:none;_display:none">
以下内容仅支持HTML5模式
    <table align="center" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <th scope="col">格式</th>
        <th scope="col">分辨率</th>
        <th scope="col">下载地址</th>
      </tr>
<?php 
    $vlist = $_SESSION['vurl_'.$key];
    foreach ($vlist as $i){ ?>
      <tr>
        <td><?php echo $i["type"]; ?></td>
        <td><?php echo $i["quality"]; ?></td>
        <td><a href="vs.php?id=<?php echo $key; ?>&q=<?php echo $i["itag"]; ?>">下载</a></td>
      </tr>
    <?php } ?>
    </table>
</div>
