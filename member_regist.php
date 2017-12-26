<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">


<?php
//member_regist
require 'password.php';   // password_hash()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
// セッション開始
session_start();

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "test1234";  // ユーザー名のパスワード
$db['dbname'] = "esdb";  // データベース名

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";

// ログインボタンが押された場合
if (isset($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["username"])) {  // 値が空のとき
        $errorMessage = 'ユーザー名が未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["password2"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["id"])) {
        $errorMessage = 'idが未入力です。';
    }else if (!isset($_POST["state"])){
        $errorMessage = '管理権が未入力です。';
    }

    if (!empty($_POST["id"]) &&!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && ($_POST["password"] == $_POST["password2"]) && isset($_POST["state"]) ){
        // 入力したユーザIDとパスワードを格納
        $id = $_POST["id"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        if(isset($_POST["state"])){
            $state = $_POST["state"];
        }else{
            $state = 0;
        }
        if(isset($_POST["mailaddress"])){
            $mailaddress =$_POST["mailaddress"];
        }else{
            $mailaddress =NULL;
        }

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare("INSERT INTO member(id,name, password,mailaddress, result1, result2, result3, result4, result5, charenge, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0, ?)");

            $stmt->execute(array($id,$username, password_hash($password, PASSWORD_DEFAULT),$mailaddress,NULL,NULL,NULL,NULL,NULL,$state));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
            $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる

            $signUpMessage = '登録が完了しました。'.$username.'さんの登録IDは '. $id. ' です。パスワードは '. $password. ' です。';  // ログイン時に使用するIDとパスワード
            

            if($state==0){
                try{
                    $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                    //echo 'aaa';
                    
                    $stmt = $pdo->prepare("INSERT INTO simu_user(id, easy_result1, easy_result2, easy_result3, easy_challenge, normal_result1, normal_result2, normal_result3, normal_challenge, hard_result1, hard_result2, hard_result3, hard_challenge) VALUES (?, ?, ?, ?, 0, ?, ?, ?, 0, ?, ?, ?, 0)");
                    
                    $stmt->execute(array($id, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
                    $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる
                    
                    //$signUpMessage = '登録が完了しました。'.$username.'さんの登録IDは '. $id. ' です。パスワードは '. $password. ' です。';  // ログイン時に使用するIDとパスワード
                    
                    
                } catch(PDOException $e){
                    $errorMessage = 'データベースエラー';
                    // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
                    // echo $e->getMessage();
    
                }
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
            // echo $e->getMessage();
        }
        
    } else if($_POST["password"] != $_POST["password2"]) {
        $errorMessage = 'パスワードに誤りがあります。';
    }
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>管理者専用ユーザー登録</title>
    </head>
    <body>
        <h1>管理者専用登録画面</h1>
        <center>
        <form id="registForm" name="registForm" action="" method="POST">
            <fieldset>
                
                <legend><h2>ユーザー登録フォーム</h2></legend>
                <font size="5">
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></font></div>
                <label for="id">　　　　id </label><input type="text" class="inputform"  id="id" name="id" placeholder="idを入力" value="<?php if (!empty($_POST["id"])) {echo htmlspecialchars($_POST["id"], ENT_QUOTES);} ?>">
                <br>
                <label for="username">ユーザー名</label><input type="text" class="inputform" id="username" name="username" placeholder="ユーザー名を入力" value="<?php if (!empty($_POST["username"])) {echo htmlspecialchars($_POST["username"], ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード</label><input type="password" class="inputform" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <label for="password2">パスワード(確認用)</label><input type="password" class="inputform" id="password2" name="password2" value="" placeholder="再度パスワードを入力">
                <br>
                <label for="mailaddress">メールアドレス</label><input type="text" class="inputform" id="mailaddress" name="mailaddress" value="<?php if (!empty($_POST["mailaddress"])) {echo htmlspecialchars($_POST["mailaddress"], ENT_QUOTES);} ?>" placeholder="メールアドレスを入力">
                <br>
                <label for="state">管理権<br>  </label><input type="radio" class="inputform" id="state" name="state" value="0" >学習者
                <label for="state"></label><input type="radio" class="inputform" id="state" name="state" value="1" >管理者
                <br><br>
                       
                <input type="submit" button class="square_btn" id="signUp" name="signUp" value="ユーザー登録"></button>
            </fieldset>
        </form>
        <br>
        <form action="esdb.php">
            <input type="submit" button class="square_btn" value="戻る"></button>
        </form>
        </center>
        <br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br>
    </body>
</html>
</div>