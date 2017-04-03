<!DOCTYPE html>
<?php
	include 'header.php';
?>

<html lang="en">
<body>

	<div class="container">
	<div class="jumbotron">
	  <!-- Title -->
	  <h2>Runes List</h2><br>

<?php  
	$region = "na";//$_POST['region']
	$url = 	"https://global.api.pvp.net/api/lol/static-data/".$region."/v1.2/rune?runeListData=all&api_key=". API_KEY;
	//https://global.api.pvp.net/api/lol/static-data/NA/v1.2/rune?runeListData=all&api_key=6689f18c-f8d0-4ff2-b548-ff51b59e3b78\

	
	//break apart array
	$array = json_decode(request($url),true);
	$version = $array["version"];
	$runesByID = $array["data"]; // enters the usernameArray to get info.
	
	//dig dig dig
	$arrayRuneIDs = array_values($array["data"]);
	$arrayRuneIDs_length = count($arrayRuneIDs); //296
	
		// loop through the whole list of runes
	for($i=0; $i < $arrayRuneIDs_length; $i++) {
		//these array declarations needs compacted
 		$arrayIndex = $arrayRuneIDs[$i];
		$arrayIndexID = $arrayIndex['id']; // pulls the id we are looking for

		//$itemChosen = $itemsByID[1001];
 		$runeChosen = $runesByID[$arrayIndexID];
		
		//set the image name
		$ImageArrayOfItemChosen= $runeChosen['image'];
		//to figure out rune tier
		$runes = $runeChosen["rune"];
		
		 //set output vars
		$imgLink = "http://ddragon.leagueoflegends.com/cdn/".$version."/img/rune/".$ImageArrayOfItemChosen['full'];
		array_key_exists('name',$runeChosen) ? $name = $runeChosen["name"]: $name ="NAME NOT FOUND";			
		array_key_exists('sanitizedDescription',$runeChosen) ? $description = $runeChosen['sanitizedDescription']: $description ="DESCRIPTION NOT FOUND";			
		array_key_exists('tier',$runes) ? $tier = $runes["tier"]: $tier ="Tier NOT FOUND";		
		
		//output vars
		echo '<div class="row"><div class="col-sm-3">';
		echo '<br><img class="img-responsive img-thumbnail" src="'.$imgLink.'" alt="'.$ImageArrayOfItemChosen['full'].'">';
		echo '<h4>'.$name.' </h4>';
		echo '<h5><u>'."Tier".'</u>'.": ".$tier.'</h5></div>';
		echo '<div class="col-sm-9"><h3 align="center">'.$description.'</h3></div></div>';
	} //end for
?>
	</div>
	</div>
	
</body>
</html>	
	
<?php  include 'footer.php'; ?>