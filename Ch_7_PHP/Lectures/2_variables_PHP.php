<?php

$name = "Stephen";
echo $name;
echo "<p> or my name is $name</p>";

$string1 = "<p> This is the first part";
$string2 = "of a sentence</p>";
echo $string1." ".$string2;

$myNumber = 45;
$calculation = $myNumber *31 /97 + 4;
echo $calculation." PHP is not picky about number types in variables";

$myBool = true;
echo "<p>This statement is true?".$myBool." :returns 1 or 0 for true and false</p>";

$variableName = "name";
echo $$variableName;

?>
