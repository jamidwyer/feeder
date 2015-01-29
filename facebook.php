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
                $explodeb = explode("_b.jpg", $item->picture);
                if (isset($imagebits[1])) {
                    $result->image = urldecode($imagebits[1]);
                }
                else {
                    $bits  = explode("/", $result->image);
                    $moarbits = explode("_", $bits[count($bits)-1]);
                    $id = $moarbits[1];
                    $isweird = count($moarbits);
                    if ($isweird <= 9) {
                        $result->image = "http://graph.facebook.com/".$id."/picture";
                    }
                }
                $result->source = "facebook";
                $date = date_format(new DateTime($item->created_time), 'Y-m-d H:i:s');
                $result->date = $date;
                $result->author = $item->from->name;
                $result->link = $item->link;
                array_push($array, $result);
            }
        }
        return $array;
    }
?>
