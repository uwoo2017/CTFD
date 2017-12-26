<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>MySQLへの接続テスト</title>
</head>
<body>

<?php

$fp = fopen("test1.csv", "w");
//fwrite($fp, "test");

$dsn = 'mysql:dbname=mudb;host=localhost';
$user = 'root';
$password = 'lilys';

try{
    $dbh = new PDO($dsn, $user, $password);

    $sql = 'select * from stid';
    foreach ($dbh->query($sql) as $row) {
        print($row['stid'].',');
        print($row['stpass']);
        print('<br />');
        fwrite($fp, $row['stid'].',');
        fwrite($fp, $row['stpass']);
        fwrite($fp, "\r\n");
    }
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}

$dbh = null;

fclose($fp);

?>

</body>
</html>