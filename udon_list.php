<table border="1">
 <tr><th>名前</th><th>価格</th><th>操作</th></tr>
 <?php
   $pdo = new PDO("mysql:dbname=men", "root",'test1234');
   $st = $pdo->query("SELECT * FROM udon");
   while ($row = $st->fetch()) {
     $name = htmlspecialchars($row['name']);
     $price = htmlspecialchars($row['price']);
     echo "<tr><td>$name</td><td>$price 円</td><td><a href='udon_update.php?name=$name'>修正</a></td></tr>";
   }
 ?>
 </table>