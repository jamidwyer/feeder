<?php
    date_default_timezone_set('America/Los_Angeles');
	$feed = implode(file('http://caffelli.com/rss.xml'));
    $search = array('&ldquo;', '&rdquo;', '“', '”', '’', '—');
    $replace = array('"', '"', '"', '"', '\'', '--');
    $feed = str_replace($search, $replace, $feed);
	$xml = simplexml_load_string($feed);
	$json = json_encode($xml);
	$array = json_decode($json, TRUE);
    $blog = format_rss_data($array);

    function format_rss_data($results) {
        $array = array();
        foreach($results['channel']['item'] as $item) {
            if (isset($item['description'])) {
                $result = new StdClass();
                $result->title = $item['title'];
                $result->link = $item['link'];
                $result->text = $item['description'];
				$p1start = strpos($result->text, '<p>');
				$p2start = strpos($result->text, '<p>', $p1start+4);
                $p3start = strpos($result->text, '<p>', $p2start+4);
				$p3end = strpos($result->text, '</p>', $p3start);
				$paragraph = substr($result->text, $p1start, $p3end-$p1start+4);
				$result->text = utf8_encode($paragraph);
                $result->source = "blog";
                $date = date_format(new DateTime($item['pubDate']), 'Y-m-d H:i:s');
                $result->date = $date;
                array_push($array, $result);
            }
        }
        return $array;
    }

?>