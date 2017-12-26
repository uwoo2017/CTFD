<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">
<?php

session_start();
      $debug = false;
      //DB Connect
      $url = "localhost";
      $user = "root";
      $pass = "test1234";
      $dtb = "esdb";

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


      // エラーメッセージ、登録完了メッセージの初期化
        $errorMessage = "";
        $deleteMessage = "";

// ボタンが押された場合
if (isset($_POST["delete"])) {
    


    if (!empty($_POST["b_id"]) ){
        // IDを格納
        $b_id=$_POST["b_id"];
               

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("DELETE FROM quiz WHERE id =?");

            $stmt->execute(array($b_id));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            //$userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $deleteMessage = '削除が完了しました';  // 登録できたらidを表示
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
            // echo $e->getMessage();
        }
    }
}

if(isset($_POST['key'])){
    $b_id = $_POST['key'];


      //Create Query

      $query = "SELECT * from quiz where id='$b_id'";
      
      $result = mysql_query($query) or die($query . '<br />' . mysql_error() . '<hr />');
      //$num_rows = mysql_num_rows($result);
}      
      
?>
<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>問題削除</title>
    </head>
    <body>
        <h1>管理者専用問題削除画面</h1>
        <form id="deleteForm" name="deleteForm" action="" method="POST">
            <center>
            <fieldset>
                <legend>削除フォーム</legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo htmlspecialchars($deleteMessage, ENT_QUOTES); ?></font></div>
                <?php
                //$query = "SELECT * FROM `quiz`";
                if(isset($_POST['key'])){
                    if ($result = mysql_query($query)) {
                    echo '<table class="tbl_08">';
                    echo '<th>id</a></th>';//<a href="?s='.($base + 1).'">id とかやると、クリックして飛ばせる
                    echo '<th>質問</a></th>';
                    echo '<th>回答1</a></th>';
                    echo '<th>回答2</a></th>';
                    echo '<th>回答3</a></th>';
                    echo '<th>回答4</a></th>';
                    echo '<th>回答5</a></th>';
                    echo '<th>答え</a></th>';
                     
                        while ($row = mysql_fetch_array($result)) {
                            echo '<tr>';
                            print('<td>'.$row['id'].'</td>');
                            print('<td>'.$row['question'].'</td>');
                            print('<td>'.$row['text1'].'</td>');
                            print('<td>'.$row['text2'].'</td>');
                            print('<td>'.$row['text3'].'</td>');
                            print('<td>'.$row['text4'].'</td>');
                            print('<td>'.$row['text5'].'</td>');
                            print('<td>'.$row['answer'].'</td>');
                            echo "<td>";
                            print('<input type="hidden" name="b_id" value="'.$b_id.'">');
                            print('<input type="submit" button class="square_btn" name="delete" value="削除"></button></td>');
                            
                            
                            echo '</tr>';
                        }
                    }
                     echo '</table>';
                    
                } else {
                        echo mysql_error();
                }
                ?>
            </fieldset>
            
        </form>
        <br>
        <form action="quiz_search.php">
            <input type="submit" button class="square_btn" value="戻る"></button>
        </form><br><br>
        </center>
        <br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br>
    </body>
</html>
</div>