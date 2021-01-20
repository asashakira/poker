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

@$con = pg_connect("host=kite.cs.miyazaki-u.ac.jp dbname=endb2058 user=enuser2058 password=enpass2058");
if ($con == false){
  print("DATABASE CONNECTION ERROR\n");
  exit;
}

$sql = "select * from user_info where name = '{$_POST['name']}' and pass = '{$_POST['pass']}'";
@$result = pg_query($sql);
if($result == false) {
  print "DATA ERROR\n";
  exit;
}

if($count == null) {
  print("DATABASE CONNECTION ERROR\n");
  print "<br>";
  print("<a href=\"main.php\">戻る");
  exit;
}
pg_free_result($result);
pg_close($con);

?>

<p>
ログインします
</p>

<?php

print ("<form action =\"main.php\" method=\"post\">");
print "<br>";
print("USER: <input type = \"test\" name = \"uname\" value=".$_POST['uname'].">");
print("PASS:<input type=\"tezt\" name=\"pass\" value=".$_POST['pass']."><br>");
print ("<input type = \"submit\">");

?>

</body>

</html>
