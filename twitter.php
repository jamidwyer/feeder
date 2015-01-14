<?php
    include('keys.php');
	require_once('TwitterAPIExchange.php');
    $settings = $keys['twitter'];

	$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name=marcatcaffelli';
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
	$json = $twitter->setGetfield($getfield)
				 ->buildOauth($url, $requestMethod)
				 ->performRequest();
    $twitter = format_twitter_data($json);

    function format_twitter_data($results) {
        $json = json_decode($results);
        $array = array();

        foreach($json as $item) {
            if (!isset($item->in_reply_to_screen_name) || $item->in_reply_to_screen_name === "") {
            $result = new StdClass();
            $result->avatar = ""; 
            $result->source = "twitter";
            $result->title = ""; 
            if (isset($item->entities->media)) {
                $result->image = $item->entities->media[0]->media_url;
            }
            $result->text = $item->text;
            $result->author = $item->user->screen_name;
            $date = date_format(new DateTime($item->created_at), 'Y-m-d H:i:s');
            $result->date = $date;
            $result->url = "https://twitter.com/".$item->user->screen_name."/status/".$item->id_str;
            array_push($array, $result);
            }
        }
        return $array;
    }
?>