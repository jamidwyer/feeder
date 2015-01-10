feeder
======
Start on grabbing various social media feeds by username with JS and PHP. Currently totally does not do that, so I apologize if you ended up here for that.

When it does work, you'll need a keys.php file in the php directory, like this: 

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
