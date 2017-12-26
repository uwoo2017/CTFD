<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">

<SCRIPT language="JavaScript">
 function check_flag(){
     if( parent.hide_frame.submit_flag == 1){
         alert("二度押し禁止");
         return false;
     }else{
         parent.hide_frame.submit_flag = 1;
         document.forms[0].submit();
     }
 }
 </SCRIPT>

<?php
require 'password.php';   // password_verfy()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
// セッション開始
session_start();

$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "test1234";  // ユーザー名のパスワード
$db['dbname'] = "esdb";  // データベース名

// エラーメッセージの初期化
$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $userid = $_POST["userid"];

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare('SELECT * FROM member WHERE id = ?');
            $stmt->execute(array($userid));

            $password = $_POST["password"];
            //$pass = password_hash($password,PASSWORD_DEFAULT);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row["password"])) {//&& $pass===$row["password"] && $password ===$row["password"]
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['id'];
                    $sql = "SELECT * FROM member WHERE id = '$id'";  // 注意$idに’’がないとエラー  入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $name=$row['name'];  // ユーザー名

                    }
                    $_SESSION["NAME"] = $row['name'];
                    if($row['state']==0){
                        header("Location: start.php?id=".$_POST['userid']);  // メイン画面へ遷移
                        exit();  // 処理終了
                    }else{
                        // 管理者だったら
                        $errorMessage = 'このユーザーは管理者です。';
                    }
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。1';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。2';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            $errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
             echo $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ログイン</title>
    </head>
    <body>
        <h1>ログイン画面</h1>
        <center>
        <form id="loginForm" name="loginForm" action="" method="POST">
            <fieldset>
                <legend><h2>ログインフォーム</h2></legend>
                <font size="5">
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <label for="userid"> 　学習者ID</label><input type="text" class="inputform3" id="userid" name="userid" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード</label><input type="password" class="inputform3" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                </font>
                <input type="submit" button class="square_btn" id="login" name="login" value="ログイン"></button>
                
            </fieldset>
        </form>
        <br>
        <form action="SignUp2.php">
            <fieldset>          
                <legend><h2>新規登録フォーム</h2></legend>
                <input type="submit" button class="square_btn" value="新規登録"></button>
            </fieldset>
        </form>
    </body>
</html>
<form action="login.php">
            <input type="submit" button class="square_btn" value="戻る"></button>
</form>
<br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br>
</center>

</div>
