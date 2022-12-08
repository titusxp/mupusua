<?php
/**
 * @version		$Id: default.php 20196 2012-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

?>

<div id="system" class="<?php $this->pageclass_sfx; ?>">

	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<h1 class="title"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	<?php endif; ?>

	<form id="adminForm" action="<?php echo JRoute::_('index.php')?>" method="post">
	
		<div class="filter">
			<?php if ($this->params->get('filter_field') != 'hide') : ?>
			<div>
				<label for="filter-search"><?php echo JText::_('COM_CONTENT_'.$this->params->get('filter_field').'_FILTER_LABEL'); ?></label>
				<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->filter); ?>" onchange="document.jForm.submit();" />
			</div>
			<?php endif; ?>
		
			<div>
				<?php echo $this->form->monthField; ?>
				<?php echo $this->form->yearField; ?>
				<?php echo $this->form->limitField; ?>
				<button type="submit" class="button"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
			</div>
		</div>

	<button type="submit" class="btn btn-primary"><?php echo JText::_('JGLOBAL_FILTER_BUTTON'); ?></button>
	<input type="hidden" name="view" value="archive" />
	<input type="hidden" name="option" value="com_content" />
	<input type="hidden" name="limitstart" value="0" />
	
	</form>
	
	<?php echo $this->loadTemplate('items'); ?>

</div>