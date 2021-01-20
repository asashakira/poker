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

@$con = pg_connect("host=kite.cs.miyazaki-u.ac.jp dbname=endb2058 user=enuser2058 password=enpass2058");
if ($con == false){
  print("DATABASE CONNECTION ERROR\n");
  exit;
}

$sql = "select name from user_info where name = '{$_POST['name']}'";

@$result = pg_query($sql);
if($result == false){
  print"DATA ACQUISITION ERROR\n";
  exit;
}
$row = pg_num_rows($result);
pg_free_result($result);

if($row > 0) {
  pg_close($con);
  print "<p>\n";
  print "そのユーザ名は登録済みです。\n";
  print "</p>\n";

  print "<p>\n";
  print "<a href=\"signup.html\">戻る</a>\n";
  print "</p>\n";

  print "</body>\n";
  print "</html>\n";
  exit;
}

$sql = "insert into user_info values('".$_POST['name']."','".$_POST['pass']."',10000)";
@$result = pg_query($sql);
if($result == false) {
  print"DATA INSERTION ERROR\n";
  exit;
}
pg_free_result($result);

?>

<p>
ユーザを登録しました。
</p>

<p>
<a href="main.php">戻る</a>
</p>

</body>

</html>
