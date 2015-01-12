<?php
ob_start(); // turn on output buffering
include('facebook.php');
include('twitter.php');
//include('instagram.php');
$union = array_merge($facebook, $twitter);
usort($union, "cmp");
function cmp($a, $b) {
	//TODO: strcmp says 20 < 3 i think, for example
	return -strcmp($a->date, $b->date);
}
$result = json_encode($union);
echo $result;
?>