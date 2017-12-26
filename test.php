<?php

function quote_smart($value)
{
    // 数値以外をクオートする
    if (!is_numeric($value)) {
        $value = "'" . mysql_real_escape_string($value) . "'";
    }
    return $value;
}


$link = mysql_connect('localhost', 'root', 'test1234');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}
print('<p>接続に成功しました。</p>');


$db_selected = mysql_select_db('esdb', $link);
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

$id = 5;
$name = 'デジタルカメラ';


$sql = sprintf("UPDATE shouhin SET name = %s WHERE id = %s"
         , quote_smart($name), quote_smart($id));

$result_flag = mysql_query($sql);

if (!$result_flag) {
    die('UPDATEクエリーが失敗しました。'.mysql_error());
}
*/



print('<p>追加後のデータを取得します。</p>');

$result = mysql_query('SELECT * FROM quiz');
if (!$result) {
    die('SELECTクエリーが失敗しました。'.mysql_error());
}

while ($row = mysql_fetch_assoc($result)) {
    print('<p>');
    print('id='.$row['id'].'<p>');
    print(',question='.$row['question'].'<p>');
    print(',text1='.$row['text1'].'<p>');
    print(',text2='.$row['text2'].'<p>');
    print(',text3='.$row['text3'].'<p>');
    print(',text4='.$row['text4'].'<p>');
    print(',text5='.$row['text5'].'<p>');
    print(',answer='.$row['answer'].'<p>');
    print('</p>');
}

$result = mysql_query('SELECT * FROM quiz order by rand();');
$row = mysql_fetch_assoc($result);
$title = $row['question'];
// '目標を達成できなかったクライアントの訴えに対するカウンセラーの共感的対応に関する記述である。正しいのはどれ?';
 
$question = array(); //この変数は配列ですよという宣言
$question = array($row['text1'],$row['text2'],$row['text3'],$row['text4'],$row['text5']); //4択の選択肢を設定
 
$answer = $question[$row['answer']]; //正解の問題を設定

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

<?php
$close_flag = mysql_close($link);



if ($close_flag){
    print('<p>切断に成功しました。</p>');
}
?>