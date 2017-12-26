<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">
<?php
//answer.php
if(isset($_POST['type'])){
    $type= $_POST['type']; //クライアントタイプの取得
    //echo $type;
}
$qf = $_POST['qf'];//前の問題ID
if(isset($_POST['room'])){
    $room =$_POST['room'];
}else if(isset($_POST['question'])){
    $room=$_POST['question'];//部屋画像
}
//表にする
print('<table class=tbl_13>');
print('<tr><td>');
//
if(isset($room)){
    $imagesize = getimagesize('./img/'.$room.'.jpg');
    $width= $imagesize[0]*0.7;
    $height= $imagesize[1]*0.7;
    print("<p class=room>");
    print("<img  src=./img/".$room.".jpg alt=room width=".$width." height=".$height.">");
    print("</p>");
//
    print("</td>");
}
if(!isset($_POST['NoCheck'])){
    $NQ = $qf+1;//前の問題ID の次の番号に設定
    //echo 'aaa';
}else{
    $NQ = $qf;
    //echo 'bbb';
}
if(isset($_POST['userid'])){
	$userid = $_POST['userid'];
	//echo $userid;
}

$link = mysql_connect('localhost', 'root', 'test1234');

$db_selected = mysql_select_db('esdb', $link);

mysql_set_charset('utf8');

$query = "SELECT * FROM simulation WHERE id = '$qf'";/////
$result = mysql_query($query);

$row = mysql_fetch_assoc($result);


if(isset($_POST['question'])){
    $question = $_POST['question']; //ラジオボタンの内容を受け取る
    //echo $question;
    switch($question){
        case $row["text1"]:
            $ns=$row["score1"]; //ns = NowScore
            //echo $ns;
            break;
        case $row["text2"]:
            $ns=$row["score2"];
            break;
        case $row["text3"]:
            $ns=$row["score3"];
            break;
        case $row["text4"]:
            $ns=$row["score4"];        
    }
    $score =$_POST['score'];//
    //print($score);
    if(isset($ns)){
       $score += $ns;
    }
    //print($score);
    print('<td>');
    //
    if($score<=0){
        print('</table>');
        $qf=4;//データベースに記憶するため
        print('<center>');
        $imagesize = getimagesize('./img/end.jpg');
        $width= $imagesize[0]*0.7;
        $height= $imagesize[1]*0.7;
        print("<img  src=./img/end.jpg alt=room width=".$width." height=".$height.">");
        print('<font size=10>');
        echo "帰ります!!";
        print('</font>');
        print('<form method="GET" action="start.php">');
        print('<input type = "hidden" name ="id" value="'.$userid.'">');
        print('<button class="square_btn type="button">始めに戻る</button>');
        print('</center>');
    }else{
        print("<p class=cliant>");
    switch(true){
        case $score<=20:
            $imagesize = getimagesize('./img/0_20.jpg');
            $width= $imagesize[0]*0.5;
            $height= $imagesize[1]*0.5;
            print("<img  src=./img/0_20.jpg alt=room width=".$width." height=".$height.">");
            break;
        case $score<=40 && $score>=21:
            $imagesize = getimagesize('./img/21_40.jpg');
            $width= $imagesize[0]*0.5;
            $height= $imagesize[1]*0.5;
            print("<img  src=./img/21_40.jpg alt=room width=".$width." height=".$height.">");
            break;
        case $score<=60 && $score>=41:
            $imagesize = getimagesize('./img/41_60.jpg');
            $width= $imagesize[0]*0.5;
            $height= $imagesize[1]*0.5;
            print("<img  src=./img/41_60.jpg alt=room width=".$width." height=".$height.">");
            break;
        case $score<=80 && $score>=61:
            $imagesize = getimagesize('./img/61_80.jpg');
            $width= $imagesize[0]*0.5;
            $height= $imagesize[1]*0.5;
            print("<img  src=./img/61_80.jpg alt=room width=".$width." height=".$height.">");
            break;
        case $score>=81:
            $imagesize = getimagesize('./img/81_100.jpg');
            $width= $imagesize[0]*0.5;
            $height= $imagesize[1]*0.5;
            print("<img  src=./img/81_100.jpg alt=room width=".$width." height=".$height.">");
            break;
        }
    print('</p>');
    //
    print('</td></tr>');
    print('</table>');
    }
    if($qf%4==0){
            //PDOでの定義
    $db['host'] = "localhost";  // DBサーバのURL
    $db['user'] = "root";  // ユーザー名
    $db['pass'] = "test1234";  // ユーザー名のパスワード
    $db['dbname'] = "esdb";  // データベース名
        switch($type){
            case 'A':
                //$ar=0;
                $challenge='easy_challenge';
                $result1='easy_result1';
                $result2='easy_result2';
                $result3='easy_result3';
                break;
            case 'B':
                $challenge='normal_challenge';
                $result1='normal_result1';
                $result2='normal_result2';
                $result3='normal_result3';
                break;
            case 'C':
                $challenge='hard_challenge';
                $result1='hard_result1';
                $result2='hard_result2';
                $result3='hard_result3';
                break;        
        }
        
        //Create Query
        $query = "SELECT * from simu_user where id='$userid'";

        $result = mysql_query($query) or die($query . '<br />' . mysql_error() . '<hr />');
        //$num_rows = mysql_num_rows($result);

        $row = mysql_fetch_array($result);

        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
                
         // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                            
            if(isset($row[$challenge])){
                                
                $charenge = $row[$challenge]+1;
                //$charenge+=1;
                                
            }else{
                $charenge=1;
            }

            if($row[$challenge]%3==0 || !isset($row[$challenge])){
                                
                                

                $stmt = $pdo->prepare("UPDATE simu_user SET $result1 =?,$challenge=?WHERE id =?");
                                
                $stmt->execute(array($score,$charenge,$userid)); 
            }else if($row[$challenge]%3==1){

                $stmt = $pdo->prepare("UPDATE simu_user SET $result2 =?,$challenge=?WHERE id =?");
                                
                $stmt->execute(array($score,$charenge,$userid));

            }else if($row[$challenge]%3==2){
                                
                $stmt = $pdo->prepare("UPDATE simu_user SET $result3 =?,$challenge=?WHERE id =?");
                                
                $stmt->execute(array($score,$charenge,$userid));
            }    //$updateMessage = '修正が完了しました';  // 登録できたらidを表示
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
            echo $e->getMessage();
        }
        print('<center>');
        if($score>=1){
            print('<form method="GET" action="start.php">');
            print('<input type = "hidden" name ="id" value="'.$userid.'">');

            print('<div class="balloon3">');
            print('<font size ="5">');
            echo '今回の対応度<br>';
            echo $score;
            print('</font>');
            print('</div>');
            print('<br>');
            print('<br>');

            print('<div class="balloon2">');
            print('<font size ="3">');
            
            switch(true){
                case $type=='A':
                    switch(true){
                        case $score<=20:
                            print('A、-<20');
                            break;
                        case $score<=40 && $score>=21:
                            print('A、21<40');
                            break;
                        case $score<=60 && $score>=41:
                            print('A、41<60');
                            break;
                        case $score<=80 && $score>=61:
                            print('A、61<80');
                            break;
                        case $score>=81:
                            print('A、81<');
                            break;
                    }
                    break;
                case $type=='B':
                    switch(true){
                        case $score<=20:
                            print('B、-<20');
                            break;
                        case $score<=40 && $score>=21:
                            print('B、21<40');
                            break;
                        case $score<=60 && $score>=41:
                            print('B、41<60');
                            break;
                        case $score<=80 && $score>=61:
                            print('B、61<80');
                            break;
                        case $score>=81:
                            print('B、81<');
                            break;
                    }
                    break;
                case $type=='C':
                    switch(true){
                        case $score<=20:
                            print('C、-<20');
                            break;
                        case $score<=40 && $score>=21:
                            print('C、21<40');
                            break;
                        case $score<=60 && $score>=41:
                            print('C、41<60');
                            break;
                        case $score<=80 && $score>=61:
                            print('C、61<80');
                            break;
                        case $score>=81:
                            print('C、81<');
                            break;
                    }
                    break;
            }






            print('</font>');
            print('</div>');


            print('<br>');

            //print('<input type="hidden"name="array" value="'.$ar.'">');
        //	print('<input type="hidden"name="yes_c" value="'.$yes_c.'">');
            print('<button class="square_btn type="button">始めに戻る</button>');
            //echo 'end';
            /*
            if($score>=100){
                echo 'perfect!';
                exit;
            }else if($score<=0){
                //echo '帰ります';
                exit;
            } 
            */
        }
        exit;
    }/////////////////////////
/*
    if($score>=100){
        echo 'perfect!';
        exit;
    }else if($score<=0){
        echo '帰ります';
        exit; 
    }
*/
    print('<center>');


    
    




	
    //$query = "SELECT * FROM simulation WHERE id = '$NQ'";
    $query = "SELECT * FROM simulation WHERE id = '$NQ'";/////
    $Result = mysql_query($query);
    
    $Row = mysql_fetch_assoc($Result);

    $title = $Row['question'];
    $question = array();

    $question = array($Row['text1'],$Row['text2'],$Row['text3'],$Row['text4']);
    $qf = $Row['id'];
    shuffle($question);


}else{
    print('<center>');
	$score =$_POST['score'];//得点
	//$ar = $_POST['array'];//前の問題配列
    //$qf = $_POST['qf'];//前の問題ID
    
    

	echo('<br><br>');
	echo('チェックされていません');
    echo('<br><br>');
    if($qf==1){
	    print('<form method="POST" action="simulation.php">');
	}else if($qf!=1){
        //$question= $_POST['question'];
        print('<form method="POST" action="simulation2.php">');
        print('<input type="hidden" name="NoCheck" value="Nocheck">');
        print('<input type="hidden"name="room" value="'.$room.'">');
        print('<input type="hidden"name="score" value="'.$score.'">');
        print('<input type="hidden"name="question" value="'.$room.'">');

    }
    //print('<input type="hidden"name="array" value="'.$ar.'">');

	print('<input type="hidden" name="userid" value="'.$userid.'">');
	print('<input type="hidden"name="score_c" value="'.$score.'">');
    print('<input type="hidden"name="qf" value="'.$qf.'">');
    print('<input type="hidden"name="type" value="'.$type.'">');
    print('<button class="square_btn type="submit">戻る</button>');
    print('</center>');
    exit;
}
?>
<!doctype html>

<html>
<head>
<meta charset="utf-8">

<title>シミュレーションシステム</title>
</head>
<body>
<center>
<?php
if(isset($_POST['question'])){
    if($NQ==2||$NQ==4){
        print("<div class='balloon1'>");
    }else{
        print("<div class='balloon11'>");
    }
    print("<p>");
    print('<font size=5>');
    echo $title;
    print('</font>');
}

print("</div>");
?>
<div class="sample">

<?php
if(isset($_POST['question'])){
    print('<form method="POST" action="simulation2.php">');////////////
    $aaa=1;
    print('<table class=tbl_15>');
    print('<div class="p">');

    print('<tr><td>');
    
    
    print('</td>');
    print('<td>');
    //print("<table border=1 >");
    foreach($question as $value){
        /*
        if($aaa%2==1){
            $align="left";
        }else{
            $align="right";
        }
        */
        print('<input id="'.$aaa.'" type="radio" name="question"" value="'.$value.'" />');
        print('<label for="'.$aaa.'">');
        print($value);
        //$width= $imagesize[0]*0.5;
        //$height= $imagesize[1]*0.5;
        //print("<img  src=./img/".$value.".jpg alt=".$aaa." width=".$width." height=".$height.">");
        


        
        print('<br>');
        
        print('</label>');
        $aaa += 1;
        print('<br>');
        /*
        if($aaa==3){
            print('<br>');
            print('<br>');
        }
        */
        //print('<br>');
        }
    print('</td>');
    print('</div>');
    print('</table>');
    print('<br>');
    print('<br>');
    //print('<input type="hidden" name="answer" value="'.$answer.'">');
    //print('<input type="hidden" name="array" value="'.$ar.'">');
    print('<input type="hidden" name="qf" value="'.$qf.'">');
    print('<input type="hidden" name="userid" value="'.$userid.'">');
    print('<input type="hidden" name="score" value="'.$score.'">');
    print('<input type="hidden" name="room" value="'.$room.'">');
    print('<input type="hidden" name="type" value="'.$type.'">');


    print('<button class="square_btn type="submit">');
    print('回答する');
    print('</button>');
}
?>
</form>
<br><br><br><br>
</body>

</div>

</html>