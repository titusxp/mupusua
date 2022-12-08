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

	<?php if ($this->params->get('page_subheading')) : ?>
	<h2 class="subtitle"><?php echo $this->escape($this->params->get('page_subheading')); ?></h2>
	<?php endif; ?>

	<?php if ($this->params->get('show_category_title', 1)) : ?>
	<h1 class="title"><?php echo $this->category->title;?></h1>
	<?php endif; ?>

	<?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) :?>
	<div class="description">
		<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
			<img src="<?php echo $this->category->getParams()->get('image'); ?>" alt="<?php echo $this->category->getParams()->get('image'); ?>" class="align-right" />
		<?php endif; ?>
		<?php if ($this->params->get('show_description') && $this->category->description) echo JHtml::_('content.prepare', $this->category->description); ?>
	</div>
	<?php endif; ?>

	<?php echo $this->loadTemplate('articles'); ?>

	<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
	<div class="cat-children">
		<h3>
			<?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?>
		</h3>

		<?php echo $this->loadTemplate('children'); ?>
	</div>
	<?php endif; ?>
</div>