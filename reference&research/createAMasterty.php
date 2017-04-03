<?php
	include 'header.php';

	//this should go in a functions file

?>
	<?php  
	$url = "https://".$region.".api.pvp.net/api/lol/".$region."/v1.4/summoner/by-name/".$username."?api_key=" . API_KEY;
	
	$array = json_decode(request($url),true);
	$array = $array["data"]; // enters the usernameArray to get info.
			var_dump($array);
	?>
	</p>			
<?php  include 'footer.php'; ?>
