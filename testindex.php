登録用画面(index.php) 
<?php
//セッション管理の設定
session_start();
//セッション変数の設定
$_SESSION['register'] = 0   //0:未送信　1:送信済み
?>
<html>
    ・
    ・
    ・
<form method="post" action="confirm.php?<?=SID?>">
<input type="text" name="name" value="<? echo htmlspecialchars($name) ?>" /><br>
<input type="text" name="address" value="<? echo htmlspecialchars($address) ?>" /><br>
<input type="text" name="tel" value="<? echo htmlspecialchars($tel) ?>" /><br>
<input type="submit" value="確認" />
</form>
    ・
    ・
    ・

 登録確認画面(confirm.php) 
<?php
session_start();
//連続送信をセッションの値によって確認する
if ($_SESSION['register'] == 1) {
    //送信済み
    header("HTTP/1.1 301 Moved permanently");
    header("Location: http://" .$_SERVER["SERVER_NAME"].dirname($_SERVER["REQUEST_URI"])."/error.html");
    exit;
} else if (!isset($_SESSION['register']) || $_SESSION['register'] != 0){
    //不正なページからのアクセス
    header("HTTP/1.1 301 Moved permanently");
    header("Location: http://" .$_SERVER["SERVER_NAME"].dirname($_SERVER["REQUEST_URI"])."/error.html");
    exit;
}
?>
<html>
    ・
    ・
    ・
<!-- 確認表示 -->
氏名：<?php echo htmlspecialchars($name); echo $error['name']; ?><br />
住所：<?php echo htmlspecialchars($address); echo $error['address']; ?><br />
    ・
    ・
    ・
<!-- 戻る」ボタン作成 -->
<form method="post" action="index.php?<?=SID?>">
<input type="hidden" name="name" value="<? echo htmlspecialchars($name) ?>" />
<input type="hidden" name="address" value="<? echo htmlspecialchars($address) ?>" />
<input type="hidden" name="tel" value="<? echo htmlspecialchars($tel) ?>" />
<input type="submit" value="戻る" />
</form>
    ・
    ・
    ・

 エラー画面 
<html>
    ・
    ・
<body>
リロードボタンやバックボタンは使わないで下さい。<br />
<a href="index.php">最初からやり直す。</a>
</body>
</html>

 なお、JavaScriptによる連続送信防止は、以下の通りです。 
<html>
<head>
<title>連打防止</title>
<script type="text/javascript">
<!--
submitted = false;
function formSubmit(button) {
    if (submitted == false) {
        submitted = true;
        button.form.submit();
        button.disabled = true;
    } else {
        alert("送信中です。お待ちください。");
    }
}
//-->
</script>
</head>
<body>
<form method="post" action="post.php">
<script type="text/javascript">
<!--
	document.write(
		"<input type='button' value='送信' onClick='return formSubmit(this);'>");
//-->
</script>
<noscript>
	<input type="submit" value="送信">
</noscript>
</form>
</body>
</head>
</html>

