<!DOCTYPE html>

<html lang="ja">

<head>
  <title>play</title>
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

/*
$p1[0] = $a[0];
$p1[1] = $a[1];
$p2[0] = $a[2];
$p2[1] = $a[3];

$flop1 = $a[47];
$flop2 = $a[48];
$flop3 = $a[49];

$turn = $a[50];

$river = $a[51];

$p1_coin = 10000;
$p2_coin = 10000;

$sb = 100; // small blind
$bb = 200; // big blind

?>

<div class="play">
  <div class="p1 player-info">
    <div class="player-name"><p>My name</p></div>
    <div class="player-coins">
<?php
      print $p1_coin;
?>
    </div>
    <div class="player-cards">
<?php
      print $p1[0].", ".$p1[1];
?>
    </div>
  </div> <!-- p2 div end -->
  <div class="p2 player-info">
    <div class="player-name"><p>His name</p></div>
    <div class="player-coins">
<?php
      print $p2_coin;
?>
    </div>
    <div class="player-cards">
<?php
      print $p2[0].", ".$p2[1];
?>
    </div>
  </div> <!-- p2 div end -->

  <div class="community">
    <div class="flop">
    </div>
    <div class="turn">
    </div>
    <div class="river">
    </div>
  </div> <!-- community div end -->

</div> <!-- play div end -->

 */
$b[0] = 4;
$b[1] = 4;
$b[2] = 4;
$b[3] = 0;
$b[4] = 0;

$c[0] = 3;
$c[1] = 3;
$c[2] = 3;
$c[3] = 0;
$c[4] = 0;


for($i = 0; $i < 7; $i++)
  $b[$i] = $a[$i];
for($i = 0; $i < 7; $i++)
  $c[$i] = $a[$i + 5];

for($i = 0; $i < 7; $i++)
  print_card($b[$i]);
$b = bestHand($b);
print "</br>";
for($i = 0; $i < 5; $i++)
  print_card($b[$i]);
print "hand rank";
print handRank($b);

?>
<h1>
<?php
if(handRank($b) > handRank($c))
  print "top";
else if(handRank($b) < handRank($c))
  print "bottom";
else
  if(better($b, $c, handRank($b)))
    print "top";
  else
    print "bottom";
?>
</h1>

</body>
</html>
