<?php 
include('xinc.php');
if (isset($_GET['uri'])) {
$key = $_GET['uri'];
switch ($_GET['type']){
case 'watch':
	include('nglib.php');
	$f=getVInfo($key);//net('http://www.youtube.com/get_video_info?video_id='.$key);
	$a=array();
	parse_str($f,$a);
	if (count($a)<4) {
		header('location: fixer.php');
		die('<a href="fixer.php">FIX ERROR</a>');
	}
	$title=$a['title'];
	//$vlist=getVList($f,array());
	break;
case 'thumb':
	if (USE_PHP_IMAGE_PROXY) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://i.ytimg.com/vi/'.$key.'/0.jpg');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
		@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$f = curl_exec($ch);
		curl_close($ch);
		@ob_end_clean();
		header('Content-Type: image/jpeg');
		die($f);
	} else {
		header('Location: https://images2-focus-opensocial.googleusercontent.com/gadgets/proxy?url=http%3A%2F%2Fi.ytimg.com%2Fvi%2F'.$key.'%2F0.jpg&container=focus&gadget=a&no_expand=1&resize_h=0&rewriteMime=image%2F*');
	}
	exit;
case 'advsearch': 
	$title='高级搜索';
	break;
case 'ap':
	$b=simplexml_load_string(net('http://gdata.youtube.com/'.$key));
	ob_end_clean();
	$rtn = json_encode($b);
	if (isset($_GET['encode_magickey'])) {
		$a = intval($_GET['encode_magickey']);
		function encode_char(&$ch){
			global $a;
			return chr(ord($ch)+$a);
		}
		preg_match_all('/([\d\D])/s',$rtn,$bytes);
		$bytes=array_map('encode_char',$bytes[1]) ;
		$rtn=implode('',$bytes);
	}
	die($rtn);
default:
	$title='搜索';
}}
include('skin/'.SKIN_PATH.'/head.php');
if (isset($_GET['uri'])) {
	switch ($_GET['type']){
	case 'advsearch': 
		function advsearch_form_header($HTMLattrs=""){ ?>
<form action="./" method="get" <?php echo $HTMLattrs; ?>>
<?php  }	function advsearch_form_fields($line_breaker="<br>",$label_breaker="：") { ?>
<label>关键词<?php echo $label_breaker ?><input name="uri" type="text" id="uri" size="40" value="<?php if(isset($_GET['uri'])){echo $_GET['uri'];} ?>"></label><?php echo $line_breaker; ?>
<label>排序<?php echo $label_breaker ?><select name="s_orderby">
  <option value="relevance">相关性</option>
  <option value="published">发布时间</option>
  <option value="viewCount">观看次数</option>
  <option value="rating">评分</option>
</select></label><?php echo $line_breaker; ?>
<label>上传者<?php echo $label_breaker ?><input name="s_uploader" type="text" size="40" autocomplete="off"></label><?php echo $line_breaker; ?>
<input name="type" type="hidden" id="type" value="search">
<?php } 	function advsearch_form_footer() { ?>
</form>
<?php }
		include('skin/'.SKIN_PATH.'/advsearch.php');
		break;
	case 'watch': 
		function dataformat($num) {
		  $hour = floor($num/3600);
		  $minute = floor(($num-3600*$hour)/60);
		  $second = floor((($num-3600*$hour)-60*$minute)%60);
		  echo $hour.':'.$minute.':'.$second;
		}
		unset($_SESSION['vurl_'.$_GET['uri']]);
		include('skin/'.SKIN_PATH.'/play.php');
		break;
	default:
		$page=1;
		$extraarg = '';
		if (isset($_GET['s_uploader'])) $extraarg.='&author='.urlencode($_GET['s_uploader']);
		if (isset($_GET['s_orderby'])) $extraarg.='&orderby='.urlencode($_GET['s_orderby']);
		if (isset($_GET['page'])) $page=intval($_GET['page']);
		if ($page<1) $page=1;
		$xml=simplexml_load_string(net('http://gdata.youtube.com/feeds/api/videos?q='.urlencode($_GET['uri']).'&start-index='.($page*24-23).'&max-results=24&v=2'.$extraarg));
		if (!$xml) $_search_fail = 1;
		include('skin/'.SKIN_PATH.'/result.php');
	}
} else {
	include('skin/'.SKIN_PATH.'/index.php');
}
include('skin/'.SKIN_PATH.'/foot.php'); ?>