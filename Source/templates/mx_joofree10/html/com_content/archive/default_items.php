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

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');
$params = &$this->params;

?>

<div class="items">

	<?php foreach ($this->items as $i => $item) : ?>
	<div class="item">

		<h1 class="title">
	
			<?php if ($params->get('link_titles')): ?>
				<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug,$item->catslug)); ?>" title="<?php echo $this->escape($item->title); ?>"><?php echo $this->escape($item->title); ?></a>
			<?php else : ?>
				<?php echo $this->escape($item->title); ?>
			<?php endif; ?>
	
		</h1>

		<?php if ($params->get('show_create_date') || ($params->get('show_author') && !empty($this->item->author)) || $params->get('show_category')) : ?>
		<p class="meta">
	
			<?php
				
				if ($params->get('show_author') && !empty($item->author )) {
					
					$author = $item->author;
					$author = ($item->created_by_alias ? $item->created_by_alias : $author);
					
					if (!empty($item->contactid ) &&  $params->get('link_author') == true) {
						echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHTML::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$item->contactid),$author));
					} else {
						echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author);
					}
	
				}
		
				if ($params->get('show_create_date')) {
					echo ' '.JText::_('TPL_WARP_ON').' '.JHTML::_('date',$item->created, JText::_('DATE_FORMAT_LC2'));
				}
	
				echo '. ';
	
				if ($params->get('show_category')) {
					echo JText::_('TPL_WARP_POSTED_IN').' ';
					$title = $this->escape($item->category_title);
					$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug)).'">'.$title.'</a>';
					if ($params->get('link_category')) {
						echo $url;
					} else {
						echo $title;
					}
				}
	
			?>	
		
		</p>
		<?php endif; ?>

		
		<?php if ($params->get('show_intro')) :?>
		<div class="intro"> <?php echo JHtml::_('string.truncate', $item->introtext, $params->get('introtext_limit')); ?> </div>
		<?php endif; ?>
		<?php if (($params->get('show_modify_date')) or ($params->get('show_publish_date'))  or ($params->get('show_hits'))) : ?>
		<div class="article-info muted">
			<?php if ($params->get('show_modify_date')) : ?>
			<div class="modified"><i class="icon-calendar"></i> <?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $item->modified, JText::_('DATE_FORMAT_LC3'))); ?> </div>
			<?php endif; ?>
			<?php if ($params->get('show_publish_date')) : ?>
			<div class="published"><i class="icon-calendar"></i> <?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?> </div>
			<?php endif; ?>
			<?php if ($params->get('show_hits')) : ?>
			<div class="hits"><i class="icon-eye-open"></i> <?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $item->hits); ?> </div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

	</div>
	<?php endforeach; ?>

</div>
<div class="pagination">
	<p class="counter"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
	<?php echo $this->pagination->getPagesLinks(); ?> </div>