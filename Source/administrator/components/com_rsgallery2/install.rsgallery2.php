<?php
/**
* This file contains the install routine for RSGallery2
* @version $Id: install.rsgallery2.php 1011 2011-01-26 15:36:02Z mirjam $
* @package RSGallery2
* @copyright (C) 2003 - 2006 RSGallery2
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* RSGallery is Free Software
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

function com_install(){
	$database =& JFactory::getDBO();
	
	$lang =& JFactory::getLanguage();
	$lang->load('com_rsgallery2');
	
	require_once( JPATH_SITE . '/administrator/components/com_rsgallery2/includes/install.class.php' );
	
	//Initialize install
	$rsgInstall = new rsgInstall();
	
	//Change the menu icon - no longer needed for version 3.x
//	$rsgInstall->changeMenuIcon();
	
	//Initialize rsgallery migration
	$migrate_com_rsgallery = new migrate_com_rsgallery();
	
	//If previous version detected
	if( $migrate_com_rsgallery->detect() ){
		// now that we know a previous rsg2 was installed, we need to reload it's config
		global $rsgConfig;
		$rsgConfig = new rsgConfig();

		$rsgInstall->writeInstallMsg( JText::sprintf('COM_RSGALLERY2_MIGRATING_FROM_RSGALLERY2', $rsgConfig->get( 'version' )) , 'ok');		
		
		//Migrate from earlier version
		$result = $migrate_com_rsgallery->migrate();
		
		if( $result === true ){
			$rsgInstall->writeInstallMsg( JText::sprintf('COM_RSGALLERY2_SUCCESS_NOW_USING_RSGALLERY2', $rsgConfig->get( 'version' )), 'ok');
		}
		else{
			$result = print_r( $result, true );
			$rsgInstall->writeInstallMsg( JText::_('COM_RSGALLERY2_FAILURE')."\n<br><pre>$result\n</pre>", 'error');
		}
	}
	else{
		//No earlier version detected, do a fresh install
		$rsgInstall->freshInstall();
	}
}