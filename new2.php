<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<TITLE>データベースへの画像の格納</TITLE>
</HEAD>
<P>ファイルのアップロード</P>
<BODY>
<FORM method="POST" enctype="multipart/form-data" action="new2.php">
<INPUT type="hidden" name="MAX_FILE_SIZE" value="65536">
画像のファイル名を入力してください（最大64KByte）<BR>
ファイル名：<INPUT type="text" name="file_name"><BR>
パス：<INPUT size="30" type="file" name="upfile"><BR>
<BR>
<INPUT type="submit" name="submit" value="送信">
<INPUT type="reset" name="reset" value="リセット">
</FORM>
<?php
 if ($_POST["submit"]!="")
 {
  if ($_POST["file_name"]=="none")
  {
   print("ファイル名が入力されていません。<BR>\n");
   exit;
  }
  $file_name = $_POST["file_name"];
  if ($_FILES["upfile"]["tmp_name"]=="none")
  {
   print("ファイルのアップロードができませんでした。<BR>\n");
   exit;
  }
  $fp = fopen($_FILES["upfile"]["tmp_name"], "rb");
  if(!$fp)
  {
   print("アップロードしたファイルを開けませんでした");
   exit;
  }
  $imgdat = fread($fp, filesize($_FILES["upfile"]["tmp_name"]));
  fclose($fp);

  print("ファイルサイズ：{$_FILES["upfile"]["size"]}<BR>\n");
  $len = strlen($imgdat);
  print("データ長 = $len<BR>");

  $imgdat = addslashes($imgdat);
  $imagePath=$_FILES["upfile"]["tmp_name"];
  $path_part= pathinfo($imagePath);
  $extension = $path_part['extension'];
  //$extension = pathinfo($imagePath, PATHINFO_EXTENSION);

  $con = mysql_connect("localhost", "root", "test1234");
  if (!$con)
  {
   print("MySQLへの接続に失敗しました");
   exit;
  }
  if (!mysql_select_db("esdb"))
  {
   print("データベースへの接続に失敗しました");
   exit;
  }
  mysql_query("SET NAMES utf8")
  or die("can not SET NAMES utf8");  
  $sql = "INSERT INTO img_table (name, image,extension) values ('$file_name', '$imgdat','$extension')";
//  echo $sql;
  $result = mysql_query($sql);
  if (!$result)
  {
   print("SQLの実行に失敗しました<BR>");
   print(mysql_errno().": ".mysql_error()."<BR>");
   exit;
  }
  mysql_close($con);
 }
?>
</BODY>
</HTML>