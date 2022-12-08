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

class modVtCu3oxSlideshowHelper
{

	function __construct()
	{
	}

	/**
	 * Valid some parameters
	 * 
	 * @param	array	&$params
	 * 
	 */
	public static function validParams( &$params )
	{
		// Check the Dimension of your images
		$param	= (int) $params->get('ImageWidth');
		$param	= ($param) ? $param : '640';
		$params->set('ImageWidth', $param);
		
		$param	= (int) $params->get('ImageHeight');
		$param	= ($param) ? $param : '480';
		$params->set('ImageHeight', $param);
		
		// Check the Number of Segments
		$param	= (int) $params->get('Segments', '0');
		if( !$param )
		{
			$param = (int) $params->get('SegmentsMax', '10');
			$params->set('Segments', rand(1,$param));
		}
		else
		{
			$params->set('SegmentsDefault', $param);
		}
		
		// Check the Transition Type
		$TweenType	= "linear,"
					. "easeInQuad,easeOutQuad,easeInOutQuad,easeOutInQuad,"
					. "easeInCubic,easeOutCubic,easeInoutCubic,easeOutInCubic,"
					. "easeInQuart,easeOutQuart,easeInOutQuart,easeOutInQuart,"
					. "easeInQuint,easeOutQuint,easeInOutQuint,easeOutInQuint,"
					. "easeInSine,easeOutSine,easeInOutSine,easeOutInSine,"
					. "easeInExpo,easeOutExpo,easeInOutExpo,easeOutInExpo,"
					. "easeInCirc,easeOutCirc,easeInOutCirc,easeOutInCirc,"
					. "easeInElastic,easeOutElastic,easeInOutElastic,easeOutInElastic,"
					. "easeInBack,easeOutBack,easeInOutBack,easeOutInBack,"
					. "easeInBounce,easeOutBounce,easeInOutBounce,easeOutInBounce";

		$TweenType	= explode(",", $TweenType);
		$param	= $params->get('TweenType', 'random');
		$param	= ( $param == 'random' ) ? $TweenType[array_rand($TweenType, 1)] : $param;
		$params->set('TweenType', $param);
		
		// Check the Duration and Delay Time of Transitions
		$param	= trim($params->get('TweenTime', '1.2'));
		$param	= str_replace(',', '.', $param);
		$params->set('TweenTime', $param);
		
		$param	= trim($params->get('TweenDelay', '0.1'));
		$param	= str_replace(',', '.', $param);
		$params->set('TweenDelay', $param);
		
		// Check the Distance, Expand
		$param	= (int) $params->get('ZDistance', '0');
		$params->set('ZDistance', $param);
		
		$param	= (int) $params->get('Expand', '20');
		$params->set('ZDistance', $param);
		
		// Check Color Format. Make sure that the prefix is '0x'
		$param	= $params->get('InnerColor', '#FFFFFF');
		$param	= '0x'.ltrim($param, '#');
		$params->set('InnerColor', $param);
		
		$param	= $params->get('TextBackground', '#FFFFFF');
		$param	= '0x'.ltrim($param, '#');
		$params->set('TextBackground', $param);
		
		$param	= $params->get('StartBackground', '#FFFFFF');
		$param	= '0x'.ltrim($param, '#');
		$params->set('StartBackground', $param);
		
		// Check the Logo File, Logo Text and Logo Link
		$param	= trim($params->get('LogoFile'));
		$param	= $param ? $param : '/media/mod_vt_cu3ox_slideshow/images/logo.png';
		$param	= JPath::clean("/$param", "/");
		$param	= JURI::base(true) . $param;
		$params->set('LogoFile', $param);
		
		// Remove http(s) if exist in Logo's Link
		$param	= trim($params->get('LogoLink'));
		$param	= preg_replace('/^(?i)(https?):\/\//', '', $param);
		$params->set('LogoLink', $param);
		
		// Convert ShowControls parameter to boolean type
		$param = $params->get('ShowControls', '1');
		$param = (($param == '1') || ($param == 'true')) ? 'true' : 'false';
		$params->set('ShowControls', $param);
		
		// Check the Audio File
		$param	= trim($params->get('SoundFile'));
		$param	= JPath::clean("/$param", "/");
		$param	= JURI::base(true) . $param;
		$params->set('SoundFile', $param);
		
		$param	= trim($params->get('HeadFontSize', '16'));
		$param	= rtrim($param, 'px').'px';
		$params->set('HeadFontSize', $param);
		
		$param	= trim($params->get('ParaFontSize', '12'));
		$param	= rtrim($param, 'px').'px';
		$params->set('ParaFontSize', $param);
		
		return;
	}
	
	/**
	 * Make the XML, CSS, SWF files for Cu3ox Slideshow
	 * 
	 * @param	array	&$params
	 * @param	integer	$module_id
	 */
	public static function makeFiles( &$params, $module_id )
	{
		$module_id = (int) $module_id;

		// Make a directory /media/mod_vt_cu3ox_slideshow/[module_id]/ and needed folders/files if not exist
		$path	= JPATH_BASE . "/media/mod_vt_cu3ox_slideshow/$module_id";
		$path	= JPath::clean($path);

		if( !is_dir($path) )
		{
			$buffer = "<!DOCTYPE html><title></title>\n";
			JFile::write( "$path/index.html", $buffer);
			JFile::write( "$path/engine/index.html", $buffer);
		}
		
		$EnginePath	= "$path/engine";
		$EnginePath	= JPath::clean($EnginePath);
		$params->set('EnginePath', $EnginePath);
		
		$EngineURL	= JURI::base(true) . "/media/mod_vt_cu3ox_slideshow/$module_id/engine";
		$EngineURL	= JPath::clean($EngineURL, '/');
		$params->set('EngineURL', $EngineURL);
		
		$cache_time	= (int) $params->get('cache_time', '900');
		$lastedit	= $params->get('lastedit');
		$log		= $EnginePath . "/$lastedit.log";
		
		// The log file does exist or not. If exists then find the created time
		if( !is_file($log) || ( (int) file_get_contents($log) + $cache_time < time()) )
		{
			self::validParams($params);
			self::_makeImageSettings($params);

			self::_makeXML($params);
			self::_makeCSS($params);
			self::_makeSWF($params);
			
			// Remove old log file
			$filter		= '(^[0-9]+\.log$)';
			$exclude	= array("$lastedit.log");
			$files		= JFolder::files($EnginePath, $filter, true, true, $exclude);
			if(count($files)) JFile::delete($files);
			
			// Log the current time
			JFile::write($log, time());
		}
		return;
	}
	
	/**
	 * Make the Cu3ox SWF file in the directory /media/mod_vt_cu3ox_slideshow/[id]/engine/
	 * 
	 * @param	array	$params
	 */
	private static function _makeSWF( $params )
	{
		$src	= JPATH_BASE . '/media/mod_vt_cu3ox_slideshow/templates/cu3ox.swf';
		$src	= JPath::clean($src);
		
		$dest	= $params->get('EnginePath') . '/vt_cu3ox_slideshow.swf';
		$dest	= JPath::clean($dest);
		
		JFile::copy($src, $dest);
	}

	/**
	 * Make the Config XML file in the directory /media/mod_vt_cu3ox_slideshow/[id]/engine/
	 * 
	 * @param	array	$params
	 */	
	private static function _makeXML( $params )
	{

		$path	= JPATH_BASE . '/media/mod_vt_cu3ox_slideshow/templates/cu3oxXML.xml';
		$path	= JPath::clean( $path );
		
		$str	= file_get_contents( $path );
		
		// Replace XML variables
		$str	= preg_replace( "/\\$(\w+)\\$/e", '$params->get("$1")', $str );
		
		$node	= new SimpleXMLElement($str);
		
		// Make file XML
		$path	= $params->get('EnginePath') . '/vt_cu3ox_slideshowXML.xml';
		$path	= JPath::clean( $path );
		
		JFile::write( $path, $node->asXML() );
	}
	
	/**
	 * Make the Main CSS file in the directory /media/mod_vt_cu3ox_slideshow/[id]/engine/
	 * 
	 * @param	array	$params
	 */
	private static function _makeCSS( $params )
	{
		
		$path	= JPATH_BASE . '/media/mod_vt_cu3ox_slideshow/templates/cu3oxCSS.css';
		$path	= JPath::clean( $path );
		
		$str	= file_get_contents( $path );
		
		// Replace CSS variables
		$str	= preg_replace( "/\\$(\w+)\\$/e", '$params->get("$1")', $str );
		
		// Make file CSS
		$path	= $params->get('EnginePath') . '/vt_cu3ox_slideshowCSS.css';
		$path	= JPath::clean( $path );
		
		JFile::write( $path, $str );
	}
	
	/**
	 * Make the List of Image Settings
	 * 
	 * @param	array	$params
	 */
	private static function _makeImageSettings( &$params )
	{
		$str = '';
		
		// Create Element - <Cu3ox>
		$node = new SimpleXMLElement('<Cu3ox />');
		
		// Get all relative paths of images
		$images = self::getItems($params);
		
		// Do nothing if not found any images
		if( !is_array($images) || !count($images) ) return;

		// If found any images
		foreach($images as $position=>$image)
		{
			// Create Element - <Cu3ox>.<Image>
			$nodeL1 =& $node->addChild('Image');
			$nodeL1->addAttribute('Filename', $image);

			// Create Element - <Cu3ox>.<Image>.<Settings>
			$nodeL2 =& $nodeL1->addChild('Settings');
			
			// Create Element - <Cu3ox>.<Image>.<Settings>.<goLink>
			$param	= $params->get('item_url');
			$param	= self::getParam($param, $position+1, "\n");
			$param	= trim($param);
			$nodeL3 =& $nodeL2->addChild('goLink', $param);
			$nodeL3->addAttribute('target', $params->get('item_target'));
		
			// Create Element - <Cu3ox>.<Image>.<Settings>.<rDirection>
			$param	= $params->get('item_rdirection');
			$param	= self::getParam($param, $position+1, "\n");
			$param	= strtolower(trim($param));
			$param	= ( in_array($param, array('left','right','up','down','random')) ) ? $param : $params->get('RDirection');
			$param	= ($param != 'random') ? $param : '';
			$nodeL3 =& $nodeL2->addChild('rDirection', $param);
		
			// Create Element - <Cu3ox>.<Image>.<Settings>.<segments>
			$param	= $params->get('item_segments', '0');
			$param	= self::getParam($param, $position+1, "\n");
			$param	= (int) $param;
			
			$SegmentsDefault	= (int) $params->get('SegmentsDefault');
			$SegmentsMax		= (int) $params->get('SegmentsMax');
			$param	= ($param) ? $param : $SegmentsDefault ;
			
			$param	= ($param) ? $param : mt_rand(1, $SegmentsMax);
			$nodeL3 =& $nodeL2->addChild('segments', $param);
			
			// Create Element - <Cu3ox>.<Image>.<Text>
			$nodeL2 =& $nodeL1->addChild('Text');
				
			// Create Element - <Cu3ox>.<Image>.<Text>.<headline>
			$param	= $params->get('item_title');
			$param	= self::getParam($param, $position+1, "\n");
			$nodeL3 =& $nodeL2->addChild('headline', $param);
			
			// Create Element - <Cu3ox>.<Image>.<Text>.<paragraph>
			$param	= $params->get('item_description');
			$param	= self::getParam($param, $position+1, "\n");
			$nodeL3 =& $nodeL2->addChild('paragraph', $param);
			
			$str .= $nodeL1->asXML();
		}

		$params->set('ImageList', $str);
		return;
	}

	/**
	 * Get the First Image
	 * 
	 * @param	array	$params
	 */
	public static function getFirstItem( $params )
	{
		// Get all relative paths of images
		$images = self::getItems($params);
		
		if( is_array($images) && count($images) ) return $images[0];
		return '';
	}

	/**
	 * Get the Paths of Items
	 * 
	 * @param	array	$params
	 */
	public static function getItems( $params )
	{
		jimport('joomla.filesystem.folder');

		$param	= $params->get('item_path');
		$param	= str_replace(array("\r\n","\r"), "\n", $param);
		$param	= explode("\n", $param);

		// Get Paths from invidual paths
		foreach($param as $key=>$value)
		{
			$param[$key] = self::validPath($value);
		}

		// Remove empty element
		$param = array_filter($param);

		// Get Paths from directory
		if (empty($param))
		{
			$param	= $params->get('item_dir');
			$param	= trim($param);
			if (!$param || $param == '-1') return null;
			
			$dir	= JPath::clean(JPATH_BASE . "/$param");
			if(!is_dir($dir)) return null;

			$filter		= '([^\s]+(\.(?i)(jpg|png|gif|bmp))$)';
			$exclude	= array('index.html', '.svn', 'CVS', '.DS_Store', '__MACOSX', '.htaccess');
			$excludefilter = array();

			$param	= JFolder::files($dir, $filter, true, true, $exclude, $excludefilter);
			foreach($param as $key=>$value)
			{
				$value = substr($value, strlen(JPATH_BASE . DIRECTORY_SEPARATOR) - strlen($value));
				$param[$key] = self::validPath($value);
			}
		}

		// Reset keys
		$param = array_values($param);
		return $param;
	}

	/**
	 * Get the Valid Path of Item
	 * 
	 * @param	string	$path
	 */
	public static function validPath($path)
	{
		$path = trim($path);

		// Check file type is image or not
		if( !preg_match('/[^\s]+(\.(?i)(jpg|png|gif|bmp))$/', $path) ) return '';

		// Remove the protocol http(s) if exists
		if( preg_match('/^(?i)(https?):\/\//', $path) )
		{
			$base = JURI::base(false);
			if (substr($path, 0, strlen($base)) == $base)
			{
				$path = substr($path, strlen($base) - strlen($path));
			}
			else return $path;
		}

		// The path not includes http(s)
		$path = JPath::clean($path);
		$path = ltrim($path, DIRECTORY_SEPARATOR);
		
		if (!is_file($path))
		{
			if (!is_file(dirname(JPATH_BASE) . DIRECTORY_SEPARATOR . $path)) return '';
			else
			{
				$path = JPath::clean("/$path", "/");
			}
		}
		else
		{
			// Convert it to url path
			$path = JPath::clean(JURI::base(true)."/$path", "/");
		}

		return $path;
	}
	
	/**
	 * Get a Parameter in a Parameters String which are separated by a specify symbol (default: vertical bar '|').
	 * Example: Parameters = "value1 | value2 | value3". Return "value2" if position = 2
	 *
	 * @param	string		$param
	 * @param	integer		$position
	 * @param	character	$separator
	 */
	public static function getParam($param, $position=1, $separator='|')
	{
		$position = (int) $position;
		
		// Not found the separator in string
		if( strpos($param, $separator) === false )
		{
			if ( $position == 1 ) return $param;
		}
		// Found the separator in string
		else
		{
			$param = ($separator == "\n") ? str_replace(array("\r\n","\r"), "\n", $param) : $param;
			$items = explode($separator, $param);
			if ( ($position > 0) && ($position < count($items)+1) ) return $items[$position-1];
		}
		
		return '';
	}

	/**
	 * Add SWFObject Library to <head> tag
	 * 
	 * @param	string	$source
	 * @param	string	$version
	 */
	public static function addSWFObject($source='local', $version='2.2')
	{
		switch($source)
		{
			case 'local':
				JHtml::script("media/mod_vt_cu3ox_slideshow/js/swfobject/$version/swfobject.js");
				break;

			case 'google':
				JHtml::script("http://ajax.googleapis.com/ajax/libs/swfobject/$version/swfobject.js");
				break;

			default:
				return false;
		}
		return true;

	}
	
}
