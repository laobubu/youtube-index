function $(id){return document.getElementById(id)}
function s(){
	var o=$('uri');
	try {
		o.value=o.value.match("(watch\\?(.*)v=|youtu\\.be\/|\\d\\/)([a-zA-Z0-9-_]{11})")[3];
		$('type').value='watch';
	} catch (e){
		try {
			o.value=o.value.match("^([a-zA-Z0-9-_]{11})$")[0];
			$('type').value='watch';
		} catch (e){
			$('type').value='search';
		}
	}
}
ytarget=0;
function aniY(y){
	ytarget=y;
	setTimeout(ywork,40);
}
function ywork(){
	window.scrollTo(0,((window.scrollY+2)*3+ytarget)/4);
	if (window.scrollY<ytarget) setTimeout(ywork,40);
	else window.scrollTo(0,ytarget);
}