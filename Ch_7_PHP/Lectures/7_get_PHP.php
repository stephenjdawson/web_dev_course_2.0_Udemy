<?php
/* part 1: URL GET: http://79.170.44.102/completewebdeveloper-sjd.com/Content/Ch_7_PHP/Lectures/7_get_PHP.php/?name=rob&password=1234&gender=male
    print_r($_GET);
    echo $_GET["gender"];
  */

/* part 2
//  print_r($_GET);
echo "Hi there ".$_GET['name']."!";
*/

/* part 3: mini challenge prime number checker */
if($_GET['number'] > 0 && ctype_digit($_GET['number']) == true){

      if($_GET['number'] == 1 || $_GET['number'] == 2 || $_GET['number'] == 3){
        $primality = true;
        echo "Your number: ".$_GET['number'].", is a prime number: ".$primality;
        }

        $i = 2;

        $isPrime = true;

        while ($i < $_GET['number']) {

            if ($_GET['number'] % $i == 0) {

                // Number is not prime!

                $isPrime = false;

            }

            $i++;

        }

        if ($isPrime) {

            echo "<p>".$i." is a prime number!</p>";

        } else {

            echo "<p>".$i." is not prime.</p>";

        }

    } else if ($_GET) {

        // User has submitted something which is not a positive whole number

        echo "<p>Please enter a positive whole number.</p>";

    }




}else{
  echo "Please input a positive integer.";
}


?>

<!-- part 2
<p>What's your name?</p>

<form>
  <input name="name" type="text">
  <input type="submit" value="Go!">
</form>
-->

<!-- Part 3: -->
<p>Input a number to check primality.</p>

<form>
  <input name="number" type="number">
  <input type="submit" value="Check">
</form>
