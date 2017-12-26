<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">

<?php
// セッション開始
session_start();

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
        $id = $_POST["id"];
        $question = $_POST["question"];
        $text1 = $_POST["text1"];
        $text2 = $_POST["text2"];
        $text3 = $_POST["text3"];
        $text4 = $_POST["text4"];
        $score1= $_POST["score1"];
        $score2= $_POST["score2"];
        $score3= $_POST["score3"];
        $score4= $_POST["score4"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO simulation(id,question,text1,text2,text3,text4,score1,score2,score3,score4) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)");

            $stmt->execute(array($id,$question, $text1, $text2, $text3, $text4, $score1, $score2, $score3, $score4));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

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
        <h1>管理者専用問題登録画面</h1>
        
        <form id="registForm" name="registForm" action="" method="POST">
        <center>
            <fieldset>
            
            
                <legend><h2>シミュレーション問題登録フォーム</h2></legend>
                <font size="5">
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo htmlspecialchars($registMessage, ENT_QUOTES); ?></font></div>
                <label for="id">　　id </label><input type="text" class="inputform" id="id" name="id" placeholder="idを入力" value="">
                <br>
                <label for="question"> 問題 </label><input type="text" class="inputform" id="question" name="question" placeholder="問題を入力" value="">
                <br>
                <label for="text1">回答1</label><input type="text" class="inputform" id="text1" name="text1" value="" placeholder="回答1">
                <br>
                <label for="text2">回答2</label><input type="text" class="inputform" id="text2" name="text2" value="" placeholder="回答2">
                <br>
                <label for="text3">回答3</label><input type="text" class="inputform" id="text3" name="text3" value="" placeholder="回答3">
                <br>
                <label for="text4">回答4</label><input type="text" class="inputform" id="text4" name="text4" value="" placeholder="回答4">
                <br>
                <label for="score1">得点1</label><input type="text" class="inputform" id="score1" name="score1" value="" placeholder="得点1">
                <br>
                <label for="score2">得点2</label><input type="text" class="inputform" id="score2" name="score2" value="" placeholder="得点2">
                <br>
                <label for="score3">得点3</label><input type="text" class="inputform" id="score3" name="score3" value="" placeholder="得点3">
                <br>
                <label for="score4">得点4</label><input type="text" class="inputform" id="score4" name="score4" value="" placeholder="得点4">
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