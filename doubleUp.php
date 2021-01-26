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

// init
for($i = 0; $i < 52; $i++)
  $a[$i] = $i;

// shuffle
for($i = 0; $i < 52; $i++) {
  $r = rand(0, 51);
  swap($a[$i], $a[$r]);
}

$coin = $_POST['coin'];
$bet = $_POST['bet'];
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
</div> <!-- play div end -->

<?php
  for($i = 0; $i < 5; $i++)
    print "<input id=\"hidden{$i}\" type=\"hidden\" name=\"card[]\" value={$a[$i]}>\n";
  print "<input type=\"hidden\" name=\"coin\" value={$coin}>\n";
  print "<input type=\"hidden\" name=\"bet\" value={$bet}>\n";
?>
  <div class="btn-wrap">
    <button id="submit">けってい</button>
  </div>
</form>

<div class="bottom-wrap">
  <div class="text-wrap">
  オープンしている　カードより<br>
  強いカードを　右の4枚から　選んでください
  </div>
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
