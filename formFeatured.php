<?php
	include 'header.php';
?>

<html lang="en">
	<body>
	<!-- Fixed navbar -->

	<div class="container">
	<div class="jumbotron" align="center">
		<!-- Title -->
		<h2>Featured Games</h2>
		
		<form class="form-inline" action="featuredGames.php" method="post">
		  <div class="form-group">
			<label for="#region"><h5>Region:</h5></label>
			  <select id="region" name="region">
			  	<option value="na">NA</option>
			  	<option value="br">BR</option>
			  	<option value="eune">EUNE</option>
			  	<option value="euw">EUW</option>
			  	<option value="jp">JP</option>
			  	<option value="lan">LAN</option>
			  	<option value="las">LAS</option>
			  	<option value="ru">RU</option>					
			  	<option value="oce">OCE</option>
			  	<option value="tr">TR</option>
			  	<option value="kr">KR</option>	 
			  </select>
		  </div>
		  <div class="form-group">
		    <button type="submit" class="btn btn-default">
			  <span class="glyphicon glyphicon-search"></span> Submit
			</button>
		  </div>
		</form>
		</div>
		</div>
	</div> <!-- /container --> 
  </body>
</html>
		
<?php  include 'footer.php'; ?>