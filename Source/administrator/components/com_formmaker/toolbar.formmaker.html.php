<?php 
  
 /**
 * @package Form Maker
 * @author Web-Dorado
 * @copyright (C) 2011 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die('Restricted access');

	

	function cancel_secondary()
	{
		JToolBarHelper :: custom( 'cancel_secondary', 'cancel.png', '', 'Cancel', '', '' );
	}

	//////////////////////////////////////////////////	
	function edit_submit_text()
	{
		JToolBarHelper :: custom( 'edit_my_submit_text', 'edit.png', '', 'Actions after submission', '', '' );
	}
	
	function remove_submit()
	{
		JToolBarHelper :: custom( 'remove_submit', 'delete.png', '', 'Delete', '', '' );
	}

	function edit_submit()
	{
		JToolBarHelper :: custom( 'edit_submit', 'edit.png', '', 'Edit', '', '' );
	}
	
	function undo()
	{
		JToolBarHelper :: custom( 'undo', 'back.png', '', 'Undo', '', '' );
	}
	
	function redo()
	{
		JToolBarHelper :: custom( 'redo', 'forward.png', '', 'Redo', '', '' );
	}
	
///////////////////////////////////
	

	

class TOOLBAR_formmaker {

	function _THEMES() {
		$document =& JFactory::getDocument();		$document->addStyleSheet('components/com_formmaker/FormMakerLogo.css');		JToolBarHelper::title('Form Maker'.'<div style="float:right;padding-right: 15px; display:block"><a href="http://web-dorado.com/products/joomla-form.html" target="_blank" style=""><img src="components/com_formmaker/images/buyme.png" border="0" alt="http://web-dorado.com/files/fromSpiderCatalogJoomla.php" style="float:left"></a></div>', 'FormMakerLogo');		
		JToolBarHelper::makeDefault();
		JToolBarHelper::deleteList('Are you sure you want to delete? ', 'remove_themes');
		JToolBarHelper::editListX('edit_themes');
		JToolBarHelper::addNewX('add_themes');

	}
	
	function _NEW_Form_options() 
	{				$document =& JFactory::getDocument();		$document->addStyleSheet('components/com_formmaker/FormMakerLogo.css');		JToolBarHelper::title('Form Maker'.'<div style="float:right;padding-right: 15px; display:block"><a href="http://web-dorado.com/products/joomla-form.html" target="_blank" style=""><img src="components/com_formmaker/images/buyme.png" border="0" alt="http://web-dorado.com/files/fromSpiderCatalogJoomla.php" style="float:left"></a></div>', 'FormMakerLogo');		
		JToolBarHelper::save('save_form_options');
		JToolBarHelper::apply('apply_form_options');
		cancel_secondary();
	}


	function _NEW_THEMES() {		$document =& JFactory::getDocument();		$document->addStyleSheet('components/com_formmaker/FormMakerLogo.css');		JToolBarHelper::title('Form Maker'.'<div style="float:right;padding-right: 15px; display:block"><a href="http://web-dorado.com/products/joomla-form.html" target="_blank" style=""><img src="components/com_formmaker/images/buyme.png" border="0" alt="http://web-dorado.com/files/fromSpiderCatalogJoomla.php" style="float:left"></a></div>', 'FormMakerLogo');		
		JToolBarHelper::save('save_themes');
		JToolBarHelper::apply('apply_themes');
		JToolBarHelper::cancel('cancel_themes');		
	}
	
	function EDIT_SUBMITS()
	{		$document =& JFactory::getDocument();		$document->addStyleSheet('components/com_formmaker/FormMakerLogo.css');		JToolBarHelper::title('Form Maker'.'<div style="float:right;padding-right: 15px; display:block"><a href="http://web-dorado.com/products/joomla-form.html" target="_blank" style=""><img src="components/com_formmaker/images/buyme.png" border="0" alt="http://web-dorado.com/files/fromSpiderCatalogJoomla.php" style="float:left"></a></div>', 'FormMakerLogo');		
		JToolBarHelper::save('save_submit');
		JToolBarHelper::apply('apply_submit');
		JToolBarHelper::cancel('cancel_submit');		
	}
	
	function _SUBMITS() {$document =& JFactory::getDocument();		$document->addStyleSheet('components/com_formmaker/FormMakerLogo.css');		JToolBarHelper::title('Form Maker'.'<div style="float:right;padding-right: 15px; display:block"><a href="http://web-dorado.com/products/joomla-form.html" target="_blank" style=""><img src="components/com_formmaker/images/buyme.png" border="0" alt="http://web-dorado.com/files/fromSpiderCatalogJoomla.php" style="float:left"></a></div>', 'FormMakerLogo');		
		remove_submit();
		JToolBarHelper::editListX('edit_submit');
	}
	
	

	

	function _NEW() {		$document =& JFactory::getDocument();		$document->addStyleSheet('components/com_formmaker/FormMakerLogo.css');		JToolBarHelper::title('Form Maker'.'<div style="float:right;padding-right: 15px; display:block"><a href="http://web-dorado.com/products/joomla-form.html" target="_blank" style=""><img src="components/com_formmaker/images/buyme.png" border="0" alt="http://web-dorado.com/files/fromSpiderCatalogJoomla.php" style="float:left"></a></div>', 'FormMakerLogo');		
		JToolBarHelper :: custom( 'form_options_temp', 'options.png', '', 'Form Options', '', '' );	
		JToolBarHelper::save();
		JToolBarHelper :: custom( 'save_and_new', 'save.png', '', 'Save & New', '', '' );
		JToolBarHelper::apply();
		JToolBarHelper :: custom( 'save_as_copy', 'copy.png', '', 'Save as Copy', '', '' );
		JToolBarHelper::cancel();		
	}

	function _DEFAULT() {
		$document =& JFactory::getDocument();		$document->addStyleSheet('components/com_formmaker/FormMakerLogo.css');		JToolBarHelper::title('Form Maker'.'<div style="float:right;padding-right: 15px; display:block"><a href="http://web-dorado.com/products/joomla-form.html" target="_blank" style=""><img src="components/com_formmaker/images/buyme.png" border="0" alt="http://web-dorado.com/files/fromSpiderCatalogJoomla.php" style="float:left"></a></div>', 'FormMakerLogo');		
		JToolBarHelper::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy' );
		JToolBarHelper::deleteList();
		JToolBarHelper::editListX();
		JToolBarHelper::addNewX();

	}

}

?>