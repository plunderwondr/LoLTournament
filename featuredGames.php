
<!DOCTYPE html>
<?php
	include 'header.php';
?>

<html lang="en">
<body>

	<div class="container">
	<!-- Title -->
	  <h2>Featured Games</h2>
	  

<?php  
	//Page goal: Implement showing the current 5 featured games
	//------ featured games API array pieces ---------
	//arbitrary region chosen for now
	$region = $_POST['region'];
	$url = 	"https://".$region.".api.pvp.net/observer-mode/rest/featured?api_key=". API_KEY;

	//break apart array
	$array = json_decode(request($url),true);

	$gameListArray = $array["gameList"]; 	
	
	//gameListCounter		
	$gameListArray_length = count($gameListArray);
	// summoner spell API url
	//------- featured games API array pieces ----------
	
	//========summonerSpells API byID =======
	$urlSummonerSpells = "https://global.api.riotgames.com/api/lol/static-data/".$region."/v1.2/summoner-spell?dataById=true&api_key=". API_KEY;
	$arraySummonerSpells = json_decode(request($urlSummonerSpells),true);
	$version = $arraySummonerSpells["version"];
		
	$summonerSpellsArray = $arraySummonerSpells["data"];
	//=============================
	
	
	//~~~~~~~~~~~ Champions API byID ~~~~~~~~~~~~~
		//faster, but doesn't contain image
	//	$urlChampions = "https://global.api.riotgames.com/api/lol/static-data/".$region."/v1.2/champion?dataById=true&api_key=". API_KEY;
	$urlChampions = "https://global.api.riotgames.com/api/lol/static-data/".$region."/v1.2/champion?dataById=true&champData=all&api_key=". API_KEY;
	$arrayChampions = json_decode(request($urlChampions),true);
	
	$championByIDArray = $arrayChampions["data"];
	//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	//loop through all featured games
	for($i = 0; $i < $gameListArray_length; $i++)
	{
		//Show all information of each element
		$arrayIndex = $gameListArray[$i];
		
		//Game mode name
		$gameMode = $arrayIndex['gameMode'];
		//Participants Array
		$players = $arrayIndex['participants'];
		$playersArray_length = count($players);
		
		
			//table containing each featured game contents
?>
		<!-- brings to centre-->
		<h3><?php echo $gameMode; ?></h3>
		<!-- puts in subboxs-->
		<div class="jumbotron">
		
<?php
		//loop through all players
		for($j=0; $j < $playersArray_length; $j++)
		{
			$playerArray = $players[$j];
		//Name of the user
			$playerName = $playerArray['summonerName'];
		//What champion they are playing
			$championID = $playerArray['championId'];
		
		//what team are they on
			$team = $playerArray['teamId'];
			switch ($team) {
				case 100:
					$team = "7050e5"; //"Blue";
					break;
				case 200:
					$team = "d62020";//"Red";
					break;
			}
		
		
		// vvv SUMMONER SPELLS  vvv
				// What summoner spells user is using
			$spell1ID = $playerArray['spell1Id'];
			$spell2ID = $playerArray['spell2Id'];
				// if that summoner ability exists post it: otherwise post an error text fill in
			array_key_exists($spell1ID,$summonerSpellsArray) ? $spell = $summonerSpellsArray[$spell1ID] : $spell = "NOT FOUND";
				$spell !== "NOT FOUND" ? $spell1 = $spell['name']: $spell1 = $spell;
				//Double Down
			array_key_exists($spell2ID,$summonerSpellsArray) ? $spell = $summonerSpellsArray[$spell2ID] : $spell = "NOT FOUND";
				$spell !== "NOT FOUND" ? $spell2 = $spell['name']: $spell2 = $spell;	
			//Images
//			$spellImageFolder = $championSelected['image'];	 
//			$spellPictureName1 = $spellImageFolder['full'];	
//			$spellPictureURL1 = "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$spellPictureName1;					 
//			$spellPictureName2 = $spellImageFolder['full'];	
//			$spellPictureURL2 = "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$spellPictureName2;
			// ^^^ SUMMONER SPELLS  ^^^

			
			
			/////////// Champion by ID \\\\\\\\\\\\\\\\
			$championID = $playerArray['championId'];
			
			$championSelected = $championByIDArray[$championID];
			
			array_key_exists($championID,$championByIDArray) ? $championSelected = $championByIDArray[$championID] : $championSelected = "NOT FOUND";
			$championName = $championSelected['name'];
				
			$champImageFolder = $championSelected['image'];
			$championPictureName = $champImageFolder['full'];
			$championPictureURL = "http://ddragon.leagueoflegends.com/cdn/".$version."/img/champion/" . $championPictureName;
			////////////////////\\\\\\\\\\\\\\\\\\\\\\\\
			
			//contains Each player information
			
			echo '<div class="row" style="border-bottom: 4px solid #'.$team.'" align="center">';
?>
				<div class="col-sm-8">
				<div class="col-sm-4">
				  </br></br>
				  <?php echo '<div class="well" style="background-color: #'.$team.'">'; ?>
					<img class="img-responsive img-thumbnail" src="<?php echo $championPictureURL; ?>" alt="<?php echo $championPictureName; ?>">
					<h4><?php echo $championName; ?></h4>
					<h4><?php echo $playerName; ?></h4>
				  </div>
				</div>
				<div class="col-sm-4" align="left">
					</br></br></br></br></br></br>
					<h4><?php echo $spell1; ?></h4>
					</br></br>
					<h4><?php echo $spell2; ?></h4>
				</div>
				</div>
				<div class="col-sm-4">
					</br></br></br></br></br></br></br></br>
					<!-- Contains settings for eventual button addition -->
					
					<form class="form-inline" action="profile.php" method="post">
						<input type="hidden" name="region" value="<?php echo $region; ?>">
						<button type="submit" class="btn btn-info" name="summonerName" value= "<?php echo $playerName; ?>">
							See my profile 
						</button>
					</form>
				</div>
			</div>
<?php
		}
?>
		</div>
<?php
	}
?>

	
	</div>
	
</body>
</html>
	
<?php  include 'footer.php'; ?>