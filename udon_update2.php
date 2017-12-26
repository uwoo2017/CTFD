<?php
   $pdo = new PDO("mysql:dbname=men", "root",'test1234');
   $st = $pdo->prepare("UPDATE udon SET name=?,price=? WHERE name=?");
   $st->execute(array($_POST['name'], $_POST['price'], $_POST['old_name']));
 ?>
レコードを修正しました。