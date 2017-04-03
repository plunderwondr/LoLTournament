<?php
//own profile api link
//https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/plunderwondr?api_key=6689f18c-f8d0-4ff2-b548-ff51b59e3b78


$url = "https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/Plunderwondr?api_key=6689f18c-f8d0-4ff2-b548-ff51b59e3b78";

function request($url){
$ch = curl_init(1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$statuscode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if($statuscode!=200){
echo "HTTP ERROR ".$statuscode."<br>";
return "false";
}
 return $result;
}

echo request($url);

?>