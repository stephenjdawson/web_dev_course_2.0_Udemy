<?php

  session_start();

  $logOut = "";

  $content = "";

  if (array_key_exists("id", $_COOKIE)) {

      $_SESSION['id'] = $_COOKIE['id'];
  }

  if (array_key_exists("id", $_SESSION)) {

      $logOut = "<a href='secret_diary_log_out.php'><button class='btn btn-primary'>Log out</button></a>";
      require('connection.php');
      $query = "SELECT `diary` FROM `secret_diary_users` WHERE id = ".mysqli_real_escape_string($link, $_SESSION['id'])." LIMIT 1";
      $row = mysqli_fetch_array(mysqli_query($link, $query));
      $content = $row['diary'];
    /*  echo "session:<br>";
      print_r($_SESSION);
      echo "<br>cookie:<br>";
      print_r($_COOKIE); */
  } else {

      header("Location: secret_diary_login.php");

  }


?>
<?php include "header.php"; ?>

     <div class="bg">
       <nav class="navbar navbar-dark bg-inverse">
          <h1 class="navbar-brand">Secret Diary</h1>
          <ul class="nav navbar-nav">
            <li class="nav-item" id="logOut">
              <?php echo $logOut; ?>
            </li>
          </ul>
      </nav>
        <div class="jumbotron jumbotron-fluid">
          <div class="col-xl-1"></div>
          <div class="col-xl-10 container-fluid">
            <div class="form-group">
              <textarea class="form-control" rows="29" id="diary_content" name="diary_content"><?php echo $content ?></textarea>
            </div>
          </div>
          <div class="col-xl-1"></div>
        </div>
      </div>

<?php include "footer.php"; ?>
