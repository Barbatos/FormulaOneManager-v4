<?php 

// déclarations en ce qui concerne le header
$Bld['site']['name_left'] = "Home - ";

include_once(SITE_ROOT.'_global/_head.php'); ?>

<?php if(!$user->isLogged()): ?>

<h1>TEST PAGE NON DEFINITIVE!!</h1>

<div class="infobox">
	<div class="info_icon"><img src="/files/img/ico-logo.png" alt="News" title="News" /></div>
	<div class="info_titre">Update</div>
	<div class="info_corps">
		<h1>FOM was updated today!</h1>
		<div class="info_corps_news">
			Good evening everyone,<br />
			That's it, season 4 is here. No big news this season, but I will still list them to you as usual:<br />
- The India race track appears this season, and the Bahrain circuit is removed. The races schedule of Formula One Manager is now the same as 2011 season of Formula 1.<br />
- The drivers now ask for a salary when you hire them, and you can't change it.<br />
- You can choose your tires during the testing session.<br />
- There are new 'extra soft' tires.<br />
- When you qualify your driver, you must choose the type of tires to put on. Warning: the tires you use to qualify are used for the first relay of the race.<br />
- Aerodynamic optimizations were deleted<br />
- You can now replace in your browser options (tab 'My Account') the 'sliders' by drop-down menus to change the settings of your cars (page 'Race Track -> Strategies')<br />
- The '+' and '-' to choose the number of engineers to be allocated to an aerodynamic element have been replaced by a drop-down menu.<br />
		</div>
		
	</div>
	<div class="info_bottom"></div>
</div>
<div class="infobox">
	<div class="info_icon"><img src="/files/img/ico-logo.png" alt="News" title="News" /></div>
	<div class="info_titre">Update</div>
	<div class="info_corps">
		<h1>FOM was updated today!</h1>
		<div class="info_corps_news">
			Good evening everyone,<br />
			That's it, season 4 is here. No big news this season, but I will still list them to you as usual:<br />
- The India race track appears this season, and the Bahrain circuit is removed. The races schedule of Formula One Manager is now the same as 2011 season of Formula 1.<br />
- The drivers now ask for a salary when you hire them, and you can't change it.<br />
- You can choose your tires during the testing session.<br />
- There are new 'extra soft' tires.<br />
- When you qualify your driver, you must choose the type of tires to put on. Warning: the tires you use to qualify are used for the first relay of the race.<br />
- Aerodynamic optimizations were deleted<br />
- You can now replace in your browser options (tab 'My Account') the 'sliders' by drop-down menus to change the settings of your cars (page 'Race Track -> Strategies')<br />
- The '+' and '-' to choose the number of engineers to be allocated to an aerodynamic element have been replaced by a drop-down menu.<br />
		</div>
		
	</div>
	<div class="info_bottom"></div>
</div>
<div class="infobox">
	<div class="info_icon"><img src="/files/img/ico-logo.png" alt="News" title="News" /></div>
	<div class="info_titre">Update</div>
	<div class="info_corps">
		<h1>FOM was updated today!</h1>
		<div class="info_corps_news">
			Good evening everyone,<br />
			That's it, season 4 is here. No big news this season, but I will still list them to you as usual:<br />
- The India race track appears this season, and the Bahrain circuit is removed. The races schedule of Formula One Manager is now the same as 2011 season of Formula 1.<br />
- The drivers now ask for a salary when you hire them, and you can't change it.<br />
- You can choose your tires during the testing session.<br />
- There are new 'extra soft' tires.<br />
- When you qualify your driver, you must choose the type of tires to put on. Warning: the tires you use to qualify are used for the first relay of the race.<br />
- Aerodynamic optimizations were deleted<br />
- You can now replace in your browser options (tab 'My Account') the 'sliders' by drop-down menus to change the settings of your cars (page 'Race Track -> Strategies')<br />
- The '+' and '-' to choose the number of engineers to be allocated to an aerodynamic element have been replaced by a drop-down menu.<br />
		</div>
		
	</div>
	<div class="info_bottom"></div>
</div>
<br />

<?php else: ?>

<div class="container">
	<h1>Welcome back <strong><?= $user->name() ?></strong>!</h1>
	<a href="/players/login/logout">Logout</a>
	<br />
	<a href="/news">News list</a>

	<table class="table">
		<tr>
			<th>ID</th>
			<th>mail</th>
			<th>groupe</th>
			<th>inscription</th>
			<th>connexion</th>
			<th>ip</th>
		</tr>
	<?php
	$query = Bld::$db->prepare('SELECT * FROM users ORDER BY user_id ASC');
	$query->execute();
	while($datas = $query->fetch(PDO::FETCH_OBJ)):
	?>
		<tr>
			<td><?= $datas->user_id ?></td>
			<td><?= $datas->user_mail ?></td>
			<td><?= $Bld['groups'][$datas->user_group]['name'] ?></td>
			<td><?= dateformat($datas->user_regdate, 0) ?></td>
			<td><?= dateformat($datas->user_lastseen) ?></td>
			<td><?= $datas->user_lastip ?></td>
		</tr>
	<?php 
	endwhile; 
	$query->closeCursor();
	?>
	</table>
</div>
	
<?php endif; ?>


<?php include_once(SITE_ROOT.'_global/_foot.php'); ?>
