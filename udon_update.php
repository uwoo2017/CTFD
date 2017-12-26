<?php
   $name = htmlspecialchars($_GET['name']);
   $pdo = new PDO("mysql:dbname=men", "root",'test1234');
   $st = $pdo->prepare("SELECT * FROM udon WHERE name=?");
   $st->execute(array($name));
   $row = $st->fetch();
   $price = htmlspecialchars($row['price']);
 ?>
 <form action="udon_update2.php" method="post">
   名前<br>
   <input type="text" name="name" value="<?php echo $name ?>"><br>
   価格<br>
   <input type="text" name="price" value="<?php echo $price ?>"><br>
   <input type="hidden" name="old_name" value="<?php echo $name ?>">
   <input type="submit">
 </form>