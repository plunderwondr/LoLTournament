<?php
	include 'header.php';
?>
<head> 
  <title>Profile Look Up</title> 
</head>
	<body>
		<form action = "profile_masteries.php" method = "post">
			Region: <select  name = "region">
						<option>NA</option>
						<option>BR</option>
						<option>EUNE</option>
						<option>EUW</option>
						<option>JP</option>
						<option>LAN</option>
						<option>LAS</option>
						<option>RU</option>					
						<option>OCE</option>
						<option>TR</option>
						<option>KR</option>	 
					</select>
					<br/>
				Summoner Name: <input type="text" name="summonerName"/>
				<br/>
				Number of Champions <input type="text" name="noChamps"/>
			<input type="submit" />
		</form>
		
<?php  include 'footer.php'; ?>