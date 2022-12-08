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

class mod_vt_cu3ox_slideshowInstallerScript
{
	/**
	 * Function to act prior to installation process begins
	 * 
	 * @param	(string)	$type	The action being performed
	 * @param	(string)	$parent	The function calling this method
	 * 
	 * @return	(mixed)		Boolean false on failure, void otherwise
	 * 
	 */
	function preflight($type, $parent)
	{
		// Installing extension manifest file version
		$this->release = $parent->get('manifest')->version;
		
		if ($type == 'update')
		{
			$oldRelease = $this->getParam('version');
			
			if(version_compare($oldRelease, '2.5.5', 'le'))
			{
				// Remove the directory '[module]/helper'
				$folder = JPATH_ROOT . '/modules/mod_vt_cu3ox_slideshow/helper';
				$folder = JPath::clean($folder);
				if( file_exists( $folder ) ) JFolder::delete( $folder );
				
				// Old language files
				$files[] = JPATH_ROOT . '/language/en-GB/en-GB.mod_vt_cu3ox_slideshow.ini';
				$files[] = JPATH_ROOT . '/language/en-GB/en-GB.mod_vt_cu3ox_slideshow.sys.ini';
				// Colorpicker files
				$files[] = JPATH_ROOT . '/modules/mod_vt_cu3ox_slideshow/fields/colorpicker.php';
				$files[] = JPATH_ROOT . '/media/mod_vt_cu3ox_slideshow/js/colorpicker-uncompressed.js';
				$files[] = JPATH_ROOT . '/media/mod_vt_cu3ox_slideshow/js/colorpicker.js';
				// Other files
				$files[] = JPATH_ROOT . '/media/mod_vt_cu3ox_slideshow/templates/samplecu3ox.png';
				$files[] = JPATH_ROOT . '/media/mod_vt_cu3ox_slideshow/intro.html';
				
				// Remove old files
				foreach($files as $file)
				{
					$file = JPath::clean($file);
					if( file_exists( $file ) ) JFile::delete( $file );
				}
				
				// Fix old prameters
				self::fixParams($oldRelease);
			}
			else
			{
				// Todo: Warning Version
			}
		}
	}
	
	/**
	 * This function is run after the extension is registered in the database.
	 * 
	 * @param	(string)	$type	The action being performed
	 * @param	(string)	$parent	The function calling this method
	 * 
	 * @return	(mixed)		Boolean false on failure, void otherwise
	 * 
	 */
	function postflight( $type, $parent )
	{
		// $link = "index.php?option=com_modules&filter_module=mod_vt_cu3ox_slideshow";
	}
	
	/**
	 * Fix some parameters of older versions
	 * 
	 * @param	(string)	$oldRelease	The old version
	 * 
	 */
	function fixParams($oldRelease)
	{
		if(version_compare($oldRelease, '2.5.5', 'gt')) return;

		// Read the existing extension value(s)
		// Get a db connection.
		$db = JFactory::getDbo();
		
		// Create a new query object.
		$query = $db->getQuery(true);
		
		$query
			->select('params')
			->from('#__extensions')
			->where('type = \'module\' AND element = \'mod_vt_cu3ox_slideshow\'');
		
		$db->setQuery($query);
		
		// Get the parameters from JSON string
		$params = json_decode( $db->loadResult(), true );
		
		// Replace the parameter 'item_dir'
		$param	= trim($params['item_dir']);
		$param	= "images/$param";
		if(file_exists(JPATH_ROOT . "/$param"))
		{
			$params['item_dir'] = $param;
		}
		
		// Replace the parameter 'swfobject_version'
		$param	= trim($params['swfobject_version']);
		$param	= ($param == 'latest') ? '2.2' : $param;
		$params['swfobject_version'] = $param;
		
		// Store the combined new and existing values back as a JSON string
		$paramsString = json_encode( $params );
		
		$query
			->update('#__extensions')
			->set('params = ' . $db->quote( $paramsString ))
			->where('type = \'module\' AND element = \'mod_vt_cu3ox_slideshow\'');
		$db->setQuery($query);
		$db->query();
	}
}
