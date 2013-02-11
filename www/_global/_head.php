<?php
/*
 *  This file is part of Formula One Manager.
 *
 *  Formula One Manager is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Formula One Manager is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Formula One Manager. If not, see http://www.gnu.org/licenses/
 *
 *  @copyright  (c) Formula One Manager 2007/2012
 *  @author     Charles 'Barbatos' Duprey
 *  @email      barbatos@f1m.fr
 */
?>

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
				<div id="link"><a href="/" id="home"><?= l('Home') ?></a></div>
				<div id="link"><a href="/news"><?= l('News') ?></a></div>
				<?php 
				if(!$user->isLogged()):
				?>
				<div id="link"><a href="/players/register"><?= l('Registration') ?></a></div>
				<div id="link"><a href="/players/login"><?= l('Connection') ?></a></div>
				<?php
				else:
				?>

				<?php
				endif;
				?>	
				<div id="link"><a href="/leagues"><?= l('Leagues') ?></a></div>
			</div>
		</div>
		
		<!--<div id="infoBar"></div>-->
	
	
		<div id="corps">
		
			<div id="filAriane">
				<div id="container">
					<div id="text">
						<strong><?= l('Formula One Manager') ?></strong> <?= $Bld['site']['filAriane'] ?>
					</div>
					<div id="fleche"></div>
				</div>
			</div>
			
			<div id="mid">
		
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
		
		