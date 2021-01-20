<!DOCTYPE html>

<html lang="ja">

<head>
<link rel="stylesheet" type="text/css" href="/~tyf7207/css/yamaba01.css">
<title>Texas Hold'em</title>
<meta charset="utf-8">
</head>

<body>
<h1>main</h1>

<ol>
  <li><a href="signup.html">ユーザー登録</a></li>
  <li><a href="login.html">ログイン</a></li>
  <li><a href="ranking.php">ランキング未完成</a></li>
  <br>
</ol>



<?php
@$con = pg_connect("host=kite.cs.miyazaki-u.ac.jp dbname=endb2020 user=enuser2020 password=enpass2020");
if ($con == false) {
  print("DATABASE CONNECTION ERROR\n");
  exit;
}



if(isset($_POST['uname'])) {

  $sql1 = ("select coin from passdb where uname ='".$_POST['uname']."'");

  $reseut = pg_query($sql1);

  $number_of_coins = pg_fetch_result($reseut,0,0);//コインの枚数を取得して、number_of_coinsに代入
  pg_free_result($reseut);
  pg_close($con); // データベースとの接続を閉じる。

  print("<form action=\"preparation.php\" method=\"post\">");
  print("<input type=\"hidden\" name=\"uname\" value=\"".$_POST['uname']."\">");
  print("<input type=\"hidden\" name=\"coin\" value=\"".$number_of_coins."\">");
  print("<input type=\"submit\" value=\"ゲームへ参加する\">");
  print("</form>");
}

?>

</body>

</html>
