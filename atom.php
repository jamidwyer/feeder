<?php
date_default_timezone_set('America/Los_Angeles');
$feed = new DOMDocument();
    $feed->load('http://ghost.dev2.caffelli.com/tag/blog/rss/');
    $json = array();
    $json['title'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
    $json['description'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
    $items = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('item');

    $json['item'] = array();
    $i = 0;

    foreach($items as $key => $item) {
        $link = $item->getElementsByTagName('link')->item(0)->firstChild->nodeValue;
        $title = $item->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
        $description = $item->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
        $pubDate = $item->getElementsByTagName('pubDate')->item(0)->firstChild->nodeValue;
//        $guid = $item->getElementsByTagName('guid')->item(0)->firstChild->nodeValue;

        $json['item'][$key]['link'] = $link;
        $json['item'][$key]['title'] = $title;
        $json['item'][$key]['description'] = $description;
        $json['item'][$key]['pubdate'] = $pubDate;
     //   $json['item'][$key]['guid'] = $guid; 
    }



    $blog = format_rss_data($json);
//    echo json_encode($blog);

    function format_rss_data($results) {
        $array = array();
        foreach($results['item'] as $item) {
            if (isset($item['description'])) {
                $result = new StdClass();
                $result->title = $item['title'];
                $result->link = $item['link'];
                $result->text = $item['description'];

				$p1start = strpos($result->text, '<p>');
				$p2start = strpos($result->text, '<p>', $p1start+4);
				$p2end = strpos($result->text, '</p>', $p2start);
				$paragraph = substr($result->text, $p1start, $p2end-$p1start+4);
                $search = array('&ldquo;', '&rdquo;', '“', '”', '’', '—', '—');
                $replace = array('"', '"', '"', '"', '\'', '--', '');
                $paragraph = str_replace($search, $replace, $paragraph);
                $imgstart = strpos($result->text, '<img src="')+10;
                $imgend = strpos($result->text, '.jpg', $imgstart+10)+4;
/*                $result->image = substr($result->text, $imgstart, $imgend-$imgstart);
                //or maybe it's a png. this is probably faster the preg_match for both in one shot.
                if ($result->image === "") {
                    $imgstart = strpos($result->text, '<img src="')+10;
                    $imgend = strpos($result->text, '.png', $imgstart+10)+4;
                    $result->image = substr($result->text, $imgstart, $imgend-$imgstart);
                }*/
                $paragraph = preg_replace("/<img[^>]+\>/i", "", $paragraph); 
    			$result->text = utf8_encode($paragraph);
                $result->source = "blog";
                $date = date_format(new DateTime($item['pubdate']), 'Y-m-d H:i:s');
                $result->date = $date;
                array_push($array, $result);
            }
        }
        return $array;
    }
?>