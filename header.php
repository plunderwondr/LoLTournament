<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<meta name="description" content="">
		<meta name="author" content="Reegan Beveridge">
		<link rel="icon" href="#">

		<title>LoL Wikia</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>

		<?php
		  require ("./includes/constants.php");
		  require ("./includes/functions.php");
		?>
	</head>



<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false" aria-controls="myNavbar" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
			<span class="icon-bar"></span>
          </button>
		  <!-- LOGO -->
          <a href="lolForm.php">
			<img class="navbar-brand" src="img/logo.png" alt="logoPic" width="250" height="60">
		  </a>
        </div>
        <div id="myNavbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="contact.php">Contact</a></li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Resources <span class="caret"></span></a>
			  <ul class="dropdown-menu">
			    <li><a href="itemList.php">Items</a></li>
			    <!-- <li><a href="lolForm_masteries.php">Character Masteries</a></li> -->
			    <li><a href="runes.php">Runes</a></li>
			    <li><a href ="summonerSpells.php">Summoners</a></li>
					<li><a href ="matchFinder_form.php">matchFinder</a></li>
					<li><a href ="tournamentMaker.php">Tournament Maker</a></li>
			  </ul>
			</li>
			<li><a href ="formFeatured.php">Featured Games</a></li>

			<!--<li><a href ="featuredgames.php">Featured Games</a></li> -->
			<li><a href="lolForm.php">Search <span class="glyphicon glyphicon-search"></span></a></li>
          </ul>
		</div>
	  </div>
    </nav>

	</br></br></br></br></br></br></br></br></br>
