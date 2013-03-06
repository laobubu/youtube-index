<form action="./" method="get" onSubmit="s();">
<div align="center">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <label>视频ID/视频URL/搜索关键词<br><input name="uri" type="text" id="uri" size="40"></label>
  <p><input type="submit" value=" :: 打开 :: "><input name="type" type="hidden" id="type" value="search"></p>
  <p><a href="?type=advsearch&uri=" onClick="window.location.href='?type=advsearch&uri='+encodeURIComponent($('uri').value);return false;">高级搜索</a></p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div><script>$('uri').focus()</script>
</form>