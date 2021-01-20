<!DOCTYPE html>

<html lang="ja">

<head>
<link rel="stylesheet" type="text/css" href="/~tyf7207/css/yamaba01.css">
<title>
ユーザー登録
</title>
<meta charset="utf-8">
</head>

<body>
<h1>ユーザー登録</h1>

<?php

 // データベースへの接続
@$con = pg_connect("host=kite.cs.miyazaki-u.ac.jp dbname=endb2020 user=enuser2020 password=enpass2020");
if ($con == false){
  print("DATABASE CONNECTION ERROR\n");
  exit;
}


$sql1 = "select uname from passdb where uname = '{$_POST['uname']}'"; // SQLのコマンド文を文字列に格納する。

print $sql1."<br>";

@$result = pg_query($sql1); // SQLのコマンドでデータベースに問い合わせする。
if($result == false){
  print"DATA ACQUISITION ERROR\n";
  exit;
}

$row = pg_num_rows($result);

pg_free_result($result); // SQLの実行結果を格納していたメモリを解放。

if($row > 0){ // 入力されたユーザ名が、データベースの中に１つ以上ある時は「登録済み」

  pg_close($con); // データベースとの接続を閉じる。

  print "<p>\n";
  print "そのユーザ名は登録済みです。\n";
  print "</p>\n";

  print "<p>\n";
  print "<a href=\"index.php\">戻る</a>\n";
  print "</p>\n";

  print "</body>\n";

  print "</html>\n";

  exit;
}


// 以下は、プログラミングドリルの1-cを参照せよ

$sql1 = "insert into passdb values('".$_POST['uname']."','".$_POST['pass']."',10)"; // テーブルpassdbに、ユーザ名とパスワードを登録する。

print $sql1."<br>";

@$result = pg_query($sql1); // SQLのコマンドでデータベースに問い合わせする。
if($result == false){
  print"DATA INSERTION ERROR\n";
  exit;
}
pg_free_result($result); // SQLの実行結果を格納していたメモリを解放。


$sql2 = "create table ".$_POST['uname']." (id int, pass int)"; // ユーザ名のテーブルを作成する。列はidとpassで、型はどちらもint。
print $sql2."<br>";

@$result = pg_query($sql2); // SQLのコマンドでデータベースに問い合わせする。
if($result == false){
  print"TABLE CREATION ERROR\n";
  exit;
}

pg_free_result($result); // SQLの実行結果を格納していたメモリを解放。
pg_close($con); // データベースとの接続を閉じる。
?>

<p>
ユーザを登録しました。
</p>

<p>
<a href="main.php">戻る</a>
</p>

</body>

</html>
