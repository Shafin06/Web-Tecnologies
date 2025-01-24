<?php

$x = "hello world";

$bookname1 = str_replace(' ', '', $x);

$svalue = "nice time at lunch";

if(setcookie($bookname1, $svalue, time()+ 5)){
  echo "Cookie set";
}

echo $_COOKIE[$bookname1];
?>