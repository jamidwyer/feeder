<?php
    function CURL_file_get_contents($url) {
        $open_file = curl_init();
        curl_setopt($open_file, CURLOPT_URL, $url);
        curl_setopt($open_file, CURLOPT_RETURNTRANSFER, 1);
        $return_var = curl_exec($open_file);
        curl_close($open_file);
        return $return_var;
    }
?>