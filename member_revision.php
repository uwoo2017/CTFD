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
        $updateMessage = "";

// ログインボタンが押された場合
if (isset($_POST["update"])) {
    
    // 1. IDなどの入力チェック
    if (empty($_POST["name"])) {  // 値が空のとき
        $errorMessage = 'ユーザー名が未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["id"])) {
        $errorMessage = 'idが未入力です。';
    }

    if (!empty($_POST["id"]) &&!empty($_POST["name"]) && isset($_POST["state"]) ){
        // 入力したユーザIDとパスワードを格納
        $b_id=$_POST["b_id"];
        $id = $_POST["id"];
        $password = $_POST["password"];
        $name = $_POST["name"];
        $mailaddress = $_POST["mailaddress"];
        if (isset($_POST["result1"])){
            $result1 = $_POST["result1"];
        }else{
            $resule1 =NULL;
        }

        if (isset($_POST["result2"])){
            $result2 = $_POST["result2"];
        }else{
            $resule2 =NULL;
        }

        if (isset($_POST["result3"])){
            $result3 = $_POST["result3"];
        }else{
            $resule3 =NULL;
        }

        if (isset($_POST["result4"])){
            $result4 = $_POST["result4"];
        }else{
            $resule4 =NULL;
        }

        if (isset($_POST["result5"])){
            $result5 = $_POST["result5"];
        }else{
            $resule5 =NULL;
        }

        if (isset($_POST["charenge"])){
            $charenge = $_POST["charenge"];
        }else{
            $charenge =NULL;
        }
        $state  = $_POST["state"];

        

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
        
                // 3. エラー処理
                try {
                    $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        
                    $stmt = $pdo->prepare("UPDATE member SET id =?,password=?, name=?,mailaddress=?, result1 =?, result2 =?, result3=?, result4 =?, result5=?,charenge=?, state=? WHERE id =?");
        
                    $stmt->execute(array($id,$password, $name, $mailaddress, $result1, $result2, $result3, $result4, $result5,$charenge, $state, $b_id));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
                    //$userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる
        
                    $updateMessage = '修正が完了しました';  // 登録できたらidを表示
                } catch (PDOException $e) {
                    $errorMessage = 'データベースエラー';
                    // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
                     echo $e->getMessage();
                }
    }
}

if(isset($_POST['key'])){
    $b_id = $_POST['key'];
}
            
      //Create Query
      $query = "SELECT * from member where id='$b_id'";
      
      $result = mysql_query($query) or die($query . '<br />' . mysql_error() . '<hr />');
      //$num_rows = mysql_num_rows($result);
      
      
?>
<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ユーザー修正</title>
    </head>
    <body>
        <h1>管理者専用ユーザー　一覧</h1>
        <form id="updateForm" name="updateForm" action="" method="POST">
            <center>
            <fieldset>
                <legend>修正フォーム</legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo htmlspecialchars($updateMessage, ENT_QUOTES); ?></font></div>
                <?php
                //$query = "SELECT * FROM `quiz`";
                if(isset($_POST['id'])){
                    echo '<table class="tbl_06">';
                    echo '<tr>';
                    echo '<th>id</a></th>';//<a href="?s='.($base + 1).'">id
                    //echo '<th>password</a></th>';
                    echo '<th>名前</a></th>';
                    echo '<th>メールアドレス</a></th>';
                    echo '<th>結果1</a></th>';
                    echo '<th>結果2</a></th>';
                    echo '<th>結果3</a></th>';
                    echo '<th>結果4</a></th>';
                    echo '<th>結果5</a></th>';
                    echo '<th>挑戦回数</a></th>';
                    echo '<th>権限</a></th>';

                    echo '<tr>';
                    print('<td>'.$_POST['id'].'</td>');//.$row['id'].
                    //print('<input type="hidden" name="password" value='.$_POST['password'].'>');
                    print('<td>'.$_POST['name'].'</td>');
                    print('<td>'.$_POST['mailaddress'].'</td>');
                    print('<td>'.$_POST['result1'].'</td>');
                    print('<td>'.$_POST['result2'].'</td>');
                    print('<td>'.$_POST['result3'].'</td>');
                    print('<td>'.$_POST['result4'].'</td>');
                    print('<td>'.$_POST['result5'].'</td>');
                    print('<td>'.$_POST['charenge'].'</td>');
                    print('<td>'.$_POST['state'].'</td>');
                    
                    print('<input type="hidden" name="b_id" value="'.$_POST['b_id'].'">');
                    
                    
                    echo '</tr>';
                    echo '</table>';
                     
                }else if ($result = mysql_query($query)) {
                     
                    while ($row = mysql_fetch_array($result)) {

                        echo '<table class="tbl_09">';
                        
                        echo '<th>id</a></th>';
                        print('<td><input type="text" class="inputform2" name="id" value='.$row['id'].'></td>');//.$row['id'].
                        echo '<tr>';
                        print('<input type="hidden" class="inputform2" name="password" value='.$row['password'].'>');
                        echo '<th>名前</a></th>';
                        print('<td><input type="text" class="inputform2" name="name" value='.$row['name'].'></td>');
                        echo '<tr>';
                        echo '<th>メールアドレス</a></th>';
                        print('<td><input type="text" class="inputform2" name="mailaddress" value='.$row['mailaddress'].'></td>');
                        echo '<tr>';
                        echo '<th>結果1</a></th>';
                        print('<td><input type="text" class="inputform2" name="result1" value='.$row['result1'].'></td>');
                        echo '<tr>';
                        echo '<th>結果2</a></th>';
                        print('<td><input type="text" class="inputform2" name="result2" value='.$row['result2'].'></td>');
                        echo '<tr>';
                        echo '<th>結果3</a></th>';
                        print('<td><input type="text" class="inputform2" name="result3" value='.$row['result3'].'></td>');
                        echo '<tr>';
                        echo '<th>結果4</a></th>';
                        print('<td><input type="text" class="inputform2" name="result4" value='.$row['result4'].'></td>');
                        echo '<tr>';
                        echo '<th>結果5</a></th>';
                        print('<td><input type="text" class="inputform2" name="result5" value='.$row['result5'].'></td>');
                        echo '<tr>';
                        echo '<th>挑戦回数</a></th>';
                        print('<td><input type="text" class="inputform2" name="charenge" value='.$row['charenge'].'></td>');
                        echo '<tr>';
                        echo '<th>権限</a></th>';
                        print('<td><input type="text" class="inputform2" name="state" value='.$row['state'].'></td>');
                        echo '</tr>';
                        
                        
                        
                    }
                     echo '</table>';
                     print('<input type="hidden" name="b_id" value="'.$b_id.'">');
                     print('<input type="submit" button class="square_btn" name="update" value="更新"></button>');
                    
                } else {
                        echo mysql_error();
                }
                
                ?>
            </fieldset>
        </form>
        <br>
        <form action="member_search.php">
            <input type="submit" button class="square_btn" value="戻る"></button>
        </form>
        <br>
        <br>
            </center>
            <br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br>
    </body>
</html>
</div>