<?php

    $emailTo = "stephen.dawson@uoit.net";
    $subject = "I hope this works";
    $body = "You are sexy!";
    $headers = "From: stephen.dawson@uoit.net";
    if (mail($emailTo, $subject, $body, $headers)){
      echo "The email was sent succesfully";
    } else {
      echo "Email could not be sent.";
    }
// downside about above email is spam, google send php email without it going to spam. Also look at service called Mandrill or mail Chimp.
//The above method is perfectly reasonable for contact form.  
?>
