<?php

$L_news = loadIniFile(SITE_ROOT.'files/lang/'.$Bld['lang'].'/news.ini');

$Bld['site']['name_left'] = l('News list')." - ";

include_once(SITE_ROOT.'_global/_head.php'); 

if(isset($Bld['site']['arg2']) && (int)$Bld['site']['arg2'])
	$page = s($Bld['site']['arg2']);
else 
	$page = 1;
	
$start = (($page - 1) * 10);

?>

<div class="container">

	<h1><?= l('News list') ?></h1>
	
	<? if($user->level() >= 80): ?>
	<div class="alert alert-block">
		<h4 class="alert-heading">Admin box</h4>
		<a href="/news/add">Add a news</a>
	</div>
	<? endif; 
	
	if($user->level() < 80) $add = "WHERE news_level <= 1";
	else $add = "";
	
	$query = Bld::$db->prepare('SELECT * FROM news '.$add.' ORDER BY news_date DESC LIMIT :start, 10');
	$query->bindValue(':start', $start, PDO::PARAM_INT);
	$query->execute();
	while($datas = $query->fetch(PDO::FETCH_OBJ)):
	?>
	<div class="infobox">
		<div class="info_icon"><img src="/files/img/ico-logo.png" alt="News" title="News" /></div>
		<div class="info_titre" <? if( ($datas->news_level > 1) && ($user->level() >= 80)): ?>style="color:red;"<? endif; ?>>
			News #<?= $datas->news_id ?> - <?= dateformat($datas->news_date) ?> by <?= $user->name($datas->news_author) ?>
		</div>
		<div class="info_corps">
			<h1>
				<?= $datas->news_title ?> --- 
				<a href="/news/read/<?= $datas->news_id ?>/<?= rewrite($datas->news_title)?>">link</a> - 
				
				<? if($user->level() >= 80): ?>
				<a href="/news/del/<?= $datas->news_id ?>">del</a> - 
				<a href="/news/edit/<?= $datas->news_id ?>">edit</a>
				<? endif; ?>				
			</h1>
			<div class="info_corps_news">
				<?= nl2br($datas->news_text) ?>
			</div>
		</div>
		<div class="info_bottom"></div>
	</div>
	
	<br />
	<? endwhile; ?>
	
	
	<div class="pagination">
		<ul>
			<li><a href="#">Prev</a></li>
			<li class="active">
				<a href="#">1</a>
			</li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">Next</a></li>
		</ul>
	</div>
</div>

<?php
include_once(SITE_ROOT.'_global/_foot.php'); 
?>
