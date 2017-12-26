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
    if (empty($_POST["question"])) {  // 値が空のとき
        $errorMessage = 'ユーザー名が未入力です。';
    } else if (empty($_POST["text1"])) {
        $errorMessage = '回答1が未入力です。';
    } else if (empty($_POST["text2"])) {
        $errorMessage = '回答2が未入力です。';
    } else if (empty($_POST["text3"])) {
        $errorMessage = '回答3が未入力です。';
    } else if (empty($_POST["text4"])) {
        $errorMessage = '回答4が未入力です。';
    } else if (empty($_POST["id"])) {
        $errorMessage = 'idが未入力です。';
    }else if (empty($_POST['score1'])){
        $errorMessage = '得点1の値が未入力です。';
    }else if (empty($_POST['score2'])){
        $errorMessage = '得点2の値が未入力です。';
    }else if (empty($_POST['score3'])){
        $errorMessage = '得点3の値が未入力です。';
    }else if (empty($_POST['score4'])){
        $errorMessage = '得点4の値が未入力です。';
    }

    if (!empty($_POST["id"]) &&!empty($_POST["question"]) && !empty($_POST["text1"]) && !empty($_POST["text2"])
    && !empty($_POST["text3"])&& !empty($_POST["text4"]) && !empty($_POST["score1"]) && !empty($_POST["score2"])
    && !empty($_POST["score3"]) && !empty($_POST["score4"]) ){
        // 入力したユーザIDとパスワードを格納
        $b_id=$_POST["b_id"];
        $id = $_POST["id"];
        $question = $_POST["question"];
        $text1 = $_POST["text1"];
        $text2 = $_POST["text2"];
        $text3 = $_POST["text3"];
        $text4 = $_POST["text4"];
        $score1=$_POST["score1"];
        $score2=$_POST["score2"];
        $score3=$_POST["score3"];
        $score4=$_POST["score4"];

        

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("UPDATE simulation SET id =?, question=?, text1 =?, text2 =?, text3=?, text4 =?, score1=?, score2=?, score3=?, score4=? WHERE id =?");

            $stmt->execute(array($id,$question, $text1, $text2, $text3, $text4, $score1,$score2,$score3,$score4,$b_id));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            //$userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $updateMessage = '修正が完了しました';  // 登録できたらidを表示
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
            // echo $e->getMessage();
        }
    }
}

if(isset($_POST['key'])){
    $b_id = $_POST['key'];
}
            
      //Create Query
      $query = "SELECT * from simulation where id='$b_id'";
      
      $result = mysql_query($query) or die($query . '<br />' . mysql_error() . '<hr />');
      //$num_rows = mysql_num_rows($result);
      
      
?>
<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>問題修正</title>
    </head>
    <body>
        <h1>管理者専用問題</h1>
        <form id="updateForm" name="updateForm" action="" method="POST">
            <center>
            <fieldset>
                <legend><h2>修正フォーム</h2></legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo htmlspecialchars($updateMessage, ENT_QUOTES); ?></font></div>
                <?php
                //Noiceを無視
                error_reporting(E_ALL & ~E_NOTICE);


                //$query = "SELECT * FROM `quiz`";
                if(isset($_POST['id'])){
                    echo '<table class="tbl_08">';
                    echo '<th>id</a></th>';//<a href="?s='.($base + 1).'">id とかやると、クリックして飛ばせる
                    echo '<th>質問</a></th>';
                    echo '<th>回答1</a></th>';
                    echo '<th>回答2</a></th>';
                    echo '<th>回答3</a></th>';
                    echo '<th>回答4</a></th>';
                    echo '<th>得点1</a></th>';
                    echo '<th>得点2</a></th>';
                    echo '<th>得点3</a></th>';
                    echo '<th>得点4</a></th>';

                    echo '<tr>';
                    print('<td>'.$_POST['id'].'</td>');//.$row['id'].
                    print('<td>'.$_POST['question'].'</td>');
                    print('<td>'.$_POST['text1'].'</td>');
                    print('<td>'.$_POST['text2'].'</td>');
                    print('<td>'.$_POST['text3'].'</td>');
                    print('<td>'.$_POST['text4'].'</td>');
                    
                    print('<td>'.$_POST['score1'].'</td>');
                    print('<td>'.$_POST['score2'].'</td>');
                    print('<td>'.$_POST['score3'].'</td>');
                    print('<td>'.$_POST['score4'].'</td>');
                    
                    print('<input type="hidden" name="b_id" value="'.$_POST['b_id'].'">');
                    
                    
                    echo '</tr>';
                    echo '</table>';
                     
                }else if ($result = mysql_query($query)) {
                    echo '<table class="tbl_12">';
                    echo '<th>id</a></th>';//<a href="?s='.($base + 1).'">id とかやると、クリックして飛ばせる
                    echo '<th>質問</a></th>';
                    echo '<th>回答1</a></th>';
                    echo '<th>回答2</a></th>';
                    echo '<th>回答3</a></th>';
                    echo '<th>回答4</a></th>';


                    
                    
                    while ($row = mysql_fetch_array($result)) {


                        /*
                        switch($row['answer']){
                            case 1:
                                $check1='checked';
                                break;
                            case 2:
                                $check2='checked';
                                break;
                            case 3:
                                $check3='checked';
                                break;
                            case 4:
                                $check4='checked';
                                break;
                            case 5:
                                $check5='checked';
                        }
                        */






                        echo '<tr>';
                        print('<td><input  type="text" style="font-size:1.2em" size="5" name="id" value='.$row['id'].'></td>');//.$row['id'].
                        print('<td><textarea style="font-size:1.2em" name="question" cols=15 rows=4>'.$row['question'].'</textarea></td>');
                        print('<td><textarea style="font-size:1.2em" name="text1" cols=15 rows=4>'.$row['text1'].'</textarea></td>');
                        print('<td><textarea style="font-size:1.2em" name="text2" cols=15 rows=4>'.$row['text2'].'</textarea></td>');
                        print('<td><textarea style="font-size:1.2em" name="text3" cols=15 rows=4>'.$row['text3'].'</textarea></td>');
                        print('<td><textarea style="font-size:1.2em" name="text4" cols=15 rows=4>'.$row['text4'].'</textarea></td>');

                        
                        echo '</tr>';
                    

                    echo '<th>得点1</a></th>';
                    echo '<th>得点2</a></th>';
                    echo '<th>得点3</a></th>';
                    echo '<th>得点4</a></th>';
                    


                    
                        echo  '<tr>';
                        print('<td><textarea style="font-size:1.2em" name="score1" cols=15 rows=4>'.$row['score1'].'</textarea></td>');
                        print('<td><textarea style="font-size:1.2em" name="score2" cols=15 rows=4>'.$row['score2'].'</textarea></td>');
                        print('<td><textarea style="font-size:1.2em" name="score3" cols=15 rows=4>'.$row['score3'].'</textarea></td>');
                        print('<td><textarea style="font-size:1.2em" name="score4" cols=15 rows=4>'.$row['score4'].'</textarea></td>');
                        
                        echo "<td>";
                        print('<input type="hidden" name="b_id" value="'.$b_id.'">');
                        print('<input type="submit" button class="square_btn" name="update" value="更新"></button></td>');
                        print("</tr>");
                    }
                    echo '</table>';
                } else {
                        echo mysql_error();
                }
                ?>
            </fieldset>
            
        </form>
        <br>
        <form action="simu_search.php">
            <input type="submit" button class="square_btn" value="戻る"></button>
        </form>
        <br><br>
        </center>
        <br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br>
    </body>
</html>
</div>