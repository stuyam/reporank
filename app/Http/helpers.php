<?php

function numberReadable($rank){
  return number_format($rank).ordinal_suffix($rank);
}

//http://stackoverflow.com/questions/6604904/add-rd-or-th-or-st-dependant-on-number
function ordinal_suffix($num){
  $num = $num % 100; // protect against large numbers
  if($num < 11 || $num > 13){
     switch($num % 10){
      case 1: return 'st';
      case 2: return 'nd';
      case 3: return 'rd';
    }
  }
  return 'th';
}
