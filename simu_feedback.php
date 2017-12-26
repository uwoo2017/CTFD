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
      $query = "SELECT * from simu_user where id='$b_id'";
      
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
                <legend><h2>シミュレーションの結果</h2></legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo htmlspecialchars($updateMessage, ENT_QUOTES); ?></font></div>
                <?php

                print('<blockquote>');
                print("<p>");
                print('<table>');
                print('<tr><td>');
                print('挑戦したクライアントのタイプごとに結果が表示されています<br>挑戦する際はランダムで選ばれる<br>');
                print('評価は、初期対応度から最大+50　最小―50まであります(右図参照)<br>');

                print('対応度が0以下で強制終了になり、その時の結果が表示されます<br>');
                print('タイプ別に結果が表示されており、最大過去3回の結果が見れる');

                print('</td>');
                print('<td>   </td>');
                print('<td>');
                print('<table border=1>');
                print('<tr><td>');

                print('</td> <td><center>タイプ</td> <td> 初期対応度 </td><td>最大～最小</td></tr> ');
                print('<tr><td>');
                print('上段</td><td> やる気あり </td><td><center>65</td><td><center>115~15 </tr><tr>');

                print('<td>');
                print('中段</td><td> どちらでもない </td><td><center>40 </td><td><center>90~ -10 </tr><tr>');
                print('<td>');
                print('下段 </td><td> やる気なし</td><td><center>25</td><td><center>75~ -10</td></tr> ');
                print('</table>');
                print('</td></tr>');
                print('</table>');

                print('</p>');
                print('</blockquote>');

                
                //$query = "SELECT * FROM `quiz`";
                if(isset($_GET['key'])){
                    if ($result = mysql_query($query)) {
                    echo '<table class="tbl_06">';
                    echo '<th>最新の結果</a></th>';
                    echo '<th>1回前の結果</a></th>';
                    echo '<th>2回前の結果</a></th>';
                    echo '<th>type[positive]挑戦回数</a></th>';
                     
                        while ($row = mysql_fetch_array($result)) {
                            echo '<tr>';
                            $ecp3=$row['easy_challenge']%3;//EASYの挑戦回数を3で割ったもの
                            $ro=array();//結果を表示する順番を入れる配列
                            switch($ecp3){
                                case '1'://132
                                    $ro=array(1,3,2);
                                    break;
                                case '2'://213
                                    $ro=array(2,1,3);
                                    break;
                                case '0'://321
                                    $ro=array(3,2,1);
                                    break;
                            }
                            print('<td>');
                            print($row['easy_result'.$ro[0]]);
                            print('</td>');
                            print('<td>');
                            print($row['easy_result'.$ro[1]]);
                            print('</td>');
                            print('<td>');
                            print($row['easy_result'.$ro[2]]);
                            print('</td>');
                            print('<td>'.$row['easy_challenge'].'</td>');               
                            echo '</tr>';

                            echo '<th>最新の結果</a></th>';
                            echo '<th>1回前の結果</a></th>';
                            echo '<th>2回前の結果</a></th>';
                            echo '<th>type[normal]挑戦回数</a></th>';

                            echo '<tr>';
                            $ncp3=$row['normal_challenge']%3;//NORMALの挑戦回数を3で割ったもの
                            //$ro=array();//結果を表示する順番を入れる配列
                            switch($ncp3){
                                case '1'://132
                                    $ro=array(1,3,2);
                                    break;
                                case '2'://213
                                    $ro=array(2,1,3);
                                    break;
                                case '0'://321
                                    $ro=array(3,2,1);
                                    break;
                            }
                            print('<td>');
                            print($row['normal_result'.$ro[0]]);
                            print('</td>');
                            print('<td>');
                            print($row['normal_result'.$ro[1]]);
                            print('</td>');
                            print('<td>');
                            print($row['normal_result'.$ro[2]]);
                            print('</td>');
                            print('<td>'.$row['normal_challenge'].'</td>');               
                            echo '</tr>';

                            echo '<th>最新の結果</a></th>';
                            echo '<th>1回前の結果</a></th>';
                            echo '<th>2回前の結果</a></th>';
                            echo '<th>type[negative]挑戦回数</a></th>';

                            echo '<tr>';
                            $hcp3=$row['hard_challenge']%3;//HARDの挑戦回数を3で割ったもの
                            $ro=array();//結果を表示する順番を入れる配列
                            switch($hcp3){
                                case '1'://132
                                    $ro=array(1,3,2);
                                    break;
                                case '2'://213
                                    $ro=array(2,1,3);
                                    break;
                                case '0'://321
                                    $ro=array(3,2,1);
                                    break;
                            }
                            print('<td>');
                            print($row['hard_result'.$ro[0]]);
                            print('</td>');
                            print('<td>');
                            print($row['hard_result'.$ro[1]]);
                            print('</td>');
                            print('<td>');
                            print($row['hard_result'.$ro[2]]);
                            print('</td>');
                            print('<td>'.$row['hard_challenge'].'</td>');               
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
        <br><br>
        </center>
    </body>
</html>
</div>