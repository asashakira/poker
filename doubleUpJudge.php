<!DOCTYPE html>

<html lang="ja">

<head>
  <title>Double Up</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/813ca13dc0.js" crossorigin="anonymous"></script>
</head>
<body>

<?php
include 'poker.php';

@$con = pg_connect("host=kite.cs.miyazaki-u.ac.jp dbname=endb2020 user=enuser2020 password=enpass2020");
if($con == false) {
  print "Database Connection Error";
  exit;
}

$a = $_POST['card'];
$b = $_POST['radio'];
$c = $a[0] % 13;
$d = $a[$b] % 13;

$user = $_POST['user'];
$coin = $_POST['coin'];
$bet = $_POST['bet'];
$win = $bet * 2;
?>

<ul class="navbar">
  <li style="padding-left: 30px"><a href="http://133.54.224.240/penshu4_2020/67190272/last/main.php">Home</a></li>
  <li><span class="title">P<i class="fas fa-heart heart"></i>KER</span></li>
  <li style="padding-right: 30px"><span>user: <?php print $user; ?></span></li>
</ul>

<div class="yaku-table">
  <table class="table-left">
    <tr>
      <td>ロイヤルストレートスライム</td>
      <td class="yaku-bet" id="bet10"> x500</td>
    </tr>
    <tr>
      <td>ロイヤルストレートフラッシュ</td>
      <td class="yaku-bet" id="bet10"> x100</td>
    </tr>
    <tr>
      <td>ストレートフラッシュ</td>
      <td class="yaku-bet" id="bet9">x50</td>
    </tr>
    <tr>
      <td>フォーカード</td>
      <td class="yaku-bet" id="bet8">x20</td>
    </tr>
    <tr>
      <td>フルハウス</td>
      <td class="yaku-bet" id="bet7">x10</td>
    </tr>
  </table>
  <table class="table-right">
    <tr>
      <td>フラッシュ</td>
      <td class="yaku-bet" id="bet6">x5</td>
    </tr>
    <tr>
      <td>ストレート</td>
      <td class="yaku-bet" id="bet5">x4</td>
    </tr>
    <tr>
      <td>スリーカード</td>
      <td class="yaku-bet" id="bet4">x3</td>
    </tr>
    <tr>
      <td>ツーペア</td>
      <td class="yaku-bet" id="bet3">x2</td>
    </tr>
    <tr>
      <td>ペア</td>
      <td class="yaku-bet" id="bet2">x1</td>
    </tr>
  </table>
</div> <!-- yaku-table end -->

<div class="play">
  <div class="cards">
<?php
    for($i = 0; $i < 5; $i++) {
      print "<div class=\"card\">\n";
      if($i == 0)
        print "<img id=\"card0\" src=\"img/cards/{$a[0]}.png\">\n";
      else if($i == $b)
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
<?php print $win; ?>枚の  コインが当たりました．<br>
  <br>
  成功すると  コインが2倍になります．<br>
  ダブルアップに挑戦しますか？
</div> <!-- text-wrap div end -->
<div class="btn-wrap">
  <form action="doubleUp.php" method="post">
    <input type="hidden" name="user" value=<?php print $user; ?>>
    <input type="hidden" name="coin" value=<?php print $coin; ?>>
    <input type="hidden" name="bet" value=<?php print $win; ?>>
    <button type="submit">はい</button>
  </form>
  <form action="play.php" method="post">
    <input type="hidden" name="user" value=<?php print $user; ?>>
    <input type="hidden" name="coin" value=<?php print $coin; ?>>
    <input type="hidden" name="win" value=<?php print $win; ?>>
    <button type="submit">いいえ</button>
  </form>
</div> <!-- btn-wrap div end -->
<?php elseif($d < $c): ?>
<?php 
$sql = "update passdb set coin = '$coin' where uname = '$user'";
pg_query($sql);
?>
  残念でした！<br>
  ポーカーを続けますか？
</div> <!-- text-wrap div end -->
<div class="btn-wrap">
  <form action="play.php" method="post">
    <input type="hidden" name="user" value=<?php print $user; ?>>
    <button type="submit">はい</button>
  </form>
  <form action="main.php" method="post">
    <input type="hidden" name="user" value=<?php print $user; ?>>
    <button type="submit">いいえ</button>
  </form>
</div>
<?php else: ?>
</div> <!-- text-wrap div end -->
  引き分け！<br>
  もう一回　ダブルアップに挑戦しますか？
<div class="btn-wrap">
  <form action="doubleUp.php" method="post">
    <input type="hidden" name="user" value=<?php print $user; ?>>
    <input type="hidden" name="coin" value=<?php print $coin; ?>>
    <input type="hidden" name="bet" value=<?php print $bet; ?>>
    <button type="submit">はい</button>
  </form>
  <form action="play.php" method="post">
    <input type="hidden" name="user" value=<?php print $user; ?>>
    <button type="submit">いいえ</button>
  </form>
</div>
<?php endif ?>

<div class="bottom-wrap">
  <div class="wooper">
    <div class="wooper-title">COIN</div>
    <div class="wooper-detail" id="coin"><?php print $coin; ?></div>
  </div> <!-- coin-wrap end -->
  <div class="wooper">
    <div class="wooper-title">WIN</div>
    <div class="wooper-detail" id="bet"><?php print $win; ?></div>
  </div> <!-- bet-wrap end -->
</div> <!-- bottom-wrap end -->

</body>
</html>
