<?php

	function display_copyright()
	{
		$copyRight = "&copy; " . date('Y') . " Passion Fruit";
	
		return $copyRight;
	}
	
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
?>