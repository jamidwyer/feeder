feeder
======
PHP to aggregate various social media feeds, so you can hit getsocialfeeds.php with an AJAX call (or cron) and show/save the content as you like. Currently totally does not do that, so I apologize if you ended up here for that.

When it does work, you'll need a keys.php file in this directory, like this: 

<?php
    $keys = array(
        "facebook" => "FACEBOOK KEY|FACEBOOK SECRET",
        "flickr" =>"YOUR FLICKR API KEY GOES HERE", 
        "twitter" => array(
                'oauth_access_token' => "TWITTER ACCESS TOKEN",
                'oauth_access_token_secret' => "TWITTER ACCESS TOKEN SECRET",
                'consumer_key' => "TWITTER CONSUMER KEY",
                'consumer_secret' => "TWITTER CONSUMER SECRET"
        )
    );
?>
