<?php
/*part 1  $i = 0;
  while ($i < 10){
    echo $i."<br>";
    $i++;
  } */

/* part 2: display first 10 items of 5 times table
  $i = 1;
  $a = 5;
  while ($i <= 10){
  echo  $i*$a."<br>";
  $i++;
  }
  */

  /* part 3, create an array with 4 items, and display each item. Lecture method

  $myFamily = array("Andrew","Stephen","Edward","Steve","Maria");
  $i = 0;
  while($i <= sizeof($myFamily)){
    echo $myFamily."<br>";
    $i++;
  }
  */
  /*Using $key and $val of array, reset array required to loop through again. */
  $myArray=array("Andrew","Stephen","Edward","Steve","Maria");
while (list ($key, $val) = each ($myArray) ) echo $val."<br>";
reset($myArray);
while (list ($key, $val) = each ($myArray) ) echo $val."<br>";
?>
