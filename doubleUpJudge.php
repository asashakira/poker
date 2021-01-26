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

$a = $_POST['card'];
$b = $_POST['radio'];
$c = $a[0] % 13;
$d = $a[$b] % 13;

$coin = $_POST['coin'];
$bet = $_POST['bet'];
$win = $bet * 2;
?>

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

<div class="bottom-wrap">
<div class="text-wrap">
<?php if($d > $c): ?>
  ダブルアップ成功です！<br>
<?php print $win; ?>枚の  コインが当たりました．<br>
  <br>
  成功すると  コインが2倍になります．<br>
  ダブルアップに挑戦しますか？
  <div class="btn-wrap">
    <form action="doubleUp.php" method="post">
      <input type="hidden" name="coin" value=<?php print $coin; ?>>
      <input type="hidden" name="bet" value=<?php print $win; ?>>
      <button type="submit">はい</button>
    </form>
    <form action="play.php">
      <button type="submit">いいえ</button>
    </form>
  </div> <!-- btn-wrap div end -->
</div> <!-- text-wrap div end -->
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
  <form action="doubleUp.php" method="post">
    <input type="hidden" name="coin" value=<?php print $coin; ?>>
    <input type="hidden" name="bet" value=<?php print $bet; ?>>
    <button type="submit">はい</button>
  </form>
  <form action="play.php">
    <button type="submit">いいえ</button>
  </form>
</div>
<?php endif ?>

  <div class="money-wrap">
    <table>
      <tr>
        <td>COIN</td>
        <td class="td-center" id="coin"><?php print $coin; ?></td>
      </tr>
      <tr>
        <td>BET</td>
        <td class="td-center" id="bet"><?php print $bet; ?></td>
      </tr>
    </table>
  </div> <!-- money-wrap end -->
</div> <!-- bottom-wrap end -->

</body>
</html>
