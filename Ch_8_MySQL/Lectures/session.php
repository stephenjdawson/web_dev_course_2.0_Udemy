<?php

    session_start();

      if($_SESSION['email']) {
        echo "You have successfully logged in";
      } else {
        header("Location: index.php");
      }

?>
