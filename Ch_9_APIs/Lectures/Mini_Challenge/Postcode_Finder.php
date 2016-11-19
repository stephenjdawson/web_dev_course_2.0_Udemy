<?php

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style type="text/css">

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      h1{
        font-weight: bolder;
      }

      #map {
        height: 100%;
        width: 100%;
        position:absolute;
        top: 0;
        left: 0;
        z-index: 0;
      }

      .jumbotron {
        height: 100%;
        position: relative;
        z-index: 1;
        background: rgb(0, 0, 0);
        background: rgba(0, 0, 0, 0);
      }

       #addressInput {
        background: rgba(0, 0, 0, 0.8);
        color: rgba(223, 219, 220, 1);
      }
      .alert{
        opacity: .8;
      }

      #Message {
        margin: 15px;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-3">Postcode Finder</h1>
          <p class="lead">Input address information to find Postcode.</p>
          <form method="GET">
            <div class="form-group">
              <label for="addressInput">Enter Address</label>
              <input type="text" class="form-control " id="addressInput" name="addressInput" placeholder="eg. 301 Front St W, Toronto" value ="<?php echo $_GET["addressInput"]; ?>"></input>
            </div>
            <input type="submit" class="btn btn-primary">
          </form>
          <div id="Message"></div>
        </div>
      </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="http://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha256-/5pHDZh2fv1eZImyfiThtB5Ag4LqDjyittT7fLjdT/8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="sha384-VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script> <!--  There are integrity issues on page refresh, problem originated 13/10/2016 -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFZC_KKMWzJRerlXpXnArIqDrGywmxeus&callback=initMap" async defer></script>
    <script type="text/javascript">
      var map;
      function initMap() {
        // Create the map with no initial style specified.
        // It therefore has default styling.
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 43.6532, lng: -79.3832},
          zoom: 13,
          mapTypeControl: false,
          disableDefaultUI: true
        });

        map.setOptions({styles: styles["retro"]});

      }

      var styles = {
        retro: [
          {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
          {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
          {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
          {
            featureType: 'administrative',
            elementType: 'geometry.stroke',
            stylers: [{color: '#c9b2a6'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'geometry.stroke',
            stylers: [{color: '#dcd2be'}]
          },
          {
            featureType: 'administrative.land_parcel',
            elementType: 'labels.text.fill',
            stylers: [{color: '#ae9e90'}]
          },
          {
            featureType: 'landscape.natural',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'poi',
            elementType: 'labels.text.fill',
            stylers: [{color: '#93817c'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'geometry.fill',
            stylers: [{color: '#a5b076'}]
          },
          {
            featureType: 'poi.park',
            elementType: 'labels.text.fill',
            stylers: [{color: '#447530'}]
          },
          {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#f5f1e6'}]
          },
          {
            featureType: 'road.arterial',
            elementType: 'geometry',
            stylers: [{color: '#fdfcf8'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry',
            stylers: [{color: '#f8c967'}]
          },
          {
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [{color: '#e9bc62'}]
          },
          {
            featureType: 'road.highway.controlled_access',
            elementType: 'geometry',
            stylers: [{color: '#e98d58'}]
          },
          {
            featureType: 'road.highway.controlled_access',
            elementType: 'geometry.stroke',
            stylers: [{color: '#db8555'}]
          },
          {
            featureType: 'road.local',
            elementType: 'labels.text.fill',
            stylers: [{color: '#806b63'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'labels.text.fill',
            stylers: [{color: '#8f7d77'}]
          },
          {
            featureType: 'transit.line',
            elementType: 'labels.text.stroke',
            stylers: [{color: '#ebe3cd'}]
          },
          {
            featureType: 'transit.station',
            elementType: 'geometry',
            stylers: [{color: '#dfd2ae'}]
          },
          {
            featureType: 'water',
            elementType: 'geometry.fill',
            stylers: [{color: '#b9d3c2'}]
          },
          {
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [{color: '#92998d'}]
          }
        ],

        hiding: [
          {
            featureType: 'poi.business',
            stylers: [{visibility: 'off'}]
          },
          {
            featureType: 'transit',
            elementType: 'labels.icon',
            stylers: [{visibility: 'off'}]
          }
        ]
      };
    </script>
    <script type="text/javascript">

    var position = $("#addressInput").val();
  //  alert(position);


    $.ajax({
        url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + position + "&key=AIzaSyAulOcu_SGGhKAl_Y_H186yY-4rC841AIY",
        type: "GET",
        success: function (data){
          //  console.log(data);
          //  data.toSource();
          if (data["status"] != "OK"){
            $("#Message").html('<div class="alert alert-danger" role="alert"><p>Please input a valid address</p></p></div>');
          } else {
            $.each(data["results"][0]["address_components"], function(key, value){
              if (value["types"][0] == "postal_code"){
                      postalCode = value["short_name"];
                      var lat = data["results"][0]["geometry"]["location"]["lat"];
                      var lng = data["results"][0]["geometry"]["location"]["lng"];
                      var panPoint = new google.maps.LatLng(lat, lng);
                      map.panTo(panPoint)
                      $("#Message").html('<div class="alert alert-success" role="alert"><p>The Postal Code / Zip Code is: ' + postalCode + '</p></div>');
                    //  alert(lat);
                    //  alert(lng);
                }
            })
          }
        }
    })
    </script>
  </body>
</html>
