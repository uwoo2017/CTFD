<?php
 
if (isset($_GET['name'])) {
  $name = $_GET['name'];
}
 
function getPDO() {
  // PHP Data Object を返す
  $dataSourceName = 'mysql:host=localhost;dbname=esdb;charset=utf8';
  $user = 'root';
  $dbPassword = 'test1234';
 
  return new PDO($dataSourceName, $user, $dbPassword);
}
 
// 拡張子によってMIMEタイプを切り替えるための配列
$MIMETypes = array(
   'png'  => 'image/png',
   'jpg'  => 'image/jpeg',
   'jpeg' => 'image/jpeg',
   'gif'  => 'image/gif',
   'bmp'  => 'image/bmp',
);
 
try {
 
  $pdo = getPDO();
 
  $tableName = "img_table";
 
  // データベースから条件に一致する行を取り出す
  $data = $pdo->query('SELECT * FROM ' . $tableName . ' WHERE name = "' . $name . '"')->fetch(PDO::FETCH_ASSOC);
 
  // 画像として扱うための設定
  header('Content-type: ' . $MIMETypes[$data['extension']]);
 
  echo $data['image'];
 
} catch (Exception $e) {
  echo "load failed: " . $e;
}
?>
