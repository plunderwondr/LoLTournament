
<!DOCTYPE html>
<?php
	include 'header.php';
?>

	<div class="container">
	<div class="jumbotron">
	  <!-- Title -->
	  <h2>Summoner Spells</h2><br>

<?php  
	$region = "na";//$_POST['region']
	$url = 	"https://global.api.pvp.net/api/lol/static-data/".$region."/v1.2/summoner-spell?spellData=all&api_key=". API_KEY;
			//https://global.api.pvp.net/api/lol/static-data/NA/v1.2/summoner-spell?spellData=all&api_key=6689f18c-f8d0-4ff2-b548-ff51b59e3b78

	
	//break apart array
	$array = json_decode(request($url),true);
	$version = $array["version"];
	$spellsByID = $array["data"]; // enters the usernameArray to get info.
	
	//dig dig dig
	$arraySpellsIDs = array_values($array["data"]);
	$arraySpellsIDs_length = count($arraySpellsIDs); //15
	
	for($i =0; $i < $arraySpellsIDs_length; $i++)
 	{
		//pulling apart array
		$arrayIndex = $arraySpellsIDs[$i];
		//$spellChosen = $spellsByID[$arrayIndexID];
		$imageArray =  $arrayIndex["image"];
		$cooldown = $arrayIndex["cooldown"];
		
		
		//prepping outputs
		$imgLink = "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$imageArray['full'];
		array_key_exists("name",$arrayIndex) ? $name =  $arrayIndex["name"] : $name ="NAME NOT FOUND";	
		array_key_exists("description",$arrayIndex) ? $description =  $arrayIndex["description"]: $description = "";
		array_key_exists("tooltip",$arrayIndex) ? $tooltip =  $arrayIndex["tooltip"] : $tooltip = "";
		array_key_exists(0,$cooldown) ? $cooldown = $cooldown[0] : $cooldown = "??";
		
	//	for($j =0;$j < 15; $j++) //arbitrary value atm {
	//		//if contains {{ fx }} text
	//		if (strpos($tooltip, '{{ f'.$j.' }}') == true) {
	//		  //checks to find var folder
	//		  array_key_exists('vars',$arrayIndex)? $arrayVars = $arrayIndex["vars"] : $arrayVars = "FALSE";
	//        
	//		  //checks to find a sub var
	//		  if (array_key_exists($j,$arrayVars) == true) {
	//		    $vars = $arrayVars['0'];
	//		    $fj = $vars['coeff'];  
	//		    
	//		    $tooltip = str_replace('{{ f'.$j.' }}',$fj,$tooltip);
	//		  } else {
	//		    $fj = "NOT FOUND";
	//		  }
	//		}
	//	}
		//outputs
		//image
		echo '<div class="row"><div class="col-sm-3">';
		echo '<br><img class="img-responsive img-thumbnail" src="'.$imgLink.'" alt="'.$name.'">';
		//name
		echo '<h4>'.$name.'</h4>';
		//cooldown
		echo '<h5>'."Cooldown: ".$cooldown.'</h5></div>';
		//description
		echo '<div class="col-sm-9"><h5>'.$description.'</h5>';
		//tooltip
		echo '<h5><u>'."Tooltip".'</u>'.": ".$tooltip.'</h5></div></div>';
		
		// available in game modes:
	}
?>

	</div>
	</div>
	
</body>
</html>		
	
<?php  include 'footer.php'; ?>