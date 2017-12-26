<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">
<center>
<br><br><br><br><br><br><br><br><br><br><br>
<?php
/*
//start.php
	print('<div class="balloon3">');
	
	echo 'クライアント　パターン<br>';
	
	print('</div>');

	
	echo'<br>';
	
*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>カウンセリング技術学習システム</title>

</head>

<body>
<br><br>
<?php

print('<table class=tbl_14>');
print('<tr><td>');
print('<form method="POST" action="simulation.php">');
print('<input type = "hidden" name ="userid" value="'.$_GET["id"].'">');
print('<input type="submit" button class="square_btn" value="シミュレーション"></button>');
print('</form>');
print('</td>');

print('<td>');
print('<form method="GET" action="simu_feedback.php">');
print('<input type="hidden" name="key" value="'.$_GET["id"].'">');
print('<input type="submit" button class="square_btn" value="シミュレーションの結果"></button>');
print('</form>');
print('</td>');
print('</tr>');
print('</table>');


print('<br><br><br><br><br>');
print('<table class=tbl_14>');
print('<tr><td>');
print('<form method="POST" action="quiz.php">');



print('<input type = "hidden" name ="userid" value="'.$_GET["id"].'">');
print('<input type="submit" button class="square_btn" value="国家試験対策"></button>');

print('</form>');
print('</td>');

print('<td>');
print('<form action="feedback.php"　method="POST" >');
print('<input type="hidden" name="key" value="'.$_GET["id"].'" >');
print('<input type="submit" button class="square_btn" value="国家試験対策の結果"></button>');
print('</form>');
print('</td></tr>');

print('</table>');

?>


<br><br><br><br><br><br><br><br><br><br><br>

</body>
<form action="start_login.php">
            <input type="submit" button class="square_btn" value="戻る"></button>
</form>
<br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br>
</center>
</html>