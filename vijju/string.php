<?php
$str = '11fasfsdafasdsfsadf5';
//$str = '11fasfsdafas152dsfsadf12';
  echo $str."<br>";

  preg_match_all('!\d+!', $str, $matches);

  $int = filter_var($str, FILTER_SANITIZE_NUMBER_INT);
  echo count($matches)."<br>";
  echo $matches[count($matches)-1];

  echo "<pre>";
  print_r(array($int,$matches));
  echo "<pre>";

  ?>