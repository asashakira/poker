<!DOCTYPE html>

<html lang="ja">

<head>
  <title>Poker</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <script src="scripts.js"></script>
  <script src="https://kit.fontawesome.com/813ca13dc0.js" crossorigin="anonymous"></script>
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

/*
@$con = pg_connect("host=kite.cs.miyazaki-u.ac.jp dbname=endb2020 user=enuser2020 password=enpass2020");
if($con == false) {
  print "Database Connection Error";
  exit;
}
 */

if(isset($_POST['win'])) {
  $user = $_POST['user'];
  $coin = $_POST['coin'] + $_POST['win'];
  pg_query("update passdb set coin = '$coin' where uname = '$user'");
}

//$user = $_POST['user'];
$user = "akira";
$sql = "select coin from passdb where uname = '$user'";
//@$res = pg_query($sql);
$coin = 10000;
//$coin = pg_fetch_result($res, 0, 0);
$bet = 100;
$coin -= $bet;
?>

<ul class="navbar">
  <li style="padding-left: 30px"><a href="http://133.54.224.240/penshu4_2020/67190272/last/main.php">Home</a></li>
  <li><span class="title">P<i class="fas fa-heart heart"></i>KER</span></li>
  <li style="padding-right: 30px"><span>user: <?php print $user; ?></span></li>
</ul>

<div class="yaku-table">
  <table class="table-left">
    <tr id="yaku11">
      <td>ロイヤルストレートスライム</td>
      <td class="yaku-bet" id="bet11"><?php print $bet * 500; ?></td>
    </tr>
    <tr id="yaku10">
      <td>ロイヤルストレートフラッシュ</td>
      <td class="yaku-bet" id="bet10"><?php print $bet * 100; ?></td>
    </tr>
    <tr id="yaku9">
      <td>ストレートフラッシュ</td>
      <td class="yaku-bet" id="bet9"><?php print $bet * 50; ?></td>
    </tr>
    <tr id="yaku8">
      <td>フォーカード</td>
      <td class="yaku-bet" id="bet8"><?php print $bet * 20; ?></td>
    </tr>
    <tr id="yaku7">
      <td>フルハウス</td>
      <td class="yaku-bet" id="bet7"><?php print $bet * 10; ?></td>
    </tr>
  </table>
  <table class="table-right">
    <tr id="yaku6">
      <td>フラッシュ</td>
      <td class="yaku-bet" id="bet6"><?php print $bet * 5; ?></td>
    </tr>
    <tr id="yaku5">
      <td>ストレート</td>
      <td class="yaku-bet" id="bet5"><?php print $bet * 4; ?></td>
    </tr>
    <tr id="yaku4">
      <td>スリーカード</td>
      <td class="yaku-bet" id="bet4"><?php print $bet * 3; ?></td>
    </tr>
    <tr id="yaku3">
      <td>ツーペア</td>
      <td class="yaku-bet" id="bet3"><?php print $bet * 2; ?></td>
    </tr>
    <tr id="yaku2">
      <td>ペア</td>
      <td class="yaku-bet" id="bet2"><?php print $bet; ?></td>
    </tr>
  </table>
</div> <!-- yaku-wrap end -->

<div class="play">
  <div class="cards">
<?php
    for($i = 0; $i < 5; $i++) {
      print "<div class=\"card\">\n";
      print "<label for=\"img{$i}\"><img class=\"pointer-active\" id=\"card{$i}\" src=\"img/cards/{$a[$i]}.png\"></label>\n";
      print "<input id=\"img{$i}\" type=\"checkbox\" name=\"check[]\" value={$i}> かえる\n";
      print "</div>\n";
    }
?>
  </div> <!-- cards div end -->
</div> <!-- play div end -->

<form id="myform" action="judge.php" method="post">
<?php
  for($i = 0; $i < 5; $i++)
    print "<input id=\"hidden{$i}\" type=\"hidden\" name=\"card[]\" value={$a[$i]}>\n";
  print "<input id=\"hidden-user\" type=\"hidden\" name=\"user\" value={$user}>\n";
  print "<input id=\"hidden-bet\" type=\"hidden\" name=\"bet\" value={$bet}>\n";
  print "<input id=\"hidden-coin\" type=\"hidden\" name=\"coin\" value={$coin}>\n";
?>
  <div class="btn-wrap">
    <button id="change">くばる</button>
  </div>
</form>

<div class="text-wrap">
掛け金を決め　かえたいカードにチェックを入れ　くばるを押してください．
</div>

<div class="bottom-wrap">
  <div class="wooper">
    <div class="wooper-title">COIN</div>
    <div class="wooper-detail" id="coin"><?php print $coin; ?></div>
  </div> <!-- coin-wrap end -->
  <div class="wooper">
    <div class="wooper-title">BET</div>
    <div class="wooper-detail" id="bet"><?php print $bet; ?></div>
  </div> <!-- bet-wrap end -->
  <div class="wooper-btn">
    <button class="bet-change" onclick="plusBet()">+</button>
    <button class="bet-change" onclick="minusBet()">-</button>
  </div>
</div> <!-- bottom-wrap end -->


<script>
function getChecked(name) {
  const cb = document.querySelectorAll(`input[name="${name}"]:checked`);
  let values = [];
  cb.forEach((checkbox) => {
    values.push(checkbox.value);
  });
  return values;
}

const btn = document.querySelector('#change');
btn.addEventListener('click', (event) => {
  var a = getChecked('check[]');
  var b = [<?php print "{$a[5]}, {$a[6]}, {$a[7]}, {$a[8]}, {$a[9]}"; ?>];
  for(var i = 0; i < a.length; i++) {
    if(a[i] == 0) {
      document.getElementById(`card${a[i]}`).src = `img/cards/${b[0]}.png`;
      document.getElementById("hidden0").value = b[0];
    } else if(a[i] == 1) {
      document.getElementById(`card${a[i]}`).src = `img/cards/${b[1]}.png`;
      document.getElementById("hidden1").value = b[1];
    } else if(a[i] == 2) {
      document.getElementById(`card${a[i]}`).src = `img/cards/${b[2]}.png`;
      document.getElementById("hidden2").value = b[2];
    } else if(a[i] == 3) {
      document.getElementById(`card${a[i]}`).src = `img/cards/${b[3]}.png`;
      document.getElementById("hidden3").value = b[3];
    } else if(a[i] == 4) {
      document.getElementById(`card${a[i]}`).src = `img/cards/${b[4]}.png`;
      document.getElementById("hidden4").value = b[4];
    }
  }
  btn.submit();
});

function plusBet() {
  var bet = document.getElementById("bet").textContent;
  var coin = document.getElementById("coin").textContent;
  if(parseInt(bet) + 100 <= 1000) {
    x = parseInt(bet) + 100;
    document.getElementById("bet").innerHTML   = x;
    document.getElementById("bet2").innerHTML  = x;
    document.getElementById("bet3").innerHTML  = x * 2;
    document.getElementById("bet4").innerHTML  = x * 3;
    document.getElementById("bet5").innerHTML  = x * 4;
    document.getElementById("bet6").innerHTML  = x * 5;
    document.getElementById("bet7").innerHTML  = x * 10;
    document.getElementById("bet8").innerHTML  = x * 20;
    document.getElementById("bet9").innerHTML  = x * 50;
    document.getElementById("bet10").innerHTML = x * 100;
    document.getElementById("bet11").innerHTML = x * 500;
    document.getElementById("hidden-bet").value = x;

    y = parseInt(coin) - 100;
    document.getElementById("coin").innerHTML = y;
    document.getElementById("hidden-coin").value = y;
  }
}

function minusBet() {
  var bet = document.getElementById("bet").textContent;
  var coin = document.getElementById("coin").textContent;
  if(parseInt(bet) - 100 > 0) {
    x = parseInt(bet) - 100;
    document.getElementById("bet").innerHTML   = x;
    document.getElementById("bet2").innerHTML  = x;
    document.getElementById("bet3").innerHTML  = x * 2;
    document.getElementById("bet4").innerHTML  = x * 3;
    document.getElementById("bet5").innerHTML  = x * 4;
    document.getElementById("bet6").innerHTML  = x * 5;
    document.getElementById("bet7").innerHTML  = x * 10;
    document.getElementById("bet8").innerHTML  = x * 20;
    document.getElementById("bet9").innerHTML  = x * 50;
    document.getElementById("bet10").innerHTML = x * 100;
    document.getElementById("bet11").innerHTML = x * 500;
    document.getElementById("hidden-bet").value = x;

    y = parseInt(coin) + 100;
    document.getElementById("coin").innerHTML = y;
    document.getElementById("hidden-coin").value = y;
  }
}

</script>

</body>
</html>
