<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">


<?php
//esdb.php
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>カウンセリング技術学習システム</title>
</head>
<body>
<?php
/*
if(count($q_c)==10){
	print('<form method="POST" action="end.php">');
	//print('<input type="hidden"name="array" value="'.$ar.'">');
	print('<input type="hidden"name="yes_c" value="'.$yes_c.'">');
	print('<button type="submit">次へ</button>');
	
}else{
*/
print('<center>');
print('<br>');
print('<br>');
print('<form method="POST" action="member_search.php">');

print('<button class="square_btn type="button">ユーザー検索</button>');

print('</form>');


print('<br>');

print('<form method="POST" action="member_regist.php">');

print('<button class="square_btn type="button">ユーザー登録</button>');

print('</form>');
print('<br>');
print('<br>');
print('<br>');
print('<br>');

print('<br>');
print('<br>');
print('<form method="POST" action="quiz_search.php">');

print('<button class="square_btn type="button">国家試験対策問題検索</button>');

print('</form>');


print('<br>');



print('<form method="POST" action="quiz_regist.php">');

print('<button class="square_btn type="button">国家試験対策問題登録</button>');

print('</form>');
print('<br>');
print('<br>');
print('<br>');


print('<form method="POST" action="img_search.php">');

print('<button class="square_btn type="button">画像検索</button>');

print('</form>');
print('<br>');
print('<form method="POST" action="img_regist.php">');

print('<button class="square_btn type="button">画像登録</button>');

print('</form>');

print('<br>');
print('<br>');
print('<br>');


print('<form method="POST" action="simu_search.php">');

print('<button class="square_btn type="button">シミュレーション問題検索</button>');

print('</form>');
print('<br>');
print('<form method="POST" action="simu_regist.php">');

print('<button class="square_btn type="button">シミュレーション問題登録</button>');

print('</form>');
print('<br>');
print('<br>');
print('<br>');

print('<form method="POST" action="mail.php">');

print('<button class="square_btn type="button">メールフォーム(未実装)</button>');





?>
</form>
<br>
<br>
<form action="esdb_login.php">
<input type="submit" button class="square_btn" value="戻る"></button>
</form>
</center>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br>

</body>
</html>