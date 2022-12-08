<?php

defined('_JEXEC') or die('Restricted access');

$return = base64_encode(base64_decode($return).'#content');

if ($type == 'logout') : ?>
<form action="index.php" method="post" name="login" class="log">
	<?php if ($params->get('greeting')) : ?>
	<p>
		<?php echo JText::sprintf('HINAME', $user->get('name')); ?>
	</p>
	<?php endif; ?>
	<p>
		<input type="submit" name="Submit" class="button" value="<?php echo JText::_('BUTTON_LOGOUT'); ?>" />
	</p>
	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="logout" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
</form>
<?php else : ?>
<form action="index.php" method="post" name="login" class="mtlogin">
	<?php if ($params->get('pretext')) : ?>
	<p>
		<?php echo $params->get('pretext'); ?>
	</p>
	<?php endif; ?>
	<fieldset style="border:none;">
		
		
		
		<label for="mod_login_username">
			<?php echo JText::_('User Name'); ?>
		</label>
		
		<input name="username" id="mod_login_username" type="text" class="inputbox" value="Username..."  onblur="if(this.value=='') this.value='Username...';" onfocus="if(this.value=='Username...') this.value='';" alt="<?php echo JText::_('Username'); ?>" />
		
		<label for="mod_login_password">
			<?php echo JText::_('Password'); ?>
		</label>
		<input type="password" id="mod_login_password" name="passwd" class="inputbox" value="Password..."  onblur="if(this.value=='') this.value='Password...';" onfocus="if(this.value=='Password...') this.value='';"  alt="<?php echo JText::_('Password'); ?>" />
		
		<input type="submit" name="Submit" class="button" value="<?php echo JText::_('BUTTON_LOGIN'); ?>" />
	
	
	
	</fieldset>
		
	<div>
		
	
		<a class="mtlogin_reset" href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>"><?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?><span></span></a>
		<a class="mtlogin_remind" href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>"><?php echo JText::_('FORGOT_YOUR_USERNAME'); ?><span></span></a>
       
		
		<?php $usersConfig =& JComponentHelper::getParams('com_users');
	if ($usersConfig->get('allowUserRegistration')) : ?>
		 
		 <a class="mtlogin_register" href="<?php echo JRoute::_( 'index.php?option=com_user&task=register' ); ?>"><?php echo JText::_('REGISTER'); ?><span></span></a>
    
		
	</div>
	<?php endif;	
	echo $params->get('posttext'); ?>
	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>

<?php endif;
