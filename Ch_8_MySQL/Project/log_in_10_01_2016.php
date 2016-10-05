<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
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

    if (array_key_exists("logout", $_GET)) {

      //  unset($_SESSION);
        session_destroy();
        unset($_SESSION);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";

    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {

        header("Location: diary_page.php");

    }

    if (array_key_exists("submit", $_POST)) {

        $link = mysqli_connect("localhost", "cl24-users-mnx", "YbKdq^U7n", "cl24-users-mnx");;

        if (mysqli_connect_error()) {

            die ("Database Connection Error");

        }



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

<div id="error"><?php echo $error; ?></div>

<form method="post">

    <input type="email" name="email" placeholder="Your Email">

    <input type="password" name="password" placeholder="Password">

    <input type="checkbox" name="stayLoggedIn" value=1>

    <input type="hidden" name="signUp" value="1">

    <input type="submit" name="submit" value="Sign Up!">

</form>

<form method="post">

    <input type="email" name="email" placeholder="Your Email">

    <input type="password" name="password" placeholder="Password">

    <input type="checkbox" name="stayLoggedIn" value=1>

    <input type="hidden" name="signUp" value="0">

    <input type="submit" name="submit" value="Log In!">

</form>
