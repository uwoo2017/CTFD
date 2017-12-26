<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">
<br><br><br>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データベース画像パス保存画面</title>
</head>
<center>
<body>
<font size="5">
<FORM method="POST" enctype="multipart/form-data" action="img_regist.php">
<INPUT type="hidden" name="MAX_FILE_SIZE" value="1000000">
画像のファイル名を入力してください（最大1000KByte）<BR>
ファイル名：<INPUT class="inputform" type="text" name="imageName"><BR>
パス：<INPUT class="inputform" size="30" type="file" name="upfile"><BR>
<BR>
<INPUT button class="square_btn" type="submit" name="submit" value="送信">
<INPUT button class="square_btn" type="reset" name="reset" value="リセット">

</FORM>
</body>

</html>
 
<?php
 
// 送信ボタンが押されたら、入力を受け取ってデータベースに画像を送信
if (isset($_POST['imageName'])) {
  $name = $_POST['imageName'];


  $imagePath = $_FILES["upfile"]["tmp_name"];
  //echo $imagePath;
  $image = file_get_contents($imagePath);
  $newpath= './img/'.$name.'.jpg';
  
  if($_FILES['upfile']){ 
        $result=move_uploaded_file($imagePath,$newpath); 
  }
  if($result){

    function getPDO() {
        // PHP Data Object を返す
        $dataSourceName = 'mysql:host=localhost;dbname=esdb;charset=utf8';
        $user = 'root';
        $dbPassword = 'test1234';
       
        return new PDO($dataSourceName, $user, $dbPassword);
      }
      
      // 送信する画像の中身と拡張子を取得
      
      
      
       
      try {
       
        $pdo = getPDO();
       
        $tableName = "img_table";
       
        $insert = $pdo->prepare('INSERT INTO ' . $tableName . ' (name, image,path) VALUES (:name, :image, :extension)');
        $insert->bindValue(':name', $name, PDO::PARAM_STR);
        $insert->bindValue(':image', $image, PDO::PARAM_LOB);
        $insert->bindValue(':extension', $newpath, PDO::PARAM_STR);
        $insert->execute();
      
        //echo '<a href="load.php?name='.$name.'">送信した画像を確認する</a>';
       
      } catch (Exception $e) {
        echo "insert failed: " . $e;
      }

    echo "登録完了: 名前は".$name."です <br>";
  }
} else {
  echo '名前を入力して送信ボタンを押してください。';
  print('<br>');
  print('<br>');
  print('<br>');
}











print('<br>');
print('<br>');
print('<br>');


?>
</font>
<form action="esdb.php">
    <input type="submit" button class="square_btn" value="戻る"></button>
</form>
</center>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br>