<!DOCTYPE html>
<?php
	include 'header.php';
?>


<?

$url = "https://".$region.".api.pvp.net/api/lol/".$region."/v1.4/summoner/by-name/".$username."?api_key=" . API_KEY;
$array = json_decode(request($url),true);

$arraySquared 	= $array[key($array)]; // enters the usernameArray to get info.
?>

<?php  include 'footer.php'; ?>
