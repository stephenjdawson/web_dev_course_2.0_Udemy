<?php

      $error = "";
      $successMessage = "";

      if ($_POST) {

        if (!$_POST["email"]) {
          $error .= "An email address is required.<br>";
        }

        if (!$_POST["subject"]) {
          $error .= "A subject is required.<br>";
        }

        if (!$_POST["message"]) {
          $error .= "A message is required.<br>";
        }

        if ($_POST["email"] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
            $error .= "The email address is invalid.<br>";
        }

        if ($error != "") {
          $error = '<div class="alert alert-danger" role="alert"><p>There are error(s) in your form:</p>' . $error . '</div>';
        } else {
          $emailTo = "me@mydomain.com";
          $subject = $_POST["subject"];
          $content = $_POST["message"];
          $headers = "From: ".$_POST["email"];

        if(mail($emailTo, $subject, $content, $headers)){
            $successMessage = '<div class="alert alert-success" role="alert">Your message  has been sent, we\'ll get back to you ASAP!</div>';
        } else {
            $error = '<div class="alert alert-danger" role="alert">Your message couldn\'t be sent, please try again later</div>';
        }
      }

    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/css/bootstrap.min.css"
    integrity="sha384-MIwDKRSSImVFAZCVLtU0LMDdON6KVCrZHyVQQj6e8wIEJkW4tvwqXrbMIya1vriY"
    crossorigin="anonymous">

  </head>
  <body>
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <h1>Get in touch!</h1>


    <div id="error"><? echo $error.$successMessage; ?></div>

    <form method="POST">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" id="subject" name="subject" placeholder="Example input">
      </div>
      <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<div class="col-md-2"></div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"
    integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY"
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js"
    integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB"
    crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.3/js/bootstrap.min.js"
    integrity="sha384-ux8v3A6CPtOTqOzMKiuo3d/DomGaaClxFYdCu2HPMBEkf6x2xiDyJ7gkXU0MWwaD"
    crossorigin="anonymous"></script>
    <script type="text/javascript">
      $("form").submit(function (e) {

        var error = "";

        if ($("#email").val() == ""){
            error += "The email field is required.<br>";
          }

        if ($("#subject").val() == ""){
            error += "The subject field is required.<br>";
          }

        if ($("#message").val() == ""){
              error += "The message field is required.<br>";
          }

        if (error != ""){
          $("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There are error(s) in your form:</strong></p>' + error + '</div>');
          return false;
        } else {
          $("form").unbind("submit").submit();
          return true;
        }

      })
    </script>


  </body>
</html>
