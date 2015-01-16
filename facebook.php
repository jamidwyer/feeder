<?php
    date_default_timezone_set('America/Los_Angeles');
    include('keys.php');
    include('utils.php');
    $key = $keys['facebook'];
    $url = 'https://graph.facebook.com/caffelli/posts?key=value&access_token='.$key;
    $results = CURL_file_get_contents($url);
    $facebook = format_data($results);

    function format_data($results) {
        $json = json_decode($results);
        $array = array();
        foreach($json->data as $item) {
            if (isset($item->message) && isset($item->picture)) {
                $result = new StdClass();
                $result->text = $item->message; 
                $result->image = $item->picture;
                $imagebits = explode("url=", $item->picture);
                if (isset($imagebits[1])) {
                    $result->image = urldecode($imagebits[1]);
                }
                $result->source = "facebook";
                $date = date_format(new DateTime($item->created_time), 'Y-m-d H:i:s');
                $result->date = $date;
                $result->author = $item->from->name;
                array_push($array, $result);
            }
        }
        return $array;
    }
?>
