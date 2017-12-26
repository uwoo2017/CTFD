<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">
<br><br><br><br><br><br>
<?php
//answer.php


if(isset($_POST['userid'])){
	$userid = $_POST['userid'];
	//echo $userid;
}



if(isset($_POST['question'])){
	$question = $_POST['question']; //ラジオボタンの内容を受け取る
	if(is_array($question)){//チェックボックスでの回答の場合
		$vvv=0;
		foreach($question as $value){//回答の個数繰り返す
			$question[$vvv]=$value;
			
			//print($question[$vvv]);
			$vvv +=1;
			
		}
	}//else{print($question);}
		//print($question);
	$answer = $_POST['answer']; //hiddenで送られた正解を受け取る
	if(isset($_POST['answer2'])){//答え2がある場合
		$answer2 = $_POST['answer2']; //hiddenで送られた正解を受け取る
	}
	$qf = $_POST['qf'];//前の問題ID
	$qn = $_POST['qn']+1;//第何問だったか　に　1足して次の問題数
	$yes =$_POST['yes'];//正解数
	
	
	
	
	$ar = $_POST['array'];//前の問題配列
	/*echo $qf;
	echo '<br>';
	echo $ar;
	echo '<br>';
	*/

	//結果の判定
	if(isset($answer2)){
		if($vvv==2){
			if(($answer==$question[0]||$answer==$question[1])&&($answer2==$question[0||$answer2==$question[1]])){
				$result = "正解！";
				$yes_c = $yes +1;
			}else{
				$result = "不正解･･･";
				$yes_c = $yes;
			}
		}else{
			$result = "不正解･･･";//
			$yes_c = $yes;//2択問題で、1つや3つ選んでいたら、強制で不正解
		}
	}else{
		if($question == $answer){
			$result = "正解！";
			$yes_c = $yes +1;
		}else{
			$result = "不正解･･･";
			$yes_c = $yes;
			
		}
	}

	
	if($ar[0]==0){
		$ar=$qf;
		//echo "qwerthj";
	}else{
		$ar.= ",".$qf;
		//echo "zxcvbnm,";
	}
	$q_c =array();
	$q_c = explode(",",$ar);
	
	/*echo $qf;
	echo '<br>';
	*/
	print('<center>');
	print('<div class="balloon1">');

	echo '<br>';
	echo $result;
	echo '<br>';
	if($result=="不正解･･･"){
		print('答えは<br>');
		if(isset($answer2)){
			print($answer.'<br>と<br>');
			print($answer2.'<br>でした');
		}else{
			print($answer.'<br>でした');
		}
	}
	


	print('</div>');
	
	
	echo '<br><br>';
	
	
	print('<div class="balloon2">');

	echo 'ただいまの正解数<br>';
	echo $yes_c;

	print('</div>');


	if(count($q_c)==10){
		print('<form method="POST" action="end.php">');
		//print('<input type="hidden"name="array" value="'.$ar.'">');
		print('<input type="hidden" name="userid" value="'.$userid.'">');
		print('<input type="hidden"name="yes_e" value="'.$yes_c.'">');
		print('<button class="square_btn type="submit">次へ</button>');
		
	}else{
		print('<form method="POST" action="quiz.php">');
		print('<input type="hidden"name="array" value="'.$ar.'">');
		
		print('<input type="hidden"name="qn" value="'.$qn.'">');
		print('<input type="hidden" name="userid" value="'.$userid.'">');
		print('<input type="hidden"name="yes_c" value="'.$yes_c.'">');
		print('<button class="square_btn type="submit">次へ</button>');
	}

}else{
	$yes =$_POST['yes'];//正解数
	$ar = $_POST['array'];//前の問題配列
	$qf = $_POST['qf'];//前の問題ID
	$qn = $_POST['qn'];//第何問だったか

	echo('<br><br>');
	echo('チェックされていません');
	echo('<br><br>');
	print('<form method="POST" action="quiz.php">');
	print('<input type="hidden"name="array" value="'.$ar.'">');
	print('<input type="hidden" name="userid" value="'.$userid.'">');
	print('<input type="hidden"name="yes_c" value="'.$yes.'">');
	print('<input type="hidden"name="qf" value="'.$qf.'">');
	print('<input type="hidden"name="qn" value="'.$qn.'">');
	print('<button class="square_btn type="submit">戻る</button>');
}
?>
<!doctype html>
<br><br><br><br><br><br>
<html>
<head>
<meta charset="utf-8">

<title>栄養自習システム - 結果</title>
</head>
<body>
</form>
</body>

</div>

</html>