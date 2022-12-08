<?php
/**
 * @package		Vinaora Cu3ox Slideshow
 * @subpackage	mod_vt_cu3ox_slideshow
 * @copyright	Copyright (C) 2012-2013 VINAORA. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @website		http://vinaora.com
 * @twitter		https://twitter.com/vinaora
 * @facebook	https://www.facebook.com/pages/Vinaora/290796031029819
 * @google+		https://plus.google.com/111142324019789502653/
 */
 
// no direct access
defined('_JEXEC') or die;

// Require the base helper class only once
require_once dirname(__FILE__) . '/helper.php';

$FirstImage	= modVtCu3oxSlideshowHelper::getFirstItem( $params );

// Not found any images
if(!$FirstImage)
{
	$params->set('layout', '_notfound');
}
// Found the images
else
{
	// Load SWFObject library, if not loaded before
	if(!JFactory::getApplication()->get('swfobject'))
	{
		$sobjsource		= $params->get('swfobject_source', 'local');
		$sobjversion	= $params->get('swfobject_version', '2.2');
		modVtCu3oxSlideshowHelper::addSWFObject( $sobjsource, $sobjversion );
		
		JFactory::getApplication()->set('swfobject', true);
	}

	$module_id	= $module->id;
	modVtCu3oxSlideshowHelper::makeFiles( $params, $module_id );

	$swf			= $params->get('EngineURL') . '/vt_cu3ox_slideshow.swf';

	$ImageWidth		= $params->get('ImageWidth');
	$ImageHeight	= $params->get('ImageHeight');

	$FirstImage		= "<img src=\"$FirstImage\" alt=\"Vinaora Cu3ox Slideshow\" width=\"$ImageWidth\" height=\"$ImageHeight\"/>";

	if($params->get('NoShadow'))
	{
		$PanelWidth		= $ImageWidth;
		$PanelHeight	= $ImageHeight;
	}
	else
	{
		$PanelWidth		= (int) $ImageWidth + 2*$params->get('MarginHoz', '70');
		$PanelHeight	= (int) $ImageHeight + 2*$params->get('MarginVer', '70');
	}

	$zindex	= $params->get('zindex', 'auto');
	$zindex	= ($zindex == 'auto') ? $zindex : (int) $zindex;

	// Todo: Add SWFObject param
	$flash_wmode = $params->get('flash_wmode', 'transparent');
}

require JModuleHelper::getLayoutPath('mod_vt_cu3ox_slideshow', $params->get('layout', 'default'));
