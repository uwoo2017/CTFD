<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">

<?php


//データベース設定
$cfg['DB_SERVER'] = "localhost";    //DBサーバー名
$cfg['DB_USER'] = "root";            //DBユーザー名
$cfg['DB_PASSWD'] = "test1234";        //DBユーザーパスワード
$cfg['DB_NAME'] = "esdb";            //データベース名

  

// 1. ユーザIDとパスワードが入力されていたら認証する
$myid = mysql_connect($cfg['DB_SERVER'], $cfg['DB_USER'], $cfg['DB_PASSWD']);

mysql_select_db($cfg['DB_NAME']);

//MySQLのクライアントの文字コードをutf8に設定
mysql_query("SET NAMES utf8")
or die("can not SET NAMES utf8");  

//パラメータによって、ソート項目を変更
/*
if ($_GET['s'] == "") {
    //パラメータsが指定されなかった場合は、1とする
    $_GET['s'] = 1;
}
switch ($_GET['s'] % 10) {
    case 1:
        $sort = "id";
        break;
}
if ($_GET['s'] < 10) {
    $base = 10;
    $sortby = 'ASC'; //昇順
} else {
    $base = 0;
    $sortby = 'DESC'; //降順
}
*/
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>問題一覧</title>
    </head>
    <body>
        <h1>管理者専用問題一覧</h1>
        <center>
            <fieldset>
                
                <legend><h2>問題一覧</h2></legend>
                <?php
                $query = "SELECT * FROM `quiz`";
                if ($result = mysql_query($query)) {
                     echo '<table class="tbl_07">';
                     print('<tr>');
                     //<a href="?s='.($base + 1).'">id
                     print('<th >id</th>');
                     print('<th >質問</th>');
                     print('<th >回答1</th>');
                     print('<th >回答2</th>');
                     print('<th >回答3</th>');
                     print('<th >回答4</th>');
                     print('<th >回答5</th>');
                     print('<th >答え</th>');
                     print('</tr>');
                     
                     while ($row = mysql_fetch_array($result)) {
                         echo '<tr>';
                         print("<td class='even'>{$row['id']}</td>");
                         print("<td>{$row['question']}</td>");
                         print("<td class='even'>{$row['text1']}</td>");
                         print("<td>{$row['text2']}</td>");
                         print("<td class='even'>{$row['text3']}</td>");
                         print("<td>{$row['text4']}</td>");
                         print("<td class='even'>{$row['text5']}</td>");
                         print("<td>{$row['answer']}");
                         if(isset($row['answer2'])){
                             print(','.$row['answer2']);
                         }
                         print("</td>");
                         print("<td>");
                         print('<form name="testform" action="quiz.php" method="POST">');
                         print('<input type="hidden" name="master" value="'.$row['id'].'">');
                         print('<input type="submit" button class="square_btn" value="表示"></button><br><br>');
                         print('</form>');
                         print('<form id="registForm" name="registForm" action="quiz_revision.php" method="POST">');
                         print('<input type="hidden" name="key" value="'.$row['id'].'">');
                         print('<input type="submit" button class="square_btn" value="修正"></button><br><br>');
                         print('</form>');
                         print('<form name ="deleteForm" action="quiz_delete.php" method="POST">');
                         print('<input type="hidden" name="key" value="'.$row['id'].'">');
                         print('<input type="submit" button class="square_btn" value="削除"></button></td>');
                         print('</form>');
                         
                         echo '</tr>';
                     }
                     echo '</table>';
                 } else {
                     echo mysql_error();
                 }
                ?>
            </fieldset>
        
        <br>
        
        </center>
        <form action="esdb.php">
            <input type="submit" button class="back_btn" value="戻る"></button>
        </form>
        <br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br>
    </body>
</html>
</div>