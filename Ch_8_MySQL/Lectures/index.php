<?php
//Lecture 1

//    mysqli_connect("localhost", "cl24-users-mnx", "YbKdq^U7n"); // if on same server use local host, if not change to server ip address.

// following if statement tests if connection to database was successful.
  /*  if(!mysqli_connect_error()){
        echo "Database connection successful.";
    }  else {
        echo "There was an error connecting to the database."; From lecture 1, deprecated
    } */

  /* Lecture 2 & 3

  //setting variable to database connection to refer to it later on.
  // mysqli_connect("Server address","Database name", "Database password", "Database username" )
  $link = mysqli_connect("localhost", "cl24-users-mnx", "YbKdq^U7n", "cl24-users-mnx"); // if on same server use local host, if not change to server ip address.
  // If database connection not successful, script stops.
    if (mysqli_connect_error()) {
      die ("There was an error connecting to the database");
    }

    //adding to database $query = "INSERT INTO `users` (`email`, `password`) VALUES('mia.conway@gmail.com', 'ilovestephen')";
    //updating database: BE CAREFUL WITH THIS, CAN RUIN WHOLE DATABASE WITHOUT PARTS AFTER EMAIL.
  //  $query = "UPDATE `users` SET email = 'stephen.dawson@gmail.com' WHERE id = 1 LIMIT 1";
    $query = "UPDATE `users` SET password = 'S*DHJS*DH#838' WHERE email = 'stephen.dawson@gmail.com' LIMIT 1";

    mysqli_query($link, $query);

  // language in between below quotes will be written in MySQL
    $query = "SELECT * FROM users"; //select everything from users table.

  // assign variable to msqli query to refer to query.
    if ($result = mysqli_query($link, $query)) {

          $row = mysqli_fetch_array($result);
          echo "<p>Your email is: ".$row[email]."</p>";
          echo "<p>Your password is: ".$row[password]."</p>";
    } */

    /* Lecture 4: looping through content.

    $link = mysqli_connect("localhost", "cl24-users-mnx", "YbKdq^U7n", "cl24-users-mnx");

    if (mysqli_connect_error()) {
      die ("There was an error connecting to the database");
    }

  //    $query = "SELECT * FROM `users` WHERE email LIKE '%p%' "; //or %@gmail.com, etc.

  //    $query = "SELECT * FROM `users` WHERE id >= 2";

  //    $query = "SELECT `email` FROM `users` WHERE id >= 2";

  //    $query = "SELECT `email` FROM `users` WHERE id >= 2 AND `email` LIKE '%T%'"; //letter searches are case insensitive


    $name = "Mia'Con";

    $query = "SELECT `email` FROM `users` WHERE `name` = '".mysqli_real_escape_string($link, $name)."'";




      if ($result = mysqli_query($link, $query)) {

        while ($row = mysqli_fetch_array($result)){
            print_r($row);
      }
    } */
/*
    // Lecture 4_Mini_Challenge & lecture 5
      //lecture 5 component

      session_start();

      echo $_SESSION['username'];

      //lecture 4 component
    $link = mysqli_connect("localhost", "cl24-users-mnx", "YbKdq^U7n", "cl24-users-mnx");

    if (mysqli_connect_error()) {
      die ("There was an error connecting to the database");
    }

    if(array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)){

        if($_POST['email'] == ''){
          echo "<p>Email address is required</p>";
        } else if ($_POST['password'] == ''){
          echo "<p>Password is required</p>";
        } else {
          $query ="SELECT `id` FROM `users` WHERE email ='".mysqli_real_escape_string($link, $_POST['email'])."'";
          $result = mysqli_query($link, $query);
          if (mysqli_num_rows($result) > 0) {
        //lecture 4    echo "<p>That email address has already been taken</p>";
              $_SESSION['email'] = $_POST['email'];
              header("Location: session.php"); //added to database, added to session variable, redirected to new page.
          } else {
            $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";
            if (mysqli_query($link, $query)){
              echo "<p>You have been signed up</p>";
            } else {
              echo "<p>There was a problem signing up - please try again later.</p>";
            }
          }
        }

    }
*/

/*Lecture 6_Cookies

  //  setcookie("customerId", "1234", time() + 60*60*24); //returns current time on server in seconds, and add to that how much time want to last. (60s*60 (seconds in an hour) * 24 hrs.) cookie that lasts a year example: time + 60*60*24*365

    setcookie("customerId", "", time() - 60 * 60); //unset a cookie by setting to them to the past. an hour is usally good. cookie will only be deleted on next page reload.

  //  $_COOKIE["customerId"] = "test";

    echo $_COOKIE["customerId"];
*/

//Lecture 7_Storing passwords securely. hashing a string, or encrypting it.

//  $salt = "sadfglkj2345lkjsdf43lkj"; // using salt, turning below password into a stronger one. still possible for hacker to get a hold of salt.

//  echo  md5($salt."password"); //md5 function does a one way encryption on string, given same string, it is same output everytime. easily hacked for simple passwords.

  $row['id'] = 73;

  echo md5(md5($row['id']), "password"); //creating a unique salt. Hash does not need to be stored. Must use a static variable per user for salt function.

  // In php 5.5, new function called password_hash() was introduced, which works in the same way as the md5 function but is more secure. It also doesn't require a hash. It's pretty similar to md5 in how it works, and you can use it like this:


/*Generate a hash of the password "mypassword"

$hash = password_hash("mypassword", PASSWORD_DEFAULT);

// Echoing it out, so we can see it:
echo $hash;

// Some line breaks for a cleaner output:
echo "<br><br>";

// Using password_verify() to check if "mypassword" matches the hash.
// Try changing "mypassword" below to something else and then refresh the page.
if (password_verify('mypassword', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
} */


?>
<!-- Lecture 4 and 5
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign Up</title>
</head>
<body>
  <h3>Sign Up</h3>
  <form method="POST">
    <input type="text" id="email" name="email" placeholder="Enter Email">
    <input type="password" id="password" name="password" placeholder="Enter Password">
    <input type = "submit" value = "Sign Up">
  </form>

</body>
</html>
-->
