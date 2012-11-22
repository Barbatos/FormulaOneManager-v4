<?php

if($user->level() < 80)
	redirect(13, MSG_ERROR, '/news');
	
$L_news = loadIniFile(SITE_ROOT.'files/lang/'.$Bld['lang'].'/news.ini');

$Bld['site']['name_left'] = l('Add a news')." - ";

include_once(SITE_ROOT.'_global/_head.php'); 

if(P('news_title') && P('news_text')):

	$query = Bld::$db->prepare('INSERT INTO news (news_date, news_title, news_author, news_level, news_text)
	VALUES (:date, :title, :author, :level, :text)');
	$query->bindValue(':date', time());
	$query->bindValue(':title', P('news_title'));
	$query->bindValue(':author', $user->findID());
	$query->bindValue(':level', P('news_level'));
	$query->bindValue(':text', P('news_text'));
	$query->execute();
	$query->closeCursor();
	
	redirect(6, MSG_SUCCESS, '/news');
endif;
	
	
?>

<div class="container">
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#add_news").validationEngine();
		});
	</script>
	
	<form method="post" id="add_news" name="add_news" class="form-horizontal">
		<fieldset>
			<legend><?= l('Add a news') ?></legend>
			
			<div class="control-group">
				<label class="control-label" for="news_title"><?= l('Title') ?></label>
				<div class="controls">
					<input type="text" class="validate[required,length[5,200]] input-large focused" id="news_title" name="news_title" maxlength="200">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="news_author"><?= l('Author') ?></label>
				<div class="controls">
					<input type="text" class="input-large disabled" id="news_author" name="news_author" value="<?= $user->name() ?>" maxlength="50" disabled>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="news_level"><?= l('Read level') ?></label>
				<div class="controls">
					<select name="news_level">
						<? foreach($Bld['groups'] as $groups): ?>
						<option value="<?= $groups['level'] ?>"><?= $groups['name'] ?></option>
						<? endforeach; ?>
					</select>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="news_text"><?= l('Text') ?></label>
				<div class="controls">
					<textarea name="news_text"></textarea>
				</div>
			</div>
			
			
			<div class="form-actions">
				<button type="submit" class="btn btn-primary"><?= l('Add') ?></button>
			</div>
		</fieldset>
	</form>
	
</div>


<?php
include_once(SITE_ROOT.'_global/_foot.php'); 
?>
