

<?php
// This is a sample product tutorial followed to both learn how to use the API
// and as a useful function
function summoner_name()($summoner,$server){
	$summoner_encoded = rawurlencode($summoner);
	$summoner_lower = strtolower($summoner_enc);
	
	$curl = curl_init('https://' . $server . '.api.pvp.net/api/lol/' . $server . '/v1.4/summoner/by-name/' . $summoner . '?api_key=6689f18c-f8d0-4ff2-b548-ff51b59e3b78');
	
}

?>