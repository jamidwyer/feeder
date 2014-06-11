<?php
    include('keys.php');
	require_once('TwitterAPIExchange.php');
    $settings = $keys['twitter'];

	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$getfield = '?geocode=45.4962399,-122.60985289999999,100km';
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
	$json = $twitter->setGetfield($getfield)
				 ->buildOauth($url, $requestMethod)
				 ->performRequest();
    format_data($json);

    function format_data($results) {
        $json = json_decode($results);
        $array = array();
        foreach($json->statuses as $item) {
            $result = new StdClass();
            $result->avatar = ""; 
            $result->title = ""; 
            if (isset($item->entities->media)) {
                $result->image = $item->entities->media[0]->media_url;
            }
            $result->text = $item->text;
            $result->url = "https://twitter.com/".$item->user->screen_name."/status/".$item->id_str;
            array_push($array, $result);
        }
        $results = json_encode($array);
        $formatted=$results;
        echo $formatted;
    }
?>