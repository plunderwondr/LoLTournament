<!DOCTYPE html>
<?php
	include 'header.php';
?>

<html>
<body>
<br/>
<br/>
<div class="container">
<?php
// temporary fixed userID


$userID = "29430643";
$region = "na";

// API URL -- PULL MATCH HISTORY -- Last 20 GAMES -- \\
//$MatchHistoryURL = "https://".$region.".api.riotgames.com/api/lol/NA/v1.3/game/by-summoner/29430643/recent?api_key=" . API_KEY;
$MatchHistoryURL = "https://na.api.riotgames.com/api/lol/NA/v1.3/game/by-summoner/".$userID.  "/recent?api_key=" . API_KEY;
//take apart json store it in an array
$array = json_decode(request($MatchHistoryURL),true);


$games = $array["games"];
$gamesSize = sizeof($games);
echo $gamesSize;
// selects first game in match history

for($gameLoop = 0; $gameLoop < $gamesSize; $gameLoop++)
{

	$team1 = [];
	$team2= [];

	$selectedGame = $games[$gameLoop];
	// What players were in the game
	$playersInGame = $selectedGame["fellowPlayers"];
	// How many players were in the game
	$playersSize = sizeof($playersInGame );

	$selectedIsWinner = $selectedGame["stats"]["win"];

 	if ($selectedGame["teamId"] == 100)
	{
     	array_push($team1,$userID);
     	if($selectedIsWinner == true)
     	{
     	$winningTeam = 1;
     	}
     	else
     	{
       	$winningTeam = 2;
     	}

		} //if selected user is 100
 	else if ($selectedGame["teamId"] == 200)
 	{
     	array_push($team2,$userID);
     	$winningTeam = 2;

     	if($selectedIsWinner == true )
     	{
       	$winningTeam = 2;
     	}
     	else
     	{
       	$winningTeam = 1;
     	}

 	}//if selected user is 200


	// Players in game holds most of the useful information
	for($playerLoop = 0; $playerLoop < $playersSize; $playerLoop++)
	{
    	$playerIDsInGame = $playersInGame[$playerLoop]["summonerId"];
    	// Team 1
    	if ($playersInGame[$playerLoop]["teamId"] == "100")
    	{
      	array_push($team1,$playerIDsInGame);
    	}
    	//Team 2
    	else if ($playersInGame[$playerLoop]["teamId"] == "200")
    	{
      	array_push($team2,$playerIDsInGame);
    	}
		} //for loop




		echo '<div class="jumbotron">';

			echo "<h2>TEAM 1</h5> ";
			var_dump($team1);
			echo "<h2>TEAM 2 </h5>";
			var_dump($team2);
			echo "<br/>";
			echo "<h5>The winning team is team: " . $winningTeam. "</h5>";
		echo "</div>";
	}

?>
</div>
</body>
</html>

<?php  include 'footer.php'; ?>
