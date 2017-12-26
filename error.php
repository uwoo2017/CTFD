<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">

aaaaaaaaaaaaaa
<?php
//login.php
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>カウンセリング技術学習システム</title>
</head>
<body>
<?php

session_start();
$ar=$_SESSION['aarr'];
$yes_c=$_SESSION['yes_c'];

echo($ar);
print('<br>');
print('<br>');
echo($yes_c);



/*
if(count($q_c)==10){
	print('<form method="POST" action="end.php">');
	//print('<input type="hidden"name="array" value="'.$ar.'">');
	print('<input type="hidden"name="yes_c" value="'.$yes_c.'">');
	print('<button type="submit">次へ</button>');
	
}else{

	print('<br>');
	print('<br>');
	print('<form method="POST" action="start_login.php">');

	print('<button class="square_btn type="button">学習者ログイン</button>');





    */

	print('チェックされていません');
	print('<br>');
    print('<br>');

    print('<form method="POST" action="quiz.php">');
    print('<input type="hidden" name="yes_c" value="'.$yes_c.'">');
    print('<input type="hidden" name="array" value="'.$ar.'">');
	print('<button class="square_btn type="button">戻る</button>');

	print('<br>');
    print('<br>');

?>
</form>
</body>
</html>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>