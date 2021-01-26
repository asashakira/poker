<!DOCTYPE html>

<html lang="ja">

<head>
  <title>Double Up</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <script src="scripts.js"></script>
</head>
<body>

<?php
include 'poker.php';
print "<p>double up</p>";
$a = $_POST['card'];
$b = $_POST['radio'];
$c = $a[0] % 13;
$d = $a[$b] % 13;
print $c;
print $d;
?>

<div class="play">
  <div class="cards">
<?php
    print "<div class=\"card\">\n";
    print "<img id=\"card0\" src=\"img/cards/{$a[0]}.png\">\n";
    print "</div>\n";
    for($i = 1; $i < 5; $i++) {
      print "<div class=\"card\">\n";
      if($i == $b)
        print "<img id=\"card{$i}\" src=\"img/cards/{$a[$i]}.png\">\n";
      else
        print "<img id=\"card{$i}\" src=\"img/cards/yellow_back.png\">\n";
      print "</div>\n";
    }
?>
  </div> <!-- cards div end -->
</div> <!-- play div end -->

<div class="text-wrap">
<?php if($d > $c): ?>
  ダブルアップ成功です！<br>
  コインが当たりました<br>
  成功すると　コインが2倍になります．<br>
  ダブルアップに挑戦しますか？
</div> <!-- text-wrap div end -->
<div class="btn-wrap">
  <form action="doubleUp.php">
    <button type="submit">はい</button>
  </form>
  <form action="play.php">
    <button type="submit">いいえ</button>
  </form>
</div>
<?php elseif($d < $c): ?>
  残念でした！<br>
  ポーカーを続けますか？
</div> <!-- text-wrap div end -->
<div class="btn-wrap">
  <form action="play.php">
    <button type="submit">はい</button>
  </form>
  <form action="play.php">
    <button type="submit">いいえ</button>
  </form>
</div>
<?php else: ?>
</div> <!-- text-wrap div end -->
  引き分け！<br>
  ダブルアップに挑戦しますか？
<div class="btn-wrap">
  <form action="doubleUp.php">
    <button type="submit">はい</button>
  </form>
  <form action="play.php">
    <button type="submit">いいえ</button>
  </form>
</div>
<?php endif ?>

<div class="coin-wrap">
</div> <!-- coin-wrap div end -->
<div class="bet-wrap">
</div> <!-- bet-wrap div end -->

</body>
</html>
