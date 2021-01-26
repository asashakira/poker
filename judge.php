<!DOCTYPE html>

<html lang="ja">

<head>
  <title>Poker</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'poker.php';

print "<p>judge</p>";
$a = $_POST['card'];
//$a = array(0, 1, 2, 3, 4);
?>

<div class="play">
  <div class="cards">
<?php
    for($i = 0; $i < 5; $i++) {
      print "<div class=\"card\">";
        print "<img id=\"card{$i}\" src=\"img/cards/{$a[$i]}.png\">\n";
      print "</div>";
    }
?>
  </div> <!-- cards div end -->

</div> <!-- play div end -->

<div class="text-wrap">
<?php switch(handRank($a)): ?>
<?php case 1: ?>
<?php case 2: ?>
    残念でした！</br>
    もういちど　ポーカーを遊びますか？
  </div>
</div> <!-- end text-wrap -->
<div class="btn-wrap">
  <form action="play.php">
    <button type="submit">はい</button>
  </form>
  <form action="play.php">
    <button type="submit">いいえ</button>
  </form>
</div> <!-- end btn-wrap -->
<?php break; ?>

<?php default: ?>
    おめでとうございます！</br>
<?php switch(handRank($a)):
case 3:
  print "ツーペアです！";
  break;
case 4:
  print "スリーカードです！";
  break;
case 5:
  print "ストレートです！";
  break;
case 6:
  print "フラッシュです！";
  break;
case 7:
  print "フルハウスです！";
  break;
case 8:
  print "フォーカードです！";
  break;
case 9:
  print "ストレートフラッシュです！";
  break;
case 10:
  print "ロイヤルストレートフラッシュです！";
  break;
case 11:
  print "ファイブカードです！";
  break;
case 12:
  print "ロイヤルストレートスライムです！";
  break;
?>
<?php endswitch ?>
  <br>
  成功すると コインが2倍になります．</br>
  ダブルアップに挑戦しますか？
</div> <!-- end text-wrap -->
<div class="btn-wrap">
  <form action="doubleUp.php">
    <button type="submit">はい</button>
  </form>
  <form action="play.php">
    <button type="submit">いいえ</button>
  </form>
</div>

<?php endswitch ?>

  <div class="coin-wrap">
  </div>
  <div class="bet-wrap">
  </div>


</body>
</html>
