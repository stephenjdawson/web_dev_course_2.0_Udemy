<?php

$myArray = array("Rob", "Kirsten", "Tommy", "Ralphie");
print_r($myArray);

echo "<br></br>";

echo $myArray[1];

echo "<br></br>";

$anotherArray[0] = "pizza";
$anotherArray[1] = "yogurt";
$anotherArray[5] = "coffee";
$anotherArray["myFavoriteFood"] = "ice cream";
print_r($anotherArray);

echo "<br></br>";

$thirdArray = array(
  "France" => "French",
   "USA" => "English",
    "Germany" => "German");
print_r($thirdArray);
echo "this array has ".sizeof($thirdArray)." units";

echo "<br></br>";

$myArray[] = "Katie";
print_r($myArray);

echo "<br></br>";

unset($thirdArray["France"]);
print_r($thirdArray);
echo "this array has ".sizeof($thirdArray)." units";


?>
