<?php
	include 'header.php';

	//this should go in a functions file

?>
	<?php  
	$url = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/mastery?masteryListData=all&api_key=" . API_KEY;
	
	$array = json_decode(request($url),true);
	//$array = $array[key($array)];
	$array = $array["tree"];
	
	 // trees 
	$tree1 = $array["Cunning"] ;
	$tree2 = $array["Ferocity"];
	$tree3 = $array["Resolve"];
	
	// 6 tiers of variables
	 var_dump($array);// enters the usernameArray to get info. 
	//$Masteries = array_keys($array["data"]);
	// var_dump($Masteries);
	?>
	</p>			
<?php  include 'footer.php'; ?>
