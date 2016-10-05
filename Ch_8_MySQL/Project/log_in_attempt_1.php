<?php
// NOTE ALTERNATE METHOD USING HIDDEN INPUT IN 8.9.php

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

$error = "";

if (array_key_exists("logout", $_GET)) {

       unset($_SESSION);
       setcookie("id", null, time() - 60*60*24);
       setcookie("PHPSESSID", null, time() - 60*60*24, '/');
       $_COOKIE["id"] = "";

} else if ((array_key_exists("id", $_SESSION) && $_SESSION["id"]) || (array_key_exists("id", $_COOKIE) && $_COOKIE["id"])) {

       header("Location: diary_page.php");

  }

     $link = mysqli_connect("localhost", "cl24-users-mnx", "YbKdq^U7n", "cl24-users-mnx");

     if (mysqli_connect_error()) {
       die ("There was an error connecting to the database");
     }

function emailValidate(){
  if ($_POST['signUpEmail'] != ''){
  $email = $_POST['signUpEmail'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return true;
    } else {
      return false;
    }
  } else if ($_POST['logInEmail'] != ''){
    $email = $_POST['logInEmail'];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
      return false;
    }
  }
}

  if (array_key_exists('submitSignUp', $_POST)){

    if($_POST['signUpEmail'] == ''){
      $error .= "Email address is required<br>";
    } else if (emailValidate() == true){
        $error .= "Invalid Email<br>";
    }

    if ($_POST['signUpPassword'] == ''){
      $error .= "Password is required<br>";
    }

    if ($error != ""){
      $error = "<p>You have the following error(s):<br>".$error;
    } else {
      $query ="SELECT `id` FROM `secret_diary_users` WHERE email ='".mysqli_real_escape_string($link, $_POST['signUpEmail'])."' LIMIT 1";
      $result = mysqli_query($link, $query);
      if (mysqli_num_rows($result) > 0) {
          $error = "<p>That email address has already been taken</p>";
      } else {
        $query = "INSERT INTO `secret_diary_users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['signUpEmail'])."', '".mysqli_real_escape_string($link, password_hash($_POST['signUpPassword'], PASSWORD_BCRYPT))."')";

          if (mysqli_query($link, $query)){

            $error = "<p>You have been signed up</p>";

            $_SESSION['id'] = mysqli_insert_id($link);

                      if ($_POST['stayLoggedIn'] == '1') {

                          setcookie("id", mysqli_insert_id($link), time() + 60*60*24*7, '/');

                      }

                      header("Location: diary_page.php");

          } else {
            $error = "<p>There was a problem signing up - please try again later.</p>";
          }
      }
    }
  }

  if(array_key_exists('submitLogIn', $_POST)){

    if($_POST['logInEmail'] == ''){
      $error .= "Email address is required<br>";
    } else if (emailValidate() == true){
      $error .= "Invalid Email<br>";
    }

    if ($_POST['logInPassword'] == ''){
      $error .= "Password is required<br>";
    }

    if ($error != ""){
      $error = "<p>You have the following error(s):<br>".$error;
    } else {
      $query ="SELECT `id` FROM `secret_diary_users` WHERE `email` ='".mysqli_real_escape_string($link, $_POST['logInEmail'])."' LIMIT 1";
      $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
          $query ="SELECT * FROM `secret_diary_users` WHERE `email` ='".mysqli_real_escape_string($link, $_POST['logInEmail'])."' LIMIT 1";
          $result = mysqli_query($link, $query);
          $userInfo = mysqli_fetch_array($result);
            if(password_verify($_POST['logInPassword'], $userInfo['password'])){

              $error = "logged in";

              $_SESSION['id'] = $userInfo['id'];
          //    print_r($_SESSION['id']);

                        if ($_POST['stayLoggedIn'] == '1') {

                            setcookie("id", $userInfo['id'], time() + 60*60*24*7);

                        }
                            header("Location: diary_page.php");

              } else {
                  $error = "<p>Incorrect password</p>";
              }
        } else {
          $error = "<p>There was a problem logging in - please try again later.</p>";
        }
      // select row with email, if email does not exist, echo Sign up. if exists compare passwords, if passwords same, log in, if not echo incorrect password.
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log in/Sign up</title>
  <style type="text/css">
    #signUpForm {
      display: inline;
    }

    #logInForm {
      display: inline;
    }
  </style>
</head>
<body>
  <div id="error"><?php echo $error; ?></div>
  <h3>Log in/Sign up</h3>
  <form method="POST">
    <fieldset id = "signUpForm">
      <legend>Sign Up:</legend>
      <input type="email" id="signUpEmail" name="signUpEmail" placeholder="Enter Email" autocomplete="off">
      <input type="password" id="signUpPassword" name="signUpPassword" placeholder="Enter Password" autocomplete="off">
      <input type = "checkbox" name = "stayLoggedIn" checked="true" value = '1'>
      <input type="hidden" name="signUp" value = "1">
      <input type = "submit" name="submitSignUp" value = "Sign Up!">
    </fieldset>
  </form>

  <form method="POST">
    <fieldset id = "logInForm">
      <legend>Log In:</legend>
      <input type="email" id="logInEmail" name="logInEmail" placeholder="Enter Email">
      <input type="password" id="logInPassword" name="logInPassword" placeholder="Enter Password">
      <input type = "checkbox" name = "stayLoggedIn" checked ="true" value = '1'>
      <input type="hidden" name="signUp" value = "0">
      <input type = "submit" name = "submitLogIn" value = "Log In!">
    </fieldset>
  </form>
</body>
</html>
