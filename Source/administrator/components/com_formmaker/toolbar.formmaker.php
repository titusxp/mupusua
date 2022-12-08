<?php 
  
 /**
 * @package Form Maker
 * @author Web-Dorado
 * @copyright (C) 2011 Web-Dorado. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die('Restricted access');

require_once( JApplicationHelper::getPath( 'toolbar_html' ) );

switch ( $task )

{
	case 'themes'  :
	{
		TOOLBAR_formmaker::_THEMES();
	}
		break;
		
	case 'add_themes'  :
	case 'edit_themes'  :
	{
		TOOLBAR_formmaker::_NEW_THEMES();
	}
		break;
		
	case 'submits'  :
	{
		TOOLBAR_formmaker::_SUBMITS();
	}
		break;
		
	case 'edit_submit'  :
	{
		TOOLBAR_formmaker::EDIT_SUBMITS();
	}
		break;
		
	case 'add'  :
	case 'edit'  :	
	{
		TOOLBAR_formmaker::_NEW();
	}
		break;

	case 'form_options'  :
	case 'form_options_temp'  :
	{
	TOOLBAR_formmaker::_NEW_Form_options();
	}
	break;


	default:
		TOOLBAR_formmaker::_DEFAULT();
		break;

}

?>