<?php
defined('C5_EXECUTE') or die(_("Access Denied.")); 
global $c;
  
$loginURL= $this->url('/login', 'do_login' );
//Username link (where to take user if they click on their name.  Example: to a Member Profile page.)(/myaccount/ Single Page not included.
$usernameLink = $this->url('/myaccount/', '');

?>
<?php if (User::isloggedIn()) { 
	$user = new User();

?>			     
			<div id="userbox">
            <p><strong><?=t("Welcome back")?></strong></p>
            <p class="loggedUserName"><a href="<?=$usernameLink?>"><?=$user->getUserName()?></a></p>
            <p class="loggedSignOut"><a href="<?php  echo $this->url('/login/', 'logout')?>"><?php  echo t('Sign Out')?></a></p>
            </div>
			<?php } else { ?> 


<style>
.login_block_form .loginTxt{ font-weight:bold }
.login_block_form .uNameWrap{ margin:8px 0px; }
.login_block_form .passwordWrap{ margin-bottom:8px;}
.login_block_form .login_block_register_link{margin-top:8px; font-size:11px}

</style>

<form class="login_block_form" method="post" action="<?php echo $loginURL?>">
	<?php  if($returnToSamePage ){ ?>
		<input type="hidden" name="rcID" id="rcID" value="<?php echo $c->getCollectionID(); ?>" />
	<?php  } ?>
	
	<div class="loginTxt"><?php echo t('Login')?></div>

	<div class="uNameWrap">
		<label for="uName"><?php  if (USER_REGISTRATION_WITH_EMAIL_ADDRESS == true) { ?>
			<?php echo t('Email Address')?>
		<?php  } else { ?>
			<?php echo t('Username')?>
		<?php  } ?></label><br/>
		<input type="text" name="uName" id="uName" <?php echo  (isset($uName)?'value="'.$uName.'"':'');?> class="ccm-input-text">
	</div>
	<div class="passwordWrap">
		<label for="uPassword"><?php echo t('Password')?></label><br/>
		<input type="password" name="uPassword" id="uPassword" class="ccm-input-text">
	</div>
	
	<div class="loginButton">
	<?php echo $form->submit('submit', t('Sign In') . ' &gt;')?>
	</div>	

	<?php  if($showRegisterLink){ ?>
		<div class="login_block_register_link"><a href="<?php echo View::url('/register')?>"><?php echo $registerText?></a></div>
	<?php  } ?>

</form>

			<?php } ?>  