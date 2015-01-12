<?php
    include('keys.php');
    include('utils.php');
    $key = $keys['facebook'];
    $url = 'https://graph.facebook.com/caffelli/posts?key=value&access_token='.$key;
    $results = CURL_file_get_contents($url);
    format_data($results);

    function format_data($results) {
        $json = json_decode($results);
        $array = array();
        foreach($json->data as $item) {
            if (isset($item->message) && isset($item->picture)) {
                $result = new StdClass();
                $result->text = $item->message; 
                $result->image = $item->picture;
                $result->date = $item->created_time;
                $result->author = $item->from->name;
                array_push($array, $result);
            }
        }
        $results = json_encode($array);
        $formatted=$results;
        echo $formatted;
    }
?>
