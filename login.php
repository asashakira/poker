<!DOCTYPE html>

<html lang="ja">

<head>
<link rel="stylesheet" type="text/css" href="/~tyf7207/css/yamaba01.css">
<title>
ログイン画面
</title>
<meta charset="utf-8">
</head>

<body>
<h1>ログイン画面</h1>

<?php

 // データベースへの接続
@$con = pg_connect("host=kite.cs.miyazaki-u.ac.jp dbname=endb2020 user=enuser2020 password=enpass2020");
if ($con == false){
  print($_POST['uname']."はデータにありません\n");
  exit;
}


$sql1 = "select * from passdb where uname = '".$_POST['uname']."' and pass ='".$_POST['pass']."'";

print $sql1."<br>";

$result = pg_query($sql1); // SQLのコマンドでデータベースに問い合わせする。

print @$result;

@$count = pg_num_rows($result);//レコードがあるか判断する



if($count == null)
    {
      print("DATABASE CONNECTION ERROR\n");
      print "<br>";
      print("<a href=\"main.php\">戻る");
  exit;
}
pg_free_result($result); // SQLの実行結果を格納していたメモリを解放


pg_close($con); // データベースとの接続を閉じる。


?>

<p>
ログインします
</p>

<?php
//min.phpにユーザとパスワードの値を渡す

print ("<form action =\"main.php\" method=\"post\">");
print "<br>";
print("USER: <input type = \"test\" name = \"uname\" value=".$_POST['uname'].">");
print("PASS:<input type=\"tezt\" name=\"pass\" value=".$_POST['pass']."><br>");
print ("<input type = \"submit\">");


?>

</body>

</html>
