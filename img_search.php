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
        <h1>管理者専用画像一覧</h1>
        <center>
            <fieldset>
                
                <legend><h2>画像一覧</h2></legend>
                <?php
                $query = "SELECT * FROM `img_table`";
                if ($result = mysql_query($query)) {
                     echo '<table class="tbl_10">';
                     print('<tr>');
                     //<a href="?s='.($base + 1).'">id
                     print('<th >id</th>');
                     print('<th >name</th>');
                     print('<th >画像</th>');
                     print('</tr>');
                     
                     while ($row = mysql_fetch_array($result)) {
                         echo '<tr>';
                         print("<td>{$row['id']}</td>");
                         print("<td>{$row['name']}</td>");
                         print("<td>");
                         print("<img src=".$row['path'].">");
                         print("</td>");
                         print("<td>");
                         print('<form id="registForm" name="registForm" action="img_revision.php" method="POST">');
                         print('<input type="hidden" name="key" value="'.$row['id'].'">');
                         print('<input type="submit" button class="square_btn" value="修正"></button><br><br>');
                         print('</form>');
                         print('<form name ="deleteForm" action="img_delete.php" method="POST">');
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