<?php
require "twitteroauth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

$consumerKey = "LBtxEoEQ0SNWYx3d98zFfbcz1";

$consumerSecret = "rafSbOCyYAq13sBd2oNUDWVm33zWG2ZAeUo3gj2QkNuNsxdYtS";

$accessToken = "619549259-mKKvD3cgC6k0x7fBlqlbE4BHSXD0FZMV8b9GnwHe";

$accessTokenSecret = "DfgorhcsnC1ErsQO8NcHIcS8uBkR47qM3YEPuZnH3jzUD";

$connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

$content = $connection->get("account/verify_credentials");

$statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);

foreach ($statuses as $tweet){

//  print_r($tweet->favorite_count);

  if ($tweet->favorite_count >= 2) {

    $status = $connection->get("statuses/oembed", ["id" => $tweet->id]);
    echo $status->html;

  }

}
?>
