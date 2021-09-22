
<?php
include 'func.php';

function show($a) {
  for($i = 0; $i < 52; $i++)
    print $a[$i]."\n";
}

function _flush($a) {
  for($i = 0; $i < 5; $i++)
    $a[$i] /= 13;
  $b = (int)$a[0];
  for($i = 0; $i < 5; $i++)
    if((int)$a[$i] != $b)
      return false;
  return true;
}

function straight($a) {
  for($i = 0; $i < 5; $i++)
    $a[$i] %= 13;
  sort($a);
  $b = $a[0];
  for($i = 0; $i < 5; $i++)
    if($a[$i] != $b++)
      return false;
  return true;
}

function straightFlush($a) {
  if(!_flush($a))
    return false;
  if(!straight($a))
    return false;
  return true;
}

function quads($a) {
  for($i = 0; $i < 5; $i++)
    $a[$i] %= 13;
  sort($a);
  for($i = 0; $i + 3 < 5; $i++)
    if($a[$i] == $a[$i + 3])
      return true;
  return false;
}

function trips($a) {
  for($i = 0; $i < 5; $i++)
    $a[$i] %= 13;
  sort($a);
  $b = $a[0];
  $count = 0;
  for($i = 0; $i + 2 < 5; $i++)
    if($a[$i] == $a[$i + 1] && $a[$i] == $a[$i + 2])
      return true;
  return false;
}

function twoPair($a) {
  for($i = 0; $i < 5; $i++)
    $a[$i] %= 13;
  sort($a);
  $count = 0;
  for($i = 0; $i + 1 < 5; $i++) 
    if($a[$i] == $a[$i + 1])
      $count++;
  if($count == 2)
    return true;
  return false;
}

function pair($a) {
  for($i = 0; $i < 5; $i++)
    $a[$i] %= 13;
  sort($a);
  for($i = 0; $i + 1 < 5; $i++) 
    if($a[$i] == $a[$i + 1])
      return true;
  return false;
}

function fullHouse($a) {
  for($i = 0; $i < 5; $i++)
    $a[$i] %= 13;
  sort($a);
  $b = $a[0];
  $c = $a[4];
  $count1 = 0;
  $count2 = 0;
  for($i = 0; $i < 5; $i++) {
    if($a[$i] == $b)
      $count1++;
    if($a[$i] == $c)
      $count2++;
  }
  if($count1 > $count2)
    swap($count1, $count2);
  if($count1 == 2 and $count2 == 3)
    return true;
  return false;
}

function royal($a) {
  if(!straightFlush($a))
    return false;
  sort($a);
  if($a[0] % 13 != 8)
    return false;
  return true;
}

function royalSlime($a) {
  if(!royal($a))
    return false;
  $b = (int)($a[0] / 13);
  if($b != 3)
    return false;
  return true;
}

function handRank($a) {
  if(royalSlime($a))    return 12;
  if(royal($a))         return 10;
  if(straightFlush($a)) return 9;
  if(quads($a))         return 8;
  if(fullHouse($a))     return 7;
  if(_flush($a))        return 6;
  if(straight($a))      return 5;
  if(trips($a))         return 4;
  if(twoPair($a))       return 3;
  if(pair($a))          return 2;
  return 1;
}

function highCard($a, $b) {
  $n = count($a);
  rsort($a);
  rsort($b);
  for($i = 0; $i < $n; $i++) {
    if($a[$i] < $b[$i])
      return false;
    if($a[$i] > $b[$i])
      return true;
  }
  return true;
}

// a < b : false
// a > b : true
function better($a, $b, $rank) {
  for($i = 0; $i < 5; $i++) {
    $a[$i] %= 13;
    $b[$i] %= 13;
  }
  sort($a);
  sort($b);

  switch($rank) {
    case 2:
      for($i = 0; $i + 1 < 5; $i++) {
        if($a[$i] == $a[$i + 1])
          $a_pair = $a[$i];
        if($b[$i] == $b[$i + 1])
          $b_pair = $b[$i];
      }
      if($a_pair < $b_pair)
        return false;
      if($a_pair > $b_pair)
        return true;

      $j = 0;
      for($i = 0; $i < 5; $i++) {
        if($a[$i] == $a_pair) continue;
        $x[$j++] = $a[$i];
      }
      $j = 0;
      for($i = 0; $i < 5; $i++) {
        if($b[$i] == $b_pair) continue;
        $y[$j++] = $b[$i];
      }
      return highCard($x, $y);
    case 3:
      for($i = 0; $i + 1 < 5; $i++) {
        if($a[$i] == $a[$i + 1])
          $ap1 = $a[$i];
        if($b[$i] == $b[$i + 1])
          $bp1 = $b[$i];
      }
      for($i = 0; $i + 1 < 5; $i++) {
        if($a[$i] != $ap1 && $a[$i] == $a[$i + 1])
          $ap2 = $a[$i];
        if($b[$i] != $bp1 && $b[$i] == $b[$i + 1])
          $bp2 = $b[$i];
      }
      if($ap1 < $bp1)
        return false;
      if($ap1 > $bp1)
        return true;
      if($ap2 < $bp2)
        return false;
      if($ap2 > $bp2)
        return true;
      for($i = 0; $i < 5; $i++) {
        if($a[$i] != $ap1 && $a[$i] != $ap2)
          $x = $a[$i];
        if($b[$i] != $bp1 && $b[$i] != $bp2)
          $y = $b[$i];
      }
      if($x < $y)
        return false;
      break;
    case 4:
      for($i = 0; $i + 2 < 5; $i++) {
        if($a[$i] == $a[$i + 1] && $a[$i] == $a[$i + 2])
          $at = $a[$i];
        if($b[$i] == $b[$i + 1] && $b[$i] == $b[$i + 2])
          $bt = $b[$i];
      }
      if($at < $bt)
        return false;
      break;
    case 7:
      for($i = 0; $i + 2 < 5; $i++) {
        if($a[$i] == $a[$i + 1] && $a[$i] == $a[$i + 2])
          $at = $a[$i];
        if($b[$i] == $b[$i + 1] && $b[$i] == $b[$i + 2])
          $bt = $b[$i];
      }
      if($at < $bt)
        return false;
      break;
    case 8:
      for($i = 0; $i + 3 < 5; $i++) {
        if($a[$i] == $a[$i + 3])
          $aq = $a[$i];
        if($b[$i] == $b[$i + 3])
          $bq = $b[$i];
      }
      if($aq < $bq)
        return false;
      break;
    default:
      return highCard($a, $b);
  }
  return true;
}

function bestHand($a) {
  // 7C5
  $b[0]  = array($a[0], $a[1], $a[2], $a[3], $a[4]);
  $b[1]  = array($a[0], $a[1], $a[2], $a[3], $a[5]);
  $b[2]  = array($a[0], $a[1], $a[2], $a[3], $a[6]);
  $b[3]  = array($a[0], $a[1], $a[2], $a[4], $a[5]);
  $b[4]  = array($a[0], $a[1], $a[2], $a[4], $a[6]);
  $b[5]  = array($a[0], $a[1], $a[2], $a[5], $a[6]);
  $b[6]  = array($a[0], $a[1], $a[3], $a[4], $a[5]);
  $b[7]  = array($a[0], $a[1], $a[3], $a[4], $a[6]);
  $b[8]  = array($a[0], $a[1], $a[3], $a[5], $a[6]);
  $b[9]  = array($a[0], $a[1], $a[4], $a[5], $a[6]);
  $b[10] = array($a[0], $a[2], $a[3], $a[4], $a[5]);
  $b[11] = array($a[0], $a[2], $a[3], $a[4], $a[6]);
  $b[12] = array($a[0], $a[2], $a[3], $a[5], $a[6]);
  $b[13] = array($a[0], $a[2], $a[4], $a[5], $a[6]);
  $b[14] = array($a[0], $a[3], $a[4], $a[5], $a[6]);
  $b[15] = array($a[1], $a[2], $a[3], $a[4], $a[5]);
  $b[16] = array($a[1], $a[2], $a[3], $a[4], $a[6]);
  $b[17] = array($a[1], $a[2], $a[3], $a[5], $a[6]);
  $b[18] = array($a[1], $a[2], $a[4], $a[5], $a[6]);
  $b[19] = array($a[1], $a[3], $a[4], $a[5], $a[6]);
  $b[20] = array($a[2], $a[3], $a[4], $a[5], $a[6]);

  for($i = 0; $i < 21; $i++)
    $c[$i] = handRank($b[$i]);

  $d = $b[0];
  $id = 0;
  for($i = 1; $i < 21; $i++) {
    if($c[$i] < $c[$id])
      continue;
    if($c[$i] == $c[$id])
      if(!better($b[$i], $d, $c[$i]))
        continue;
    $d = $b[$i];
    $id = $i;
  }
  return $d;
}

?>
