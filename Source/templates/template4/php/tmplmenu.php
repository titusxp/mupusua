<?php 

//  Copyright:  (C) 03.2008 joomla-best.com. All Rights Reserved.
//  License:	GNU/GPL 
//  Website: 	http://www.joomla-best.com

$document = &JFactory::getDocument();
$renderer = $document->loadRenderer( 'module' );
$options = array( 'style' => "raw" );
$module = JModuleHelper::getModule( 'mod_mainmenu' );
$main_menu = false;
$main_submenu = false;
$module->params = "menutype=$menu_name\nshowAllChildren=1";
$main_menu = $renderer->render( $module, $options );

