<html>
	<body>
		<?php
		//CONSTANTS NEEDED
//besides username, the array indexs are constants

// Constants in this file:
// "summonerLevel"
// "name"    (this is the case appropriate version)
// "profileIconId"
//"revisionDate"   // cast as float 
		
		//REGIONS
	//summoner-v1.4 [BR, EUNE, EUW, JP, KR, LAN, LAS, NA, OCE, RU, TR]
	
		
		
		
//own profile api link
//https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/plunderwondr?api_key=6689f18c-f8d0-4ff2-b548-ff51b59e3b78
//mastery
//https://na.api.pvp.net/api/lol/na/v1.4/summoner/PLUNDERWONDR/masteries?api_key=6689f18c-f8d0-4ff2-b548-ff51b59e3b78

/////////// HEADER INCLUDES 
        require './includes/constants.php';
     //  require './includes/db.php';
     //  require './includes/functions.php';
     //  require './includes/prepare.php';
///////////








function request($url){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//BYPASS SSL, Production/debug constant should be used in project (value of 2 for production)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$statuscode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);


//200 for success
//4xx invalid client request
//5xx server errors
 if($statuscode==200){ //if succeeds return the resultant json
	return $result;
 }
 else if($statuscode==500){ // possible server error
	echo "Server could not handle request, ERROR ".$statuscode."<br>";
	return false;
 }
 else if($statuscode==503){ // possible server down
	echo "Server may be currently unavailable, ERROR ".$statuscode."<br>";
	return false;
 }
 else { //actual input error problems. See reference document: https://developer.riotgames.com/docs/response-codes 
	echo "HTTP ERROR ".$statuscode."<br>";
	return "false";
 }
}


$region= "na";
$url = "https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/Plunderwondr?api_key=6689f18c-f8d0-4ff2-b548-ff51b59e3b78";

		//echo request($url);
		$array = json_decode(request($url),true);
		
		//var_dump($array);

		$arraySquared = $array[key($array)]; // enters the usernameArray to get info.



//$URL vars
$summonerId     = $arraySquared["id"];
$username 		= $arraySquared["name"];
$summonerLevel  = $arraySquared["summonerLevel"];
$lastUpdated    = $arraySquared["revisionDate"]; // needs date mathed
$profileIconId  = $arraySquared["profileIconId"];
$lastUpdated = $lastUpdated / 1000; // removed milliseconds
$dt = new DateTime("@$lastUpdated");  // convert UNIX timestamp to PHP DateTime

//$masteries vars
$masteriesURL = "https://na.api.pvp.net/api/lol/".$region. "/v1.4/summoner/". $summonerId ."/masteries?api_key=6689f18c-f8d0-4ff2-b548-ff51b59e3b78";
		$masteryArray = json_decode(request($masteriesURL),true);
		$masteryArray = $masteryArray[key($masteryArray)];
		$masteryArrayKeys = array_keys($masteryArray); 
		
		$masteryArray = $masteryArray[$masteryArrayKeys[1]];
		
		//$masteryArrayKeys =  array_keys($masteryArray);  //array keys of all the pages.
		//$numberOfMasteryPages = count($masteryArray); // offset by 1 since arrays start at 0 count starts at 1
		$maxMasteryUseable = count($masteryArray) - 1; //correct array accessible value


	?>
<p>
  <br/>
		<?php

		?>
	<?php 
		echo "The database pulled user: " .  $username . "!";
		echo "<br/>";
		echo $username . " has a summoner level of " . $summonerLevel;
		echo "<br/>";
		echo "With the icon code: " . $profileIconId;
		echo "<br/>";
		echo "Last updated at: ". $lastUpdated . " epoch seconds.";
		echo "<br/>";

		echo $dt->format('Y-m-d H:i:s'); // output = 2017-01-01 00:00:00 (allows for modification)
		echo "<br/>";
		//var_dump($displayMasteryPage);
		//$jso = json_encode($displayMasteryPage); // for showing in a json formatter
		//echo $jso;
		
		echo "<br/>";
		echo "<br/>";
		echo "Their mastery pages:";
		for($i = 0; $i <= $maxMasteryUseable; $i++){
			echo "<br/>&nbsp&nbsp";
			$displayMasteryPage = $masteryArray[$i];
			$pageName = $displayMasteryPage["name"];			

			echo $pageName; //output each mastery page name
		}
	?>
</p>			
			
	</body>
</html>
