<?php

if(isset($_POST["type"])){
    $type=$_POST["type"];
}else{
    $randtype=array('A','B','C');//A=positive B=Regular C=Negative
    $rand=rand(0,2);
    $type=$randtype[$rand];
}


if(isset($_POST['userid'])){
	$userid = $_POST['userid'];
	//echo $userid;
}

if(isset($_POST['score_c'])){
	$score = $_POST['score_c'];
	if(isset($_POST['qf'])){
		$qfa=$_POST['qf'];
	}
	

}else{
    switch($type){
        case 'A':
	        //$ar=0;
            $score=65;
            break;
        case 'B':
            $score=40;
            break;
        case 'C':
            $score=25;
            break;        
    }
}
function quote_smart($value)
{
    // 数値以外をクオートする
    if (!is_numeric($value)) {
        $value = "'" . mysql_real_escape_string($value) . "'";
    }
    return $value;
}


$link = mysql_connect('localhost', 'root', 'test1234');

$db_selected = mysql_select_db('esdb', $link);


// MySQLに対する処理


mysql_set_charset('utf8');
if(!isset($qfa)){
if(isset($_POST['array'])){
    //$query = "SELECT * FROM simulation WHERE id NOT IN (".$ar.") order by rand();";
    $query = "SELECT * FROM simulation WHERE id = 1";/////
	$result = mysql_query($query);
}else{
	$result = mysql_query('SELECT * FROM simulation WHERE id = 1');/////
}
}else{
	$query = "SELECT * FROM simulation WHERE id  IN (".$qfa.") ;";
	$result = mysql_query($query);
}

$row = mysql_fetch_assoc($result);
$title = $row['question'];
// ex,'目標を達成できなかったクライアントの訴えに対するカウンセラーの共感的対応に関する記述である。正しいのはどれ?';
 
$question = array(); //この変数は配列ですよという宣言
//if($row['text5']==null){
	//echo 'qaaaa','<br \>';
	$question = array($row['text1'],$row['text2'],$row['text3'],$row['text4']);
//}else{
//	$question = array($row['text1'],$row['text2'],$row['text3'],$row['text4'],$row['text5']); //4択の選択肢を設定
//}
$qf = $row['id'];
//echo $qf;
//$answer = $question[$row['answer']-1]; //正解の問題を設定
shuffle($question); //配列の中身をシャッフル






?>
<!doctype html>
<div class="bg1">
<html>

<head>

<meta charset="utf-8">
<title>カウンセリングシミュレーションシステム</title>
</head>
<body>
<link rel="stylesheet" href="design.css" type="text/css">

<center>
<h2>
<div class="balloon1">
<p>
<?php 
print('<font size=5>');
echo $title;

print('</font>');
?>
</p>
</div>
</h2>



<div class="sample">

<?php
print('<form method="POST" action="simulation2.php">');////////////
$aaa=1;

print('<div class="p">');
//print("<table border=1 >");
foreach($question as $value){
    /*
    if($aaa%2==1){
        $align="left";
    }else{
        $align="right";
    }
	*/
	print('<input id="'.$aaa.'" type="radio" name="question" value="'.$value.'" />');
    print('<label for="'.$aaa.'">');
    $imagesize = getimagesize('./img/'.$value.'.jpg');
    $width= $imagesize[0]*0.7;
    $height= $imagesize[1]*0.7;
    print("<img  src=./img/".$value.".jpg alt=".$aaa." width=".$width." height=".$height.">");
    


    
    print('<br>');
    
	print('</label>');
    $aaa += 1;
    
    if($aaa==3){
        print('<br>');
        print('<br>');
    }
    //print('<br>');
	}
print('</div>');
print('<br>');
print('<br>');
//print('<input type="hidden" name="answer" value="'.$answer.'">');
//print('<input type="hidden" name="array" value="'.$ar.'">');
print('<input type="hidden" name="qf" value="'.$qf.'">');
print('<input type="hidden" name="userid" value="'.$userid.'">');
print('<input type="hidden" name="score" value="'.$score.'">');
print('<input type="hidden" name="type" value="'.$type.'">');


print('<button class="square_btn type="submit">');
print('回答する');
print('</button>');
?>
</form>
</center>
<br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br>
</body>

</div>
</html>
