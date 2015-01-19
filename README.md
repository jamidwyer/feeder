feeder
======
PHP to aggregate various social media feeds, so you can hit getsocial.php with an AJAX call (or cron) and show/save the content as you like. Currently only gets Facebook, Twitter, and an RSS feed. You'll want to to swap out various hard-coded feed variables.

When it does work, you'll need a keys.php file in this directory, like this: 

<?php
    $keys = array(
        "facebook" => "FACEBOOK KEY|FACEBOOK SECRET",
        "twitter" => array(
                'oauth_access_token' => "TWITTER ACCESS TOKEN",
                'oauth_access_token_secret' => "TWITTER ACCESS TOKEN SECRET",
                'consumer_key' => "TWITTER CONSUMER KEY",
                'consumer_secret' => "TWITTER CONSUMER SECRET"
        )
    );
?>


To consume this data with jQuery, you can do something like:
function fetchSocial() {
    $.ajax({
      url: "../php/feeder/getsocial.php",
      context: document.body
    }).done(function(data) {
        var json = JSON.parse(data);
    });
}

