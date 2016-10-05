<?php
session_start();

$error = "";

function emailValidate(){
  if ($_POST['email'] != ''){
  $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return true;
    } else {
      return false;
    }
  }
}

if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {

    header("Location: diary_page.php");

}

if (array_key_exists("submit", $_POST)) {

    require 'connection.php';

    if (!$_POST['email']) {

        $error .= "An email address is required<br>";

    } else if (emailValidate() == true){
        $error .= "Invalid Email<br>";
    }

    if (!$_POST['password']) {

        $error .= "A password is required<br>";

    }

    if ($error != "") {

        $error = "<p>There were error(s) in your form:</p>".$error;

    } else {

        if ($_POST['signUp'] == '1') {

            $query = "SELECT id FROM `secret_diary_users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

            $result = mysqli_query($link, $query);

            if (mysqli_num_rows($result) > 0) {

                $error = "That email address is taken.";

            } else {

              $query = "INSERT INTO `secret_diary_users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, password_hash($_POST['password'], PASSWORD_BCRYPT))."')";

                if (mysqli_query($link, $query)) {

                  $_SESSION['id'] = mysqli_insert_id($link);

                  if ($_POST['stayLoggedIn'] == '1') {

                      setcookie("id", mysqli_insert_id($link), time() + 60*60*24*365);

                  }

                  header("Location: diary_page.php");


                } else {

                  $error = "<p>Could not sign you up - please try again later.</p>";

                }

            }

        } else {

                $query ="SELECT `id`,`password` FROM `secret_diary_users` WHERE email ='".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

                $result = mysqli_query($link, $query);

                $row = mysqli_fetch_array($result);

                if (isset($row)) {

                    if(password_verify($_POST['password'], $row['password'])){

                        $_SESSION['id'] = $row['id'];

                        if ($_POST['stayLoggedIn'] == '1') {

                            setcookie("id", $row['id'], time() + 60*60*24*365);

                        }

                        header("Location: diary_page.php");

                    } else {

                        $error = "That email/password combination could not be found.";

                    }

                } else {

                    $error = "That email/password combination could not be found.";

                }

            }

    }


}
?>

<?php include "header.php"; ?>

     <div class="bg">
        <div class="jumbotron jumbotron-fluid">
          <div class="col-sm-4"></div>
          <div class="col-sm-4 container">
             <h1>Secret Diary</h1>
             <p>What is on your mind?</p>
             <div class="row">
                 <form method="POST">
                   <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Your Email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                   </div>
                   <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                   </div>
                   <div class="form-check">
                       <label class="form-check-label">
                         <input type="checkbox" id="checkbox" class="form-check-input" name="stayLoggedIn" value=1>
                         Stay Logged In
                       </label>
                   </div>
                   <input type="hidden" name="signUp" value="0">
                   <input type="submit" name="submit" class="btn btn-primary" value="Log In">
                   <p><a href="" id="switchSignUp">Sign Up</a></p>
                </form>
                <div id="error">
                  <?php
                     if ($error) {
                       echo '<div class="alert alert-danger" role="alert"><p>'.$error.'</p></div>';
                     }
                   ?>
                </div>
            </div>
          </div>
          <div class="col-sm-4"></div>
        </div>
      </div>

      <?php include "footer.php"; ?>
