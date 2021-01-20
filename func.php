
<?php

function swap(&$a, &$b) {
  $tmp = $a;
  $a = $b;
  $b = $tmp;
}

function print_card($a) {
  $s = $a / 13;
  $a %= 13;

  if($a == 9)  $b = "J";
  if($a == 10) $b = "Q";
  if($a == 11) $b = "K";
  if($a == 12) $b = "A";
  if($a < 9)   $b = $a + 2;

  $s = (int)$s;
  if($s == 0) $c = " Diamond";
  if($s == 1) $c = " Club";
  if($s == 2) $c = " Heart";
  if($s == 3) $c = " Ace";

  print "<h3>".$b.$c."</h3>";
}

?>
