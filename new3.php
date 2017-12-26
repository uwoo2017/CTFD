<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">



<HTML>
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>画像表示</title>
</HEAD>
<BODY>
<FORM method="POST" action="new3.php">
	<P>画像の表示</P>
	name：<INPUT type="text" name="name">
	<INPUT type="submit" name="submit" value="送信">
	<BR><BR>
</FORM>

<?php
if (count($_POST) > 0 && isset($_POST["submit"])){
	$name = $_POST["name"];
	if ($name==""){
		print("nameが入力されていません。<BR>\n");
	} else {
		print("<img src=\"img_get.php?name=" . $name . "\">");
	}
}
?>
</BODY>
</HTML>
