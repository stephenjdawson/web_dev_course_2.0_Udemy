<?php



  if ($_POST) {

      $userArray = array("Mia", "Stephen", "Andrew", "Eddy", "Maria", "Steve");
      $isKnown = false;
      foreach ($userArray as $value) {
        if ($value == $_POST['name']){
          $isKnown = true;
        }
      }
      if ($isKnown) {
        echo "Hello ".$_POST['name']."!";
      } else {
        echo "Unknown username.";
      }
  }

?>
<p>What is your name?</p>

<form method="post">
  <input name="name" type="text">
  <input type="submit" value="Submit">
</form>
