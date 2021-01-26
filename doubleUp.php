<!DOCTYPE html>

<html lang="ja">

<head>
  <title>Double Up</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'poker.php';

print "<p>Double Up</p>";

// init
for($i = 0; $i < 52; $i++)
  $a[$i] = $i;

// shuffle
for($i = 0; $i < 52; $i++) {
  $r = rand(0, 51);
  swap($a[$i], $a[$r]);
}

$coin = 10000;
$bet = 100;
?>

<div class="play">
  <form id="myform" action="doubleUpJudge.php" method="post">
    <div class="cards">
<?php
    print "<div class=\"card\">\n";
    print "<img id=\"card0\" src=\"img/cards/{$a[0]}.png\">\n";
    print "</div>\n";
    for($i = 1; $i < 5; $i++) {
      print "<div class=\"card\">\n";
      print "<img id=\"card{$i}\" src=\"img/cards/yellow_back.png\">\n";
      if($i == 1)
        print "<input type=\"radio\" name=\"radio\" value={$i} checked>\n";
      else
        print "<input type=\"radio\" name=\"radio\" value={$i}>\n";
      print "</div>\n";
    }
?>
  </div> <!-- cards div end -->
<?php
    for($i = 0; $i < 5; $i++)
      print "<input id=\"hidden{$i}\" type=\"hidden\" name=\"card[]\" value={$a[$i]}>\n"
?>
    <div class="btn-wrap">
      <button id="submit">けってい</button>
    </div>
  </form>

  <div class="coin-wrap">
<?php print $coin; ?>
  </div>
  <div class="bet-wrap">
<?php print $bet; ?>
  </div>
</div> <!-- play div end -->

</body>
</html>
