<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">

<?php
// セッション開始
session_start();


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

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "test1234";  // ユーザー名のパスワード
$db['dbname'] = "esdb";  // データベース名

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$registMessage = "";

// ログインボタンが押された場合
if (isset($_POST["quiz_regist"])) {
    // 1. IDなどの入力チェック
    if (empty($_POST["question"])) {  // 値が空のとき
        $errorMessage = 'ユーザー名が未入力です。';
    } else if (empty($_POST["text1"])) {
        $errorMessage = '質問1が未入力です。';
    } else if (empty($_POST["text2"])) {
        $errorMessage = '質問2が未入力です。';
    } else if (empty($_POST["text3"])) {
        $errorMessage = '質問3が未入力です。';
    } else if (empty($_POST["text4"])) {
        $errorMessage = '質問4が未入力です。';
    /*} else if (empty($_POST["id"])) {
        $errorMessage = 'idが未入力です。';
    */
    }else if (!isset($_POST['answer'])){
        $errorMessage = '答えの値が未入力です。';
    }

    if (/*!empty($_POST["id"]) &&*/!empty($_POST["question"]) && !empty($_POST["text1"]) && !empty($_POST["text2"])
    && !empty($_POST["text3"])&& !empty($_POST["text4"]) && isset($_POST["answer"]) ){
        // 入力したユーザIDとパスワードを格納
        //$id = $_POST["id"];
        $question = $_POST["question"];
        $text1 = $_POST["text1"];
        $text2 = $_POST["text2"];
        $text3 = $_POST["text3"];
        $text4 = $_POST["text4"];
        if (isset($_POST["text5"])){
            $text5 = $_POST["text5"];
        }
        $answer = $_POST["answer"];
        if(isset($_POST['answer2'])){
            //UPDATE `quiz` SET `answer2` = NULL WHERE `quiz`.`id` = 1; 
            $answer2 = $_POST["answer2"];
            if($answer2=='×'){
                $answer2=NULL;
            }
        }else{
            $answer2=NULL;
        }


        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO quiz(question,text1,text2,text3,text4,text5,answer,answer2) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute(array($question, $text1, $text2, $text3, $text4, $text5,$answer,$answer2));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる
            $query = "SELECT id FROM `quiz` order by id DESC";
            $result=mysql_query($query);
            $row = mysql_fetch_array($result);
            $id= $row['id'];
            $registMessage = '登録が完了しました。idは'.$id.'です';  // 登録できたらidを表示
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
            // echo $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>新規登録</title>
    </head>
    <body>
        <h1>管理者専用登録画面</h1>
        
        <form id="registForm" name="registForm" action="" method="POST">
        <center>
            <fieldset>
            
            
                <legend><h2>問題登録フォーム</h2></legend>
                <font size="5">
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo htmlspecialchars($registMessage, ENT_QUOTES); ?></font></div>
                <?php /*
                <label for="id">　　id </label><input type="text" class="inputform" id="id" name="id" placeholder="idを入力" value="">
                <br>
                */
                ?>
                <label for="question"> 問題 </label><input type="text" class="inputform" id="question" name="question" placeholder="問題を入力" value="<?php if(isset($question)){echo $question;}  ?>">
                <br>
                <label for="text1">質問1</label><input type="text" class="inputform" id="text1" name="text1" value="<?php if(isset($text1)){echo $text1;}  ?>" placeholder="回答1">
                <br>
                <label for="text2">質問2</label><input type="text" class="inputform" id="text2" name="text2" value="<?php if(isset($text2)){echo $text2;}  ?>" placeholder="回答2">
                <br>
                <label for="text3">質問3</label><input type="text" class="inputform" id="text3" name="text3" value="<?php if(isset($text3)){echo $text3;}  ?>" placeholder="回答3">
                <br>
                <label for="text4">質問4</label><input type="text" class="inputform" id="text4" name="text4" value="<?php if(isset($text4)){echo $text4;}  ?>" placeholder="回答4">
                <br>
                <label for="text5">質問5</label><input type="text" class="inputform" id="text5" name="text5" value="<?php if(isset($text5)){echo $text5;}  ?>" placeholder="回答5">
                <br>
                <label for="answer">答え </label><input type="radio" id="answer" name="answer" value="1" >1　 
                <label for="answer"> </label><input type="radio" id="answer" name="answer" value="2" >2　 
                <label for="answer"> </label><input type="radio" id="answer" name="answer" value="3" >3　 
                <label for="answer"> </label><input type="radio" id="answer" name="answer" value="4" >4　 
                <label for="answer"> </label><input type="radio" id="answer" name="answer" value="5" >5
                <br>
                <label for="answer">答え2 </label><input type="radio" id="answer2" name="answer2" value="1" >1　 
                <label for="answer"> </label><input type="radio" id="answer2" name="answer2" value="2" >2　 
                <label for="answer"> </label><input type="radio" id="answer2" name="answer2" value="3" >3　 
                <label for="answer"> </label><input type="radio" id="answer2" name="answer2" value="4" >4　 
                <label for="answer"> </label><input type="radio" id="answer2" name="answer2" value="5" >5
                <label for="answer"> </label><input type="radio" id="answer2" name="answer2" value="×" >×
                <br>
                <input type="submit" button class="square_btn" id="quiz_regist" name="quiz_regist" value="問題登録"></button>
                </font>
            </fieldset>
        </form>
        <br>
        <form action="esdb.php">
            <input type="submit" button class="square_btn" value="戻る"></button>
        </form>
        <br><br>
        </center>
        <br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br>
    </body>
</html>
</div>