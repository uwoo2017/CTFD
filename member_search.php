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
            <title>ユーザー 一覧</title>
    </head>
    <body>
        <h1>管理者専用ユーザー 一覧</h1>
        <center>
            <fieldset>
                <legend><h2>ユーザー 一覧</h2></legend>
                
                
                <?php
error_reporting(E_ALL & ~E_NOTICE);
    if ($_GET['s'] == "") {
        //パラメータsが指定されなかった場合は、1とする
        $_GET['s'] = 1;
    }
    switch ($_GET['s'] % 10) {
        case 1:
            $sort = "id";
            break;
        case 2:
            $sort = "name";
            break;
        case 3:
            $sort = "";
            break;
    }
    if ($_GET['s'] < 10) {
        $base = 10;
        $sortby = 'ASC'; //昇順
    } else {
        $base = 0;
        $sortby = 'DESC'; //降順
    }











                $query = "SELECT * FROM `member` ORDER BY `{$sort}` {$sortby}";
                if ($result = mysql_query($query)) {
                    print('<table class="tbl_05">');//class="type07"
                    print('<tr>');
                    
                    print('<th ><a href="?s='.($base + 1).'">id</a></th>');
                    print('<th >名前</th>');
                    print('<th >メールアドレス</th>');
                    print('<th >結果1</th>');
                    print('<th >結果2</th>');
                    print('<th >結果3</th>');
                    print('<th >結果4</th>');
                    print('<th >結果5</th>');
                    print('<th >挑戦回数</th>');
                    print('<th >権限</th>');
                    print('</tr>');
                    
                     
                     
                     while ($row = mysql_fetch_array($result)) {
                        print('<tr>');
                        print("<td class='even'>{$row['id']}</td>");
                        print("<td>{$row['name']}</td>");
                        print("<td class='even'>{$row['mailaddress']}</td>");
                        print("<td>{$row['result1']}</td>");
                        print("<td class='even'>{$row['result2']}</td>");
                        print("<td>{$row['result3']}</td>");
                        print("<td class='even'>{$row['result4']}</td>");
                        print("<td>{$row['result5']}</td>");
                        print("<td class='even'>{$row['charenge']}</td>");
                        print("<td>{$row['state']}</td>");
                        print("<td>");
                        print('<form id="registForm" name="registForm" action="member_revision.php" method="POST">');
                        print('<input type="hidden" name="key" value="'.$row['id'].'">');
                        print('<input type="submit" button class="square_btn" value="修正"></button><br><br>');
                        print('</form>');
                        print('<form name ="deleteForm" action="member_delete.php" method="POST">');
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
        
        <br>
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