<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?= $Bld['site']['description'] ?>">
	<meta name="author" content="<?= $Bld['site']['author'] ?>">
	<meta name="keywords" content="<?= $Bld['site']['keywords'] ?>">
	<meta name="copyright" content="<?= $Bld['site']['copyright'] ?>">
	<meta name="generator" content="<?= $Bld['site']['generator'] ?>">

	<title><?= $Bld['site']['name_left'].$Bld['site']['name'].$Bld['site']['name_right'] ?></title>
	
	<link href="/files/css/main.css" rel="stylesheet">
	<!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
    <!-- Le styles -->
    <!--<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
	<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">-->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    

	
    <!-- Le fav and touch icons -->
    <!--<link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
	
	<link rel="stylesheet" href="http://www.position-relative.net/creation/formValidator/css/validationEngine.jquery.css" type="text/css"/>
	<script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-alert.js" type="text/javascript"></script>
	<script src="http://www.position-relative.net/creation/formValidator/js/jquery-1.5.1.min.js" type="text/javascript"></script>
	<script src="http://www.position-relative.net/creation/formValidator/js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
	<script src="http://www.position-relative.net/creation/formValidator/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>-->
  </head>

  <body>
	<div id="page">
		<header id="head">
			<div id="headLangs">
				<span class="headFlag"><a href="#"><img src="/files/img/flag-fr.jpg" alt="fr" title="fr" /></a></span>
				<span class="headFlag"><a href="#"><img src="/files/img/flag-uk.jpg" alt="en" title="en" /></a></span>
				<span class="headFlag"><a href="#"><img src="/files/img/flag-es.jpg" alt="es" title="es" /></a></span>
				<span class="headSeparator"></span>
				<span class="headIcon"><a href="#"><img src="/files/img/ico-facebook.jpg" alt="Facebook" title="F1m.fr on Facebook" /></a></span>
				<span class="headIcon"><a href="#"><img src="/files/img/ico-tweeter.png" alt="es" title="F1m.fr on Twitter" /></a></span>
			</div>
		</header>
		
		<div id="speedBar">
			<div id="speedLinks">
				<div id="link"><a href="/" id="home">Accueil</a></div>
				<div id="link"><a href="/news">News</a></div>
				<div id="link"><a href="/players/register">Inscription</a></div>
				<div id="link"><a href="/players/login">Connexion</a></div>
			</div>
		</div>
		
		<div id="infoBar"></div>
	
	
		<div id="corps">
		
			<div id="filAriane">
				<div id="container">
					<div id="text">
						<strong>Formula One Manager</strong> -> Accueil -> News
					</div>
					<div id="fleche"></div>
				</div>
			</div>
			
			<div id="mid">
		
	
		<!--<div class="navbar navbar-fixed-top">
		  <div class="navbar-inner">
			<div class="container">
			  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </a>
			  <a class="brand" href="#">Formula One Manager</a>
			  <div class="nav-collapse">
				<ul class="nav">
				  <li class="active"><a href="/">Home</a></li>
				  <li><a href="/players/register">Register</a></li>
				  <li><a href="/players/login">Log in</a></li>
				</ul>
			  </div>
			</div>
		  </div>
		</div>-->
		
		<?php
		if(!empty($_SESSION['error']['e'])):
			echo msg($_SESSION['error']['e'], true);
			$_SESSION['error'] = array();
		endif;
		
		if(!empty($_SESSION['message']['m'])):
			echo msg($_SESSION['message']['m'], false);
			$_SESSION['message'] = array();
		endif;
		?>
	
	