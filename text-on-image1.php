<?php

$img = ImageCreateFromPNG('photo14.png');

# 必要に応じてUTF8へ変換(環境依存)
$text = mb_convert_encoding('中部大学民族資料博物館', 'UTF-8', 'auto');

# 白い文字を書き込む
$white = ImageColorAllocate($img, 0xff, 0xff, 0xff);
ImageTTFText($img, 16, 0, 5, 200, $white,
    'C:/Windows/Fonts/メイリオ.ttf', $text);

header('Content-Type: image/png');
ImagePNG($img);

?>