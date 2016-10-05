<?php

  session_start();

  if (array_key_exists("id", $_COOKIE)) {

      $_SESSION['id'] = $_COOKIE['id'];
  }

  if (array_key_exists("id", $_SESSION)) {

      echo "<p>Logged In! <a href='log_out.php'>Log out</a></p>";
    /*  echo "session:<br>";
      print_r($_SESSION);
      echo "<br>cookie:<br>";
      print_r($_COOKIE); */
  } else {

      header("Location: log_in.php");

  }


?>
<br><p>THIS IS SOME TEXT</p>
