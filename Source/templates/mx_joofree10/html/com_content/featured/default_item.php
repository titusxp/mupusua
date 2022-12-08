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

// Create a shortcut for params.
$params		= &$this->item->params;
$canEdit	= $this->item->params->get('access-edit');

?>

<div class="item">

	<?php if ($params->get('show_email_icon')) : ?>
	<div class="icon email"><?php echo JHtml::_('icon.email', $this->item, $params); ?></div>
	<?php endif; ?>

	<?php if ($params->get('show_print_icon')) : ?>
	<div class="icon print"><?php echo JHtml::_('icon.print_popup', $this->item, $params); ?></div>
	<?php endif; ?>

<?php if ($params->get('show_title')) : ?>
<div class="title<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<h2>
<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
<?php
$item_title = $this->item->title;
$item_title = explode(' ', $item_title);
$item_title[0] = '<span>'.$item_title[0].'</span>';
$item_title= join(' ', $item_title);
echo $item_title; 
?>
</a>
<?php else : ?>
<?php
$item_title = $this->item->title;
$item_title = explode(' ', $item_title);
$item_title[0] = '<span>'.$item_title[0].'</span>';
$item_title= join(' ', $item_title);
echo $item_title; 
?>
<?php endif; ?>
</h2>
</div>
<?php endif; ?>

	<?php if ($params->get('show_create_date') || ($params->get('show_author') && !empty($this->item->author)) || $params->get('show_category')) : ?>
	<p class="meta">

		<?php
			
			if ($params->get('show_author') && !empty($this->item->author )) {
				
				$author =  $this->item->author;
				$author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);
				
				if (!empty($this->item->contactid ) &&  $params->get('link_author') == true) {
					echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHTML::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid),$author));
				} else {
					echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author);
				}

			}
	
			if ($params->get('show_create_date')) {
				echo ' '.JText::_('TPL_WARP_ON').' '.JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC2'));
			}

			echo '. ';

			if ($params->get('show_category')) {
				echo JText::_('TPL_WARP_POSTED_IN').' ';
				$title = $this->escape($this->item->category_title);
				$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';
				if ($params->get('link_category')) {
					echo $url;
				} else {
					echo $title;
				}
			}

		?>	
	
	</p>
	<?php endif; ?>

	<?php
	
		if (!$params->get('show_intro')) {
			echo $this->item->event->afterDisplayTitle;
		}
	
		echo $this->item->event->beforeDisplayContent;

	?>

	<div class="content"><?php echo $this->item->introtext; ?></div>

	<?php if ($params->get('show_readmore') && $this->item->readmore) : ?>
	<p class="links">
	
		<?php
		
			if ($params->get('access-view')) {
				$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
			} else {
				$menu = JFactory::getApplication()->getMenu();
				$active = $menu->getActive();
				$itemId = $active->id;
				$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
				$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug));
				$link = new JURI($link1);
				$link->setVar('return', base64_encode($returnURL));
			}
			
		?>

		<a href="<?php echo $link; ?>" title="<?php echo $this->escape($this->item->title); ?>">
			<?php
				
				if (!$params->get('access-view')) {
					echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
				} elseif ($readmore = $this->item->alternative_readmore) {
					echo $readmore;
				} else {
					echo JText::_('TPL_WARP_CONTINUE_READING');
				}
				
			?>
		</a>
		
	</p>
	<?php endif; ?>

	<?php if ($canEdit) : ?>
	<p class="edit"><?php echo JHtml::_('icon.edit', $this->item, $params); ?> <?php echo JText::_('TPL_WARP_EDIT_ARTICLE'); ?></p>
	<?php endif; ?>

	<?php echo $this->item->event->afterDisplayContent; ?>
	
</div>