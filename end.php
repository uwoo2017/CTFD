<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">

<br><br><br><br><br><br>
<?php

if(isset($_POST['userid'])){
	$userid = $_POST['userid'];
	//echo $userid;
}

//end.php
$res = $_POST["yes_e"];

//データベースにいれる
$debug = false;
//DB Connect
$url = "localhost";
$user = "root";
$pass = "test1234";
$dtb = "esdb";


//PDOでの定義
$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "test1234";  // ユーザー名のパスワード
$db['dbname'] = "esdb";  // データベース名




$link = mysql_connect($url,$user,$pass) or die("No Connected");
$sdb = mysql_select_db($dtb,$link) or die("No Selected");

//MySQLのクライアントの文字コードをutf8に設定
mysql_query("SET NAMES utf8")
or die("can not SET NAMES utf8");  

if($debug) print_r($_POST);


//Create Query
$query = "SELECT * from member where id='$userid'";

$result = mysql_query($query) or die($query . '<br />' . mysql_error() . '<hr />');
//$num_rows = mysql_num_rows($result);

$row = mysql_fetch_array($result);

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
		
				// 3. エラー処理
				try {
					$pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
					
					if(isset($row['charenge'])){
						
						$charenge = $row['charenge']+1;
						//$charenge+=1;
						
					}else{
						$charenge=1;
					}

					if($row['charenge']%5==0 || !isset($row['charenge'])){
						
						

						$stmt = $pdo->prepare("UPDATE member SET result1 =?,charenge=?WHERE id =?");
						
						$stmt->execute(array($res,$charenge,$userid)); 
					}else if($row['charenge']%5==1){

						$stmt = $pdo->prepare("UPDATE member SET result2 =?,charenge=?WHERE id =?");
						
						$stmt->execute(array($res,$charenge,$userid));

					}else if($row['charenge']%5==2){
						
						$stmt = $pdo->prepare("UPDATE member SET result3 =?,charenge=?WHERE id =?");
						
						$stmt->execute(array($res,$charenge,$userid));
						
						
												
					}else if($row['charenge']%5==3){
						
						$stmt = $pdo->prepare("UPDATE member SET result4 =?,charenge=?WHERE id =?");
						
						$stmt->execute(array($res,$charenge,$userid));
						
												
					}else if($row['charenge']%5==4){
												
						$stmt = $pdo->prepare("UPDATE member SET result5 =?,charenge=?WHERE id =?");
						
						$stmt->execute(array($res,$charenge,$userid));
						
												
					}
					//$updateMessage = '修正が完了しました';  // 登録できたらidを表示
				} catch (PDOException $e) {
					$errorMessage = 'データベースエラー';
					// $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
					 echo $e->getMessage();
				}



//UPDATE `member` SET `result4` = '3' WHERE `member`.`id` = '100';







	print('<center>');
	print('<div class="balloon3">');
	print('<font size ="5">');
	echo '最終結果<br>';
	echo '10問中';
	echo $res;
	echo '問正解！';
	print('</font>');
	print('</div>');

	
	echo'<br>';
	/*
	print('<div class="balloon3">');
	print('<font size="6">');
	echo '正答率';
	echo $res;
	echo '0%です';
	print('</font>');
	print('</div>');
	echo '<br>';

	/*
	echo 'ただいまの正解数';
	echo $yes_c;
	echo '<br>';


}else{
	echo 'チェックされていません<br>';
	echo 'ブラウザバックしてください';

}
	*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>栄養自習システム - 結果</title>
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
print('<form method="GET" action="start.php">');
print('<input type = "hidden" name ="id" value="'.$userid.'">');
//print('<input type="hidden"name="array" value="'.$ar.'">');
//	print('<input type="hidden"name="yes_c" value="'.$yes_c.'">');
print('<button class="square_btn type="button">始めに戻る</button>');
?>
</form>
<br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br>
</body>
</html>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>