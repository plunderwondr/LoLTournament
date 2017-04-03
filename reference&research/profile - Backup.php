<?php
	include 'header.php';

	//this should go in a functions file

?>
	<?php  
	$region = $_POST['region'];
	$username = $_POST['summonerName'];
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
//$masteries vars
		$masteriesURL = "https://".$region.".api.pvp.net/api/lol/".$region. "/v1.4/summoner/". $summonerId ."/masteries?api_key=". API_KEY;
		$masteryArray = json_decode(request($masteriesURL),true);
		$masteryArray = $masteryArray[key($masteryArray)];
		$masteryArrayKeys = array_keys($masteryArray); 
		
		$masteryArray = $masteryArray[$masteryArrayKeys[1]];
		
		//$masteryArrayKeys =  array_keys($masteryArray);  //array keys of all the pages.
		//$numberOfMasteryPages = count($masteryArray); // offset by 1 since arrays start at 0 count starts at 1
		$maxMasteryUseable = count($masteryArray) - 1; //correct array accessible value
//$runes vars
		$runesURL     = "https://".$region.".api.pvp.net/api/lol/".$region. "/v1.4/summoner/". $summonerId ."/runes?api_key=". API_KEY;
		$runesArray   = json_decode(request($runesURL),true);
		$runesArray   = $runesArray[key($runesArray)]; //enter array
		$runesArray   = $runesArray ["pages"]; //select between summonerID and pages
		$runesArrayKeys = array_keys($runesArray);  //
		
		$maxRunesUseable = count($runesArray) - 1;
		
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
		echo $username . " has a summoner level of " . $summonerLevel;
		echo "<br/>";
		echo "With the icon code " . $profileIconId. " is this photo:";
		echo "<br/>";
		//echo "<img src=".$imgLink."alt='".$profileIconId."'></img>";
			//DISPLAY PICTURE OF USER
		echo '<img src="'.$imgLink.'" alt="'.$profileIconId.'">';
		echo "<br/>";
			//DATE LAST UPDATED 
		echo "Updated at " . $dt->format('Y-m-d H:i:s'); // output = 2017-01-01 00:00:00 (allows for modification)
		echo "<br/>";
		
		echo "<br/>";
		echo "<br/>";
		echo "Their mastery pages:";
			//MASTERY PAGE OUTPUT
		for($i = 0; $i <= $maxMasteryUseable; $i++){
			echo "<br/>&nbsp&nbsp";
			$displayMasteryPage = $masteryArray[$i];
			$pageName = $displayMasteryPage["name"];			

			echo $pageName; //output each mastery page name
		}
		echo "<br/>";
		echo "<br/>";
		echo "Their Rune pages:";		
			//RUNE PAGE OUTPUT
		for($i = 0; $i <= $maxRunesUseable; $i++){
			echo "<br/>&nbsp&nbsp";
			$displayRunePage = $runesArray[$i];
			$pageName = $displayRunePage["name"];			

			echo $pageName; //output each mastery page name
		}
		
				echo "<br/>";
		echo "<br/>";
		echo "Their champion mastery pages:";	
		for($i = 0; $i <= $maxchampionMasteryUseable; $i++){
			echo "<br/>&nbsp&nbsp";
		$championMasteryArrayed  = $championMasteryArray[$i]; //enter array
		$championNumber  = $championMasteryArrayed["championId"];
		echo $championNumber; 
		}
		
	?>
	</p>			
<?php  include 'footer.php'; ?>
