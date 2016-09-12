<?php

$user = "Stephen";
if ($user == "Stephen") {
  echo "Hello Stephen!";
} else {
  echo "I don't know you!";
}

echo "<br></br>";

$age = 25;
if ($age >= 18 && $user == "Stephen") {
  echo "Proceed";
} else {
  echo "Not today junior!";
}

?>
