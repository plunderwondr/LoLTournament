<?php
	include 'header.php';

	//this should go in a functions file

?>
	<?php  
	$region = $_POST['region'];
	$username = $_POST['summonerName'];
	$numberOfChamps = $_POST['noChamps'];
	$url = "https://".$region.".api.pvp.net/api/lol/".$region."/v1.4/summoner/by-name/".$username."?api_key=" . API_KEY;
	$array = json_decode(request($url),true);

	$arraySquared = $array[key($array)]; // enters the usernameArray to get info.

//$URL vars
	$summonerId     = $arraySquared["id"];
	$username 		= $arraySquared["name"];
	$summonerLevel  = $arraySquared["summonerLevel"];
	$lastUpdated    = $arraySquared["revisionDate"]; // needs date mathed
	$profileIconId  = $arraySquared["profileIconId"];
	$lastUpdated = $lastUpdated / 1000; // removed milliseconds
	$dt = new DateTime("@$lastUpdated");  // convert UNIX timestamp to PHP DateTime
	$imgLink        = "http://ddragon.leagueoflegends.com/cdn/7.2.1/img/profileicon/".$profileIconId.".png";
		
//$champMastery vars
$championMasteryURL   = "https://".$region.".api.pvp.net/championmastery/location/".$region."1/player/". $summonerId ."/champions?api_key=". API_KEY;
$championMasteryArray = json_decode(request($championMasteryURL),true);
$maxchampionMasteryUseable = count($championMasteryArray) - 1;
	//	$championMasteryArrayKeys = array_keys($championMasteryArray);  //
	//var_dump($championMasteryArray);
	?>
	<p>
	<?php
	//GENERAL INFO
		echo $username ;
		echo "<br/>";
			//DISPLAY PICTURE OF USER
		echo '<img src="'.$imgLink.'" alt="'.$profileIconId.'">';
		echo "<br/>";
			//DATE LAST UPDATED 
		echo "Last Updated:" . $dt->format('Y-m-d H:i:s'); // output = 2017-01-01 00:00:00 (allows for modification)

		echo "<br/>";
		echo "<br/>";
		echo "Champion mastery In order:";	
		if( $numberOfChamps > $maxchampionMasteryUseable)
		{  
			$numberOfChamps = $maxchampionMasteryUseable; 
		}
		 if ($numberOfChamps <= $maxchampionMasteryUseable)
		 {
			$numberOfChamps =  $numberOfChamps - 1 ; // makes useable for array index
			
			for($i = 0; $i <= $numberOfChamps; $i++){
				echo "<br/>&nbsp&nbsp";
				$championMasteryArrayed  = $championMasteryArray[$i]; //enter array
				$championNumber  = $championMasteryArrayed["championId"];
				
				$championNameFromIDURL = "https://global.api.pvp.net/api/lol/static-data/".$region."/v1.2/champion/".$championNumber. "?api_key=". API_KEY;
				$championNameSelect = json_decode(request($championNameFromIDURL),true);
				echo $championNameSelect["name"];
			
			}
		 }
	?>
	</p>			
<?php  include 'footer.php'; ?>
