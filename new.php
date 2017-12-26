<?php
//new.php

/*

header('Content-Type: image/png');
readfile('C:/xampp/htdocs/usagi.png');
//ディレクトリ名
$dir_path = 'C:/xampp/htdocs/usagi.png';
if (is_dir($dir_path)){
    if(is_readable($dir_path)){ // ? ファイルが読み込み可能かどうか
        $ch_dir = dir($dir_path); //ディレクトリクラス
        //ディレクトリ内の画像を一覧表示
        while (false !== ($file_name = $ch_dir -> read())){
            $ln_path = $ch_dir -> path . "/" .$file_name;
            if (@getimagesize($ln_path)){ //画像かどうか？
                echo "<a href = \"imgview.php?d=" .urlencode(mb_convert_encoding($ln_path, "UTF-8")). "\" target = \"_blank\" >";
                echo "<img src = \"" .$ln_path. "\" width=\"100\"></a> ";
            }
        }
        $ch_dir -> close();
    }else{
        echo "<p>" .htmlspecialchars($dir_path)."　は読み込みが許可されていません。";
    }
}
else
{
echo 'DIR 画像がないよ';
}
*/



?>
<img src="usagi.png" alt="写真" width="193" height="130">
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

//mysql_set_charset($db,'utf-8');

//

if(!empty($_FILES)){
    //
    $fileName = $_FILES['image']['name'];
    if($fileName != ""){
        $image = $fileName;
        echo $image;
        //
        move_uploaded_file($_FILES['image']['tmp_name'],'image/'.$image);
        //
        $sql = sprintf('INSERT INTO img_table SET image="%s"',$image);
        $sql = mysql_query($myid,$sql) or die (mysql_error($myid));
    }
}


?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>fileサンプル</title>
</head>
<body>
  <!-- 画像をアップロードやつ　-->
  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit">
  </form>
</body>
</html>

