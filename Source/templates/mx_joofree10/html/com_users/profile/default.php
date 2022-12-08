<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tooltip');
?>

<div id="system" class="<?php $this->pageclass_sfx; ?>">
	
	<?php if ($this->params->get('show_page_heading')) : ?>
	<h1 class="title"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	<?php endif; ?>

	<?php echo $this->loadTemplate('core'); ?>

	<?php echo $this->loadTemplate('params'); ?>

	<?php echo $this->loadTemplate('custom'); ?>

	<?php if (JFactory::getUser()->id == $this->data->id) : ?>
	<a href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id='.(int) $this->data->id);?>"><?php echo JText::_('COM_USERS_Edit_Profile'); ?></a>
	<?php endif; ?>

</div>