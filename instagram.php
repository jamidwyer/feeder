<?php
    date_default_timezone_set('America/Los_Angeles');
    include('keys.php');
    $key = $keys['instagram'];
    $url = 'https://api.flickr.com/services/rest/?method=flickr.photos.search&api_key='.$key.'&sort=interestingness-desc&lat='.$_GET['latitude'].'&lon='.$_GET['longitude'].'&radius=10&radius_units=mi&per_page=8&format=json&nojsoncallback=1';
    $results = CURL_file_get_contents($url);
    format_instagram_data($results);

    function format_instagram_data($results) {
        $json = json_decode($results);
        $array = array();
        foreach($json->photos->photo as $item) {
            $result = new StdClass();
            $result->title = $item->title; 
            $result->source = "instagram";
            $result->image = "http://farm2.static.flickr.com/".$item->server."/".$item->id."_".$item->secret.".jpg";
            $result->text = "";
            $result->url = "http://www.flickr.com/photos/".$item->owner+"/".$item->id;
            array_push($array, $result);
        }
        $results = json_encode($array);
        $formatted=$results;
        echo $formatted;
    }
?>
