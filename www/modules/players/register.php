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

$resp 		= null;
$error 		= null;

require(ENGINE_ROOT.'inc/captcha.class.php');
$L_register = loadIniFile(SITE_ROOT.'files/lang/'.$Bld['lang'].'/register.ini');

// déclarations en ce qui concerne le header
$Bld['site']['name_left'] = l('Registration')." - ";

include_once(SITE_ROOT.'_global/_head.php'); 

/* Already connected */
if($user->isLogged())
	redirect(7, MSG_ERROR, '/');
	
if(P('email')):
	if( !P('name') || !P('password') || !P('confirm_password') || !P('email') || !P('confirm_email') || !P('country') || !P('agreement') ):
		redirect(2, MSG_ERROR);
	endif;
	
	if( P('password') != P('confirm_password') ):
		redirect(3, MSG_ERROR);
	endif;
	
	if( P('email') != P('confirm_email') ):
		redirect(4, MSG_ERROR);
	endif;
	
	if ( P('recaptcha_response_field') ):
		$resp = recaptcha_check_answer (CAPTCHA_PRIVATE_KEY, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

		/* Fields completed successfuly, let's register */
		if ($resp->is_valid):
			$user->add();
			//redirect(1, MSG_SUCCESS, '/players/login');
		else:
			//redirect(5, MSG_ERROR);
			$user->add();
		endif;
	else:
		redirect(6, MSG_ERROR);
	endif;
endif;

?>
<div class="container">
	
	<h1><?= l('Register') ?></h1>
	<script type="text/javascript">
	 var RecaptchaOptions = {
		theme : 'clean'
	 };

	jQuery(document).ready(function(){

		jQuery("#registration").validationEngine();

	});
	 </script>
	<form method="post" id="registration" name="registration" class="form-horizontal">	
		<fieldset>
			<legend><?= l('Registration to Formula One Manager') ?></legend>
			
			<div class="control-group">
				<label class="control-label" for="email"><?= l('Email Address') ?></label>
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-envelope"></i></span>
						<input type="text" class="validate[required,custom[email]] span2 focused" id="email" name="email" maxlength="60">
						<p class="help-block"><?= l('Youll use it to connect to the game') ?></p>
					</div>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="confirm_email"><?= l('Confirm Email Address') ?></label>
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-envelope"></i></span>
						<input type="text" class="validate[required,custom[email]] span2" id="confirm_email" name="confirm_email" maxlength="60">
					</div>
				</div>
			</div>
			  
			<div class="control-group">
				<label class="control-label" for="name"><?= l('Displayed Name') ?></label>
				<div class="controls">
					<input type="text" class="input-large validate[required,custom[onlyLetterNumber],length[3,20]]" id="name" name="name" maxlength="30">
					<p class="help-block"><?= l('The name that other players will see in game') ?></p>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="password"><?= l('Password') ?></label>
				<div class="controls">
					<input type="password" class="validate[required,length[6,25]] input-large" id="password" name="password" maxlength="50">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="confirm_password"><?= l('Confirm Password') ?></label>
				<div class="controls">
					<input type="password" class="validate[required,length[6,25]] input-large" id="confirm_password" name="confirm_password" maxlength="50">
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="country"><?= l('Country') ?></label>
				<div class="controls">
					<select id="country" name="country" class="validate[required]">
						<option value="fr">France</option>
						<option value="be">Belgium</option>
						<option value="de">Germany</option>
						<option value="uk">United Kingdom</option>
						<option value="sp">Spain</option>
					</select>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="agreement"><?= l('Agreement') ?></label>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" id="agreement" name="agreement" value="option1" class="validate[required]">
						<?= l('I have read and agree to your Terms of Service') ?>
					</label>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="verification"><?= l('Verification') ?></label>
				<div class="controls">
					<?= recaptcha_get_html(CAPTCHA_PUBLIC_KEY, $error); ?>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary"><?= l('Register') ?></button>
			</div>
		</fieldset>
	</form>
</div>
<?php include_once(SITE_ROOT.'_global/_foot.php'); ?>
