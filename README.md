lookzi
======
Basic geolocation and API functionality with AngularJS.
For a working app, you'll need a keys.php file in the php directory, like this: 

<?php 
    $keys = array(
        "flickr" =>"YOUR FLICKR API KEY GOES HERE", 
        "twitter" => array(
                'oauth_access_token' => "TWITTER ACCESS TOKEN",
                'oauth_access_token_secret' => "TWITTER ACCESS TOKEN SECRET",
                'consumer_key' => "TWITTER CONSUMER KEY",
                'consumer_secret' => "TWITTER CONSUMER SECRET"
        )
    );
?>

This is a gradual refactor of http://jamidwyer.com/near. You can see this code in action at: http://jamidwyer.com/geolocation_apis_angular/.
