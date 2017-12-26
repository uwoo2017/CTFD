<link rel="stylesheet" href="design.css" type="text/css">
<div class="bg1">
<?php

session_start();
      $debug = false;
      //DB Connect
      $url = "localhost";
      $user = "root";
      $pass = "test1234";
      $dtb = "esdb";

      $db['host'] = "localhost";  // DBサーバのURL
      $db['user'] = "root";  // ユーザー名
      $db['pass'] = "test1234";  // ユーザー名のパスワード
      $db['dbname'] = "esdb";  // データベース名
      
      $link = mysql_connect($url,$user,$pass) or die("No Connected");
      $sdb = mysql_select_db($dtb,$link) or die("No Selected");

      //MySQLのクライアントの文字コードをutf8に設定
      mysql_query("SET NAMES utf8")
      or die("can not SET NAMES utf8");  
      
      if($debug) print_r($_POST);


      // エラーメッセージ、登録完了メッセージの初期化
        $errorMessage = "";
        $updateMessage = "";



if(isset($_GET['key'])){
    $b_id = $_GET['key'];
}
            
      //Create Query
      $query = "SELECT * from member where id='$b_id'";
      
      $result = mysql_query($query) or die($query . '<br />' . mysql_error() . '<hr />');
      //$num_rows = mysql_num_rows($result);
      
      
?>
<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>フィードバック</title>
    </head>
    <body>
        <h1>一覧</h1>
        
            <center>
            <fieldset>
                <legend><h2>国家試験対策の結果</h2></legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo htmlspecialchars($updateMessage, ENT_QUOTES); ?></font></div>
                
                
                
                
                <?php
                print('<blockquote>');
                print("<p>");
                print('10問のうちの正解数が表示される。(最大10~最小0)<br><br>');
                print('最大過去5回までの結果が見れる');


                print('</p>');
                print('</blockquote>');

                //$query = "SELECT * FROM `quiz`";
                if(isset($_GET['key'])){
                    if ($result = mysql_query($query)) {
                    echo '<table class="tbl_06">';
                    echo '<th>最新の結果</a></th>';
                    echo '<th>1回前の結果</a></th>';
                    echo '<th>2回前の結果</a></th>';
                    echo '<th>3回前の結果</a></th>';
                    echo '<th>4回前の結果</a></th>';
                    echo '<th>挑戦回数</a></th>';
                     
                        while ($row = mysql_fetch_array($result)) {
                            echo '<tr>';
                            
                            $cp5=$row['charenge']%5;//挑戦回数を5で割ったものを入れておく
                            $ro=array();//結果を表示する順番を入れる配列
                            switch($cp5){
                                case '1'://15432
                                    $ro=array(1,5,4,3,2);
                                    break;
                                case '2'://21543
                                    $ro=array(2,1,5,4,3);
                                    break;
                                case '3'://32154
                                    $ro=array(3,2,1,5,4);
                                    break;
                                case '4'://43215
                                    $ro=array(4,3,2,1,5);
                                    break;
                                case '0'://54321
                                    $ro=array(5,4,3,2,1);
                                    break;
                            }
                            print('<td>');
                            print($row['result'.$ro[0]]);
                            print('</td>');
                            print('<td>');
                            print($row['result'.$ro[1]]);
                            print('</td>');
                            print('<td>');
                            print($row['result'.$ro[2]]);
                            print('</td>');
                            print('<td>');
                            print($row['result'.$ro[3]]);
                            print('</td>');
                            print('<td>');
                            print($row['result'.$ro[4]]);
                            print('</td>');
                            print('<td>'.$row['charenge'].'</td>');
                            echo '</tr>';
                        }
                     echo '</table>';
                    
                    } else {
                        echo mysql_error();
                    }
                }
                ?>
            </fieldset>
        <br>
        <form action="start.php" method="GET">
        <input type="hidden" name="id" value=<?php echo $_GET['key']; ?> >
        <input type="submit" button class="square_btn" value="戻る"></button>
        </form>
        <br><br><br><br><br><br><br><br><br><br><br><br><br>
        </center>
    </body>
</html>
</div>