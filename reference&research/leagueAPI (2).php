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

/////////// HEADER INCLUDES 
        require './includes/constants.php';
     //  require './includes/db.php';
     //  require './includes/functions.php';
     //  require './includes/prepare.php';
///////////

//https://na.api.pvp.net/api/lol/na/v1.4/summoner/PLUNDERWONDR/masteries?api_key=6689f18c-f8d0-4ff2-b548-ff51b59e3b78
//https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/IMAQTPIE?api_key=6689f18c-f8d0-4ff2-b548-ff51b59e3b78"

$url = "https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/plunderwondr?api_key=6689f18c-f8d0-4ff2-b548-ff51b59e3b78";

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

//echo request($url);
$array = json_decode(request($url),true);

// echo $array -> plunderwondr;
var_dump($array);



$arraySquared = $array[key($array)]; // enters the usernameArray to get info.




//
$username 		= $arraySquared["name"];
$summonerLevel  = $arraySquared["summonerLevel"];
$lastUpdated    = $arraySquared["revisionDate"]; // needs date mathed
$profileIconId  = $arraySquared["profileIconId"];



$lastUpdated = $lastUpdated / 1000; // removed milliseconds
//$currentTime = microtime(true); // compare time since updated.

	?>
<p>
  <br/>
	<?php 
		echo "The database pulled user: " .  $username . ", wow!";
		echo "<br/>";
		echo $username . " has a summoner level of " . $summonerLevel;
		echo "<br/>";
		echo "With the icon code: " . $profileIconId;
		echo "<br/>";
		echo "Last updated at: ". $lastUpdated . " epoch seconds.";
		echo "<br/>";
		//echo date('r',$lastUpdated); // "local" timezone-- was not right timezone +1 instead of - 5
		$dt = new DateTime("@$lastUpdated");  // convert UNIX timestamp to PHP DateTime
		echo $dt->format('Y-m-d H:i:s'); // output = 2017-01-01 00:00:00 (allows for modification)
	
	
	
	?>
</p>			
			
	</body>
</html>
