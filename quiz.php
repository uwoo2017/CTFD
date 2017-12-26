<?php

if(isset($_POST['master'])){
	$master=$_POST['master'];
	echo $master;
}
if(isset($_POST['userid'])){
	$userid = $_POST['userid'];
	//echo $userid;
}

if(isset($_POST['array'])){
	$ar = $_POST['array'];//前の問題配列
	$yes = $_POST['yes_c'];//正解数
	if(isset($_POST['qf'])){
		$qfa=$_POST['qf'];
	}
	$qn = $_POST['qn'];
	

}else{
	$ar=0;
	$yes=0;
	$qn=1;
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
//echo $_POST['master'];
if(isset($_POST['master'])){
	$query = "SELECT * FROM quiz WHERE id IN (".$_POST['master'].") ;";
	$result = mysql_query($query);
}else{
	
	if(!isset($qfa)){
		if(isset($_POST['array'])){
			$query = "SELECT * FROM quiz WHERE id NOT IN (".$ar.") order by rand();";
			$result = mysql_query($query);
		}else{
			$result = mysql_query('SELECT * FROM quiz order by rand();');
		}
	}else{
		$query = "SELECT * FROM quiz WHERE id  IN (".$qfa.") ;";
		$result = mysql_query($query);
	}
}
$row = mysql_fetch_assoc($result);
$title = $row['question'];
// '目標を達成できなかったクライアントの訴えに対するカウンセラーの共感的対応に関する記述である。正しいのはどれ?';
 
$question = array(); //この変数は配列ですよという宣言
if($row['text5']==null){
	//echo 'qaaaa','<br \>';
	$question = array($row['text1'],$row['text2'],$row['text3'],$row['text4']);
}else{
	$question = array($row['text1'],$row['text2'],$row['text3'],$row['text4'],$row['text5']); //4択の選択肢を設定
}
$qf = $row['id'];
//echo $qf;
$answer = $question[$row['answer']-1]; //正解の問題を設定
if($row['answer2']!=null){
	//print($answer);
	$answer2 = $question[$row['answer2']-1];//2択の時、答え2個目を設定
	//print($answer2);
}
shuffle($question); //配列の中身をシャッフル






?>
<!doctype html>
<div class="bg1">
<html>

<head>

<meta charset="utf-8">
<title>栄養自習システム</title>
</head>
<body>
<link rel="stylesheet" href="design.css" type="text/css">

<center>
<h2>

<?php 
print('<div class=balloon2">');
print("問$qn");
print('</div>');
print('<div class="balloon1">');
print('<p>');
echo $title 
?>
</p>
</div>
</h2>

<script type="text/javascript">

window.onload = function() {
	document.getElementById('11').onclick=torikeshi1;
	document.getElementById('12').onclick=torikeshi2;
	document.getElementById('13').onclick=torikeshi3;
	document.getElementById('14').onclick=torikeshi4;
	document.getElementById('15').onclick=torikeshi5;
}

function torikeshi1() {
	var div = document.getElementById("6");
	if(div.style.textDecoration=="line-through"){
		div.style.textDecoration="none";
	}else{
		div.style.textDecoration="line-through";
	}
}
function torikeshi2() {
	var div = document.getElementById("7");
	if(div.style.textDecoration=="line-through"){
		div.style.textDecoration="none";
	}else{
		div.style.textDecoration="line-through";
	}
}
function torikeshi3() {
	var div = document.getElementById("8");
	if(div.style.textDecoration=="line-through"){
		div.style.textDecoration="none";
	}else{
		div.style.textDecoration="line-through";
	}
}
function torikeshi4() {
	var div = document.getElementById("9");
	if(div.style.textDecoration=="line-through"){
		div.style.textDecoration="none";
	}else{
		div.style.textDecoration="line-through";
	}
}
function torikeshi5() {
	var div = document.getElementById("10");
	if(div.style.textDecoration=="line-through"){
		div.style.textDecoration="none";
	}else{
		div.style.textDecoration="line-through";
	}
}
</script>



<?php

	print('<form method="POST" action="answer.php">');
	$aaa=1;
	$bbb=6;
	$ccc=11;
	print('<table class=tbl_15>');
	print('<div class="p">');
	print('<tr><td>');


	print('</td>');
	print('<td>');
	foreach($question as $value){ 
		if(isset($answer2)){
			print('<span id="'.$ccc.'">');
			print('消');
			print('</span>');
			print('<input id="'.$aaa.'" type="checkbox" name="question[]" value="'.$value.'" />');
			print('<label for="'.$aaa.'" class="checkbox" >');
			print('<div id ="'.$bbb.'">');
			print($value);
			print('</div>');
			//print('<br>');
			print('</label>');
		}else{
			print('<div class="sample">');
			print('<span id="'.$ccc.'">');
			print('消');
			print('</span>');
			print('<input id="'.$aaa.'" type="radio" name="question" value="'.$value.'" />');
			print('<label for="'.$aaa.'">');
			print('<div id ="'.$bbb.'">');
			print($value);
			print('</div>');
			//print('<br>');
			print('</label>');
			print('</div>');
		}

		

		




		$aaa += 1;
		$bbb += 1;
		$ccc += 1;
		print('<br>');



		}
		print('</td>');
		//print('<td>');

		//print('        　　　　　　　');//全角空白

		//print('</td>');
		print('</tr>');
	print('</div>');
	print('</table>');

	print('<input type="hidden" name="answer" value="'.$answer.'">');
	if(isset($answer2)){
		print('<input type="hidden" name="answer2" value="'.$answer2.'">');
	}
	print('<input type="hidden" name="array" value="'.$ar.'">');
	print('<input type="hidden" name="qf" value="'.$qf.'">');
	print('<input type="hidden" name="qn" value="'.$qn.'">');
	if(!isset($master)){
		print('<input type="hidden" name="userid" value="'.$userid.'">');
	}
	print('<input type="hidden" name="yes" value="'.$yes.'">');
	
	if(!isset($master)){
		
		print('<button class="square_btn type="submit">');
		print('回答する');
		print('</button>');
		print('</form>');
	}else{
		print('</form>');
		print('<form method="POST" action="quiz_search.php">');
		print('<button class="square_btn type="submit">');
		print('検索に戻る');
		print('</button>');
		print('</form>');
	}
?>
</center>
<br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br>
</body>

</div>
</html>
