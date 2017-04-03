<!DOCTYPE html>
<?php
	include 'header.php';
?>

<html lang="en">
<body>
<?php
	$region = $_POST['region'];
	$username = $_POST['summonerName'];

	$url = "https://".$region.".api.pvp.net/api/lol/".$region."/v1.4/summoner/by-name/".$username."?api_key=" . API_KEY;
	$array = json_decode(request($url),true);

	$arraySquared 	= $array[key($array)]; // enters the usernameArray to get info.


//$URL vars
	$summonerId     = $arraySquared["id"];
	$username 		= $arraySquared["name"];
	$summonerLevel  = $arraySquared["summonerLevel"];
	$lastUpdated    = $arraySquared["revisionDate"]; // needs date mathed
	$profileIconId  = $arraySquared["profileIconId"];
	$lastUpdated 	= $lastUpdated / 1000; // removed milliseconds
	$dt 			= new DateTime("@$lastUpdated");  // convert UNIX timestamp to PHP DateTime
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
	$masteryUsed = 0;
	$masteryLimit = 10;
	$masteryFirst = true;

//$runes vars
	$runesURL     = "https://".$region.".api.pvp.net/api/lol/".$region. "/v1.4/summoner/". $summonerId ."/runes?api_key=". API_KEY;
	$runesArray   = json_decode(request($runesURL),true);
	$runesArray   = $runesArray[key($runesArray)]; //enter array
	$runesArray   = $runesArray ["pages"]; //select between summonerID and pages
	$runesArrayKeys = array_keys($runesArray);  //

	$maxRunesUseable = count($runesArray) - 1;
	$runesUsed = 0;
	$runesLimit = 10;
	$runesFirst = true;

//$champMastery vars
	$championMasteryURL   = "https://".$region.".api.pvp.net/championmastery/location/".$region."1/player/". $summonerId ."/champions?api_key=". API_KEY;
	$championMasteryArray = json_decode(request($championMasteryURL),true);
	$maxchampionMasteryUseable = count($championMasteryArray) - 1;

	$numberOfChamps = 5; //TEMP NUM to limit loading times
	//	$championMasteryArrayKeys = array_keys($championMasteryArray);  //
	//var_dump($championMasteryArray);
echo var_dump($championMasteryURL);
?>


  <div class="container">
	<!-- Title -->
	<div class="jumbotron">
	  <h1><?php echo $username ?></h1>

	  <!-- Player Name & Level -->
	  <?php echo '<img class="img-responsive" src="'.$imgLink.'" alt="'.$profileIconId.'">' ?>
	  <h2>Level <?php echo $summonerLevel ?></h2>
	</div> <!-- end Jumbotron -->

    <div class="panel-group" id="characterAccrd">
      <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#characterAccrd" href="#collapseMasteries">Masteries</a>
            </h4>
        </div>
        <div id="collapseMasteries" class="panel-collapse collapse">
		  <ul id ="mListGroup" class="list-group">
			<?php
				for($i=0; $i < $GLOBALS['maxMasteryUseable']; $i++) {
					$displayMasteryPage = $GLOBALS['masteryArray'][$i];
					$pageName = $displayMasteryPage["name"];
					echo '<li class="list-group-item"><a href="#"><h5>'.$pageName.'</h5></a></li>';
				}
			?>
			<?php //masteryOutput(0, true); ?>
			<!-- <input type="button" class="btn btn-primary btn-block" id="moreMasteries" value="Load More" onclick="echoMasteryOutput()"> -->
		  </ul>
	    </div>
	  </div>
	  <div class="panel panel-primary">
		<div class="panel-heading">
	      <h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#characterAccrd" href="#collapseRunes">Runes</a>
		  </h4>
		</div>
	   <div id="collapseRunes" class="panel-collapse collapse">
		  <ul id ="rListGroup" class="list-group">
			<?php
			  for($i=0; $i < $GLOBALS['maxRunesUseable']; $i++) {
				$displayRunePage = $GLOBALS['runesArray'][$i];
				$pageName = $displayRunePage["name"];
				echo '<li class="list-group-item"><a href="#"><h5>'.$pageName.'</h5></a></li>';
			  }
			?>

		    <?php //(0, true); ?>
		    <!-- <input type="button" class="btn btn-primary btn-block" id="moreRunes" value="Load More" onclick="echoRuneOutput()"> -->
		  </ul>
        </div>
      </div>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#characterAccrd" href="#collapseCharMaster">Character Masteries</a>
          </h4>
        </div>
        <div id="collapseCharMaster" class="panel-collapse collapse">
          <ul id ="rListGroup" class="list-group">
			<?php
			  for($i=0; $i < $GLOBALS['maxchampionMasteryUseable'] && $i < $GLOBALS['numberOfChamps']; $i++) {
				$championMasteryArrayed  = $championMasteryArray[$i]; //enter array
				$championNumber  = $championMasteryArrayed["championId"];

				$championNameFromIDURL = "https://global.api.pvp.net/api/lol/static-data/".$region."/v1.2/champion/".$championNumber. "?api_key=". API_KEY;
				$championNameSelect = json_decode(request($championNameFromIDURL),true);
				$pageName = $championNameSelect["name"];

				echo '<li class="list-group-item"><a href="http://leagueoflegends.wikia.com/wiki/'.$pageName.'"><h5>'.$pageName.'</h5></a></li>';
			  }
			?>
		    <?php //charMasteryOutput(0, true); ?>
		    <!-- <input type="button" class="btn btn-primary btn-block" id="moreRunes" value="Load More" onclick="echoRuneOutput()"> -->
		  </ul>
        </div>
      </div>
    </div>

   <p align="right">Last updated: <?php echo $dt->format('Y-m-d H:i:s') ?></p>
   <!-- output = 2017-01-01 00:00:00 (allows for modification) -->

    </div>
</body>
</html>

<?php  include 'footer.php'; ?>
