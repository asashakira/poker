<!DOCTYPE html>

<html lang="ja">

<head>
  <title>Poker</title>
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
//$a = array(47, 48, 49, 50, 51);
$user = $_POST['user'];
$bet = $_POST['bet'];
$coin = $_POST['coin'];
$win = $bet;
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
      <td class="yaku-bet" id="bet11"><?php print $bet * 500; ?></td>
    </tr>
    <tr>
      <td>ロイヤルストレートフラッシュ</td>
      <td class="yaku-bet" id="bet10"><?php print $bet * 100; ?></td>
    </tr>
    <tr>
      <td>ストレートフラッシュ</td>
      <td class="yaku-bet" id="bet9"><?php print $bet * 50; ?></td>
    </tr>
    <tr>
      <td>フォーカード</td>
      <td class="yaku-bet" id="bet8"><?php print $bet * 20; ?></td>
    </tr>
    <tr>
      <td>フルハウス</td>
      <td class="yaku-bet" id="bet7"><?php print $bet * 10; ?></td>
    </tr>
  </table>
  <table class="table-right">
    <tr>
      <td>フラッシュ</td>
      <td class="yaku-bet" id="bet6"><?php print $bet * 5; ?></td>
    </tr>
    <tr>
      <td>ストレート</td>
      <td class="yaku-bet" id="bet5"><?php print $bet * 4; ?></td>
    </tr>
    <tr>
      <td>スリーカード</td>
      <td class="yaku-bet" id="bet4"><?php print $bet * 3; ?></td>
    </tr>
    <tr>
      <td>ツーペア</td>
      <td class="yaku-bet" id="bet3"><?php print $bet * 2; ?></td>
    </tr>
    <tr>
      <td>ペア</td>
      <td class="yaku-bet" id="bet2"><?php print $bet; ?></td>
    </tr>
  </table>
</div> <!-- yaku-table end -->

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
<?php
$win = 0;
$sql = "update passdb set coin = '$coin' where uname = '$user'";
pg_query($sql);
?>
    残念でした！</br>
    もういちど　ポーカーを遊びますか？
  <div class="btn-wrap">
    <form action="play.php" method="post">
      <input type="hidden" name="user" value=<?php print $user; ?>>
      <button type="submit">はい</button>
    </form>
    <form action="http://133.54.224.240/penshu4_2020/67190272/last/main.php">
      <button type="submit">いいえ</button>
    </form>
  </div> <!-- end btn-wrap -->
</div> <!-- end text-wrap -->
<?php break; ?>

<?php default: ?>
    おめでとうございます！</br>
<?php
switch(handRank($a)):
  case 2:
    print "ペアです！";
    break;
  case 3:
    print "ツーペアです！";
    $win *= 2;
    break;
  case 4:
    print "スリーカードです！";
    $win *= 3;
    break;
  case 5:
    print "ストレートです！";
    $win *= 4;
    break;
  case 6:
    print "フラッシュです！";
    $win *= 5;
    break;
  case 7:
    print "フルハウスです！";
    $win *= 10;
    break;
  case 8:
    print "フォーカードです！";
    $win *= 20;
    break;
  case 9:
    print "ストレートフラッシュです！";
    $win *= 50;
    break;
  case 10:
    print "ロイヤルストレートフラッシュです！";
    $win *= 100;
    break;
  case 11:
    print "ファイブカードです！";
    break;
  case 12:
    print "ロイヤルストレートスライムです！";
    $win *= 500;
    break;
endswitch ?>
<br>
<?php print $win; ?>枚のコインが　当たりました．</br>
  成功すると <?php print($win * 2); ?>枚になります．</br>
  ダブルアップに挑戦しますか？
</div> <!-- end text-wrap -->
<div class="btn-wrap">
  <form action="doubleUp.php" method="post">
    <input type="hidden" name="user" value="<?php print $user; ?>">
    <input type="hidden" name="coin" value="<?php print $coin; ?>">
    <input type="hidden" name="bet" value="<?php print $win; ?>">
    <button type="submit">はい</button>
  </form>
  <form action="play.php" method="post">
    <input type="hidden" name="user" value="<?php print $user; ?>">
    <input type="hidden" name="coin" value="<?php print $coin; ?>">
    <input type="hidden" name="win" value="<?php print $win; ?>">
    <button type="submit">いいえ</button>
  </form>
</div> <!-- btn-wrap end -->

<?php endswitch ?>

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
