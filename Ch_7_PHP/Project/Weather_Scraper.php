<?php

$weather = "";
$error = "";

if (array_key_exists('citySearch', $_GET)) {

  $city = str_replace(' ','', $_GET['citySearch']);

  $file_headers = @get_headers('http://www.weather-forecast.com/locations/'.$city.'/forecasts/latest');
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $error = "That city could not be found.";

  }else {

  $file = file_get_contents('http://www.weather-forecast.com/locations/'.$city.'/forecasts/latest');
  $pageArray = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $file);

  if (sizeof($pageArray) > 1){
  $secondPageArray = explode('</span></span></span>', $pageArray[1]);
  if (sizeof($secondPageArray) > 1) {
      $weather = $secondPageArray[0];
    } else {
      $error = "That city could not be found.";
    }
} else {
    $error = "That city could not be found.";
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
     <style type="text/css">

        .bg{
            background: url('weather.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='weather.jpg', sizingMethod='scale');
            -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='weather.jpg', sizingMethod='scale')";
        }

         .jumbotron {
              height: 100vh;
              background: transparent;
              margin: 0px;
          }

          .container {
              position: relative;
              top: 12%;
          }

          .alert {
            margin:10px;
          }

     </style>
   </head>
   <body>
      <div class="bg">
         <div class="jumbotron jumbotron-fluid">
           <div class="col-md-3"></div>
           <div class="col-md-6 container">
              <h1>What is the Weather?</h1>
              <p>Enter city name:</p>
              <div class="row">
                <div class="col-lg-6">
                  <form method="GET">
                     <div class="input-group">
                       <input type="text" id="citySearch" name="citySearch" class="form-control" placeholder="eg. Toronto, Paris" value = "<?php echo $_GET['citySearch']?>">
                       <span class="input-group-btn">
                         <button class="btn btn-primary" type="submit">Search</button>
                       </span>
                     </div>
                   </form>
                   <div id="alertMessage">
                     <?php
                        if ($weather){
                          echo '<div class="alert alert-success" role="alert"><p>'.$weather.'</p></div>';
                        } else if ($error) {
                          echo '<div class="alert alert-danger" role="alert"><p>'.$error.'</p></div>';

                        }
                      ?>
                   </div>
               </div>
             </div>
           </div>
           <div class="col-md-3"></div>
         </div>
       </div>

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

           if ($("#citySearch").val() == ""){
               error += "A city name is required.<br>";
             }

           if (error != ""){
             $("#alertMessage").html('<div class="alert alert-danger" role="alert"><p><strong>There are error(s) in your form:</strong></p>' + error + '</div>');
             return false;
           } else {
             $("form").unbind("submit").submit();
             return true;
           }

         })

     </script>

   </body>
 </html>
