


<table border="1">
 <tr><th>名前</th><th>価格</th></tr>
 <?php

function quote_smart($value)
{
    // 数値以外をクオートする
    if (!is_numeric($value)) {
        $value = "'" . mysql_real_escape_string($value) . "'";
    }
    return $value;
}


   $pdo = new PDO("mysql:dbname=men;charset-utf8;", 'root','test1234');
   
   $st = $pdo->query("SELECT * FROM udon");
   while ($row = $st->fetch()) {
     $name = ('名前'.($row['name']));
     $price = htmlspecialchars($row['price']);
     echo "<tr><td>$name</td><td>$price 円</td></tr>";
   }
 ?>
 </table>

<?php







$link = mysql_connect('localhost', 'root', 'test1234');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}
print('<p>接続に成功しました。</p>');


$db_selected = mysql_select_db('uriage', $link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}

print('<p>uriageデータベースを選択しました。</p>');






// MySQLに対する処理


mysql_set_charset('utf8');

print('<p>データを追加します。</p>');

/*$sql = "INSERT INTO shouhin (id, name) VALUES (4, 'プリンター')";
$result_flag = mysql_query($sql);

if (!$result_flag) {
    die('INSERTクエリーが失敗しました。'.mysql_error());
}


$id = 5;
$name = "Toyama's Wine";

$sql = sprintf("INSERT INTO shouhin (id, name) VALUES (%s, %s)"
         , quote_smart($id), quote_smart($name));


print('<p>エスケープ後のデータ:'.quote_smart($name).'</p>');

$result_flag = mysql_query($sql);

if (!$result_flag) {
    die('INSERTクエリーが失敗しました。'.mysql_error());
}
*/
$id = 5;
$name = 'デジタルカメラ';

$sql = sprintf("UPDATE shouhin SET name = %s WHERE id = %s"
         , quote_smart($name), quote_smart($id));

$result_flag = mysql_query($sql);

if (!$result_flag) {
    die('UPDATEクエリーが失敗しました。'.mysql_error());
}




print('<p>追加後のデータを取得します。</p>');

$result = mysql_query('SELECT id,name FROM shouhin');
if (!$result) {
    die('SELECTクエリーが失敗しました。'.mysql_error());
}

while ($row = mysql_fetch_assoc($result)) {
    print('<p>');
    print('id='.$row['id']);
    print(',name='.$row['name']);
    print('</p>');
}

$close_flag = mysql_close($link);



if ($close_flag){
    print('<p>切断に成功しました。</p>');
}

 
$title = '目標を達成できなかったクライアントの訴えに対するカウンセラーの共感的対応に関する記述である。正しいのはどれ?';
 
$question = array(); //この変数は配列ですよという宣言
$question = array('やり方に問題があったのですよ。','なかなかできないんですよね。','できなかったところをもう少しくわしく教えていただけませんか。','どうしたらよいか考えてみて下さい。','もう少し根気よく頑張ればできますよ。'); //4択の選択肢を設定
 
$answer = $question[1]; //正解の問題を設定

shuffle($question); //配列の中身をシャッフル
 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>栄養自習システム</title>
</head>
<body>

 
<h2><?php echo $title ?></h2>
<form method="POST" action="answer.php">
 <?php foreach($question as $value){ ?>
 <input type="radio" name="question" value="<?php echo $value; ?>" /> <?php echo $value; ?><br>
 <?php } ?>
 <input type="hidden" name="answer" value="<?php echo $answer ?>">
 <input type="submit" value="回答する">
</form>
 
</body>
</html>