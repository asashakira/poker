<!DOCTYPE html>

<html lang="ja">

<head>
  <title>Poker</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <script src="scripts.js"></script>
</head>
<body>

<?php
include 'poker.php';

print "<p>play</p>";
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
  <div class="cards">
<?php
    for($i = 0; $i < 5; $i++) {
      print "<div class=\"card\">\n";
      print "<img id=\"card{$i}\" src=\"img/cards/{$a[$i]}.png\">\n";
      print "<input type=\"checkbox\" name=\"check[]\" value={$i}> かえる\n";
      print "</div>\n";
    }
?>
  </div> <!-- cards div end -->
</div> <!-- play div end -->

<form id="myform" action="judge.php" method="post">
<?php
  for($i = 0; $i < 5; $i++)
    print "\t\t<input id=\"hidden{$i}\" type=\"hidden\" name=\"card[]\" value={$a[$i]}>\n"
?>
  <div class="btn-wrap">
    <button id="change">くばる</button>
  </div>
</form>

<div class="bottom-wrap">
  <div class="coin">
    <div class="title">COIN</div>
    <p id="coin"><?php print $coin; ?></p>
  </div>
  <div class="bet">
    <div class="title">BET</div>
    <p id="bet"><?php print $bet; ?></p>
    <button onclick="minusBet()">-</button>
    <button onclick="plusBet()">+</button>
  </div>
</div>

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
  var x = document.getElementById("bet").textContent;
  if(parseInt(x) + 100 <= 1000)
    document.getElementById("bet").innerHTML = parseInt(x) + 100;
}

function minusBet() {
  var x = document.getElementById("bet").textContent;
  if(parseInt(x) - 100 > 0)
    document.getElementById("bet").innerHTML = parseInt(x) - 100;
}

</script>

</body>
</html>
