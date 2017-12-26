
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-31J" />
<title> テキストブロックを変更</title>
<script type="text/javascript">

window.onload = function() {
	document.getElementById('smaller').onclick=makeLess;
	document.getElementById('larger').onclick=makeMore;
}

function makeMore() {
	var div = document.getElementById("div1");
	div.style.fontSize="larger";
	div.style.letterSpacing="10px";
	div.style.textAlign="justify";
	div.style.textTranform="uppercase";
	div.style.fontSize="xx-large";
	div.style.fontWeight="900";
	div.style.lineHeight="40px";
}

function makeLess() {
	var div = document.getElementById("div1");
	div.style.fontSize="smaller";
	div.style.letterSpacing="normal";
	div.style.textAlign="left";
	div.style.textTransform="none";
	div.style.fontSize="medium";
	div.style.fontWeight="normal";
	div.style.lineHeight="normal";
}
</script>
</head>
<body>
	<p style="font-size": larger; font-weight: 3000;>
		<span id="smaller">
			縮小！！
		</span>
		&nbsp;&nbsp;
		<span id="larger">
			拡大！
		</span>
	</p>
	<div id="div1">
	<p>
		テキスト１
	</p>
	<p>
		テキスト２
	</p>
	</div>

</body>
</html>