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

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

?>

<div id="system" class="<?php $this->pageclass_sfx; ?>">

	<?php if ($this->params->get('show_page_heading', 1)) : ?>
	<h1 class="title"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	<?php endif; ?>
	
	<?php
		if ($this->params->get('show_base_description')) {
		
			//If there is a description in the menu parameters use that
			if($this->params->get('categories_description')) {
				JHtml::_('content.prepare',$this->params->get('categories_description'));
			} else {
				
				//Otherwise get one from the database if it exists
				if ($this->parent->description) {
					echo '<div class="category-desc">'.JHtml::_('content.prepare', $this->parent->description).'</div>';
				}
				
			}
		}
	?>
	
	<?php echo $this->loadTemplate('items'); ?>

</div>