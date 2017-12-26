<?php
// 画像と拡張子を取得
$img_path = '';
$img = file_get_contents($img_path);
$ext = pathinfo($img_path, PATHINFO_EXTENSION);
 
// データベースに保存
$pdo = new PDO('mysql:host=HOST; dbname=DBNAME', 'USER', 'PASSWORD');
$stmt = $pdo->prepare('INSERT INTO images VALUES(0, :ext, :img)');
 $stmt->bindParam(':ext', $ext);
 $stmt->bindParam(':img', $img);
 $stmt->execute();
 ?>
