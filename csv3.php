<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
 <html lang="ja">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
 <title>CSVファイルを読み込む１</title>
 </head>
 <body>
 <?php
 $fp = fopen("sample.csv", "r");
 while ($data = fgetcsv($fp, 10000)) {
   foreach ($data as $d) {
     print $d . "<br>\n";
   }
 }
 ?>
 </body>
 </html>