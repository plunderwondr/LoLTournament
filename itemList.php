<!DOCTYPE html>
<?php
	include 'header.php';
?>

<html lang="en">
<body>

	<div class="container">
	<div class="jumbotron">
	  <!-- Title -->
	  <h2>Item List</h2><br>
	  
<?php  
	$region = "na";//$_POST['region']
	$url = 	"https://global.api.pvp.net/api/lol/static-data/".$region."/v1.2/item?itemListData=all&api_key=". API_KEY;

	
	
	$array = json_decode(request($url),true);
	$version = $array["version"];
	$itemsByID = $array["data"]; // enters the usernameArray to get info.
	
	$arrayItemIDs = array_values($array["data"]);
	$arrayItemIDs_length = count($arrayItemIDs); //238 
	
	//ITEM LIST OUTPUT
	  // loop through all dems
	  for($i=0; $i < $arrayItemIDs_length; $i++) {
	  	//these array declarations needs compacted
	  	$arrayIndex = $arrayItemIDs[$i];
	  	$arrayIndexID = $arrayIndex['id']; // pulls the id we are looking for
	  
	  	//$itemChosen = $itemsByID[1001];
	  	$itemChosen = $itemsByID[$arrayIndexID];
	  	
	  	$mapListOfItemChosen= $itemChosen['maps'];
	  	$goldArrayOfItemChosen= $itemChosen['gold'];
	  
	  	// if is obtainable on summoner's rift && can be bought
	  	if($mapListOfItemChosen['11'] == true && $goldArrayOfItemChosen['purchasable'] == true){
	  	  $imgLink = "http://ddragon.leagueoflegends.com/cdn/".$version."/img/item/".$arrayIndexID.".png";
	  	  
	  	  //$name = $itemChosen["name"];
	  	  //$description = $itemChosen["sanitizedDescription"];		
	  	  //$plainText = $itemChosen["plaintext"];
	  	  array_key_exists('name',$itemChosen) ? $name = $itemChosen["name"]: $name ="NAME NOT FOUND";
	  	  array_key_exists('description',$itemChosen) ? $badDescription = $itemChosen["description"] : $badDescription ="Description NOT FOUND" ; 
	  	  array_key_exists('sanitizedDescription',$itemChosen) ? $description = $itemChosen["sanitizedDescription"] : $description ="Description NOT FOUND";
	  	  array_key_exists('plaintext',$itemChosen) ? $plainText = $itemChosen["plaintext"] : $plainText ="Text NOT FOUND" ;
	  	  
		  //skips over a couple known out of place items
	  	  if(strpos($badDescription, "<font color='#FF9900'>") == false){ 	
			echo '<div class="row"><div class="col-sm-3">';
			echo '<br><img class="img-responsive img-thumbnail" src="'.$imgLink.'" alt="'.$arrayIndexID.'">';
	  	  	echo '<h4>'.$name.'</h4></div>';
			echo '<div class="col-sm-9"><h5>'.$plainText.'</h5>';
			echo '<h5>'.$description.'</h5></div></div>';
			//echo $badDescription;
	  	  } //end if
	  	} //end if
	  } //end for
?>	
	</div>
	</div>
	
</body>
</html>	
	
<?php  include 'footer.php'; ?>
