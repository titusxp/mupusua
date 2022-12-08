<?php
/**
* Maintenance options for RSGallery2
* @version $Id: maintenance.php 1085 2012-06-24 13:44:29Z mirjam $
* @package RSGallery2
* @copyright (C) 2003 - 2011 RSGallery2
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* RSGallery is Free Software
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( $rsgOptions_path . 'maintenance.html.php' );
require_once( $rsgOptions_path . 'maintenance.class.php' );

// Only those with core.manage can get here via $rsgOption = maintenance
// Check if core.admin is allowed
if (!JFactory::getUser()->authorise('core.admin', 'com_rsgallery2')) {
	JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	return;
} else {
	$cid = JRequest::getVar("cid", array(), 'default', 'array' );
	$task = JRequest::getVar( 'task', null);

	switch ($task) {
		/* Regenerate thumbs calls */
		case 'regenerateThumbs':
			HTML_RSGALLERY::RSGalleryHeader('cpanel', JText::_('COM_RSGALLERY2_MAINT_REGEN'));
			regenerateImages();
			HTML_RSGALLERY::RSGalleryFooter();
			break;
		case 'executeRegenerateThumbImages':
			executeRegenerateThumbImages();
			break;
		case 'executeRegenerateDisplayImages';
			executeRegenerateDisplayImages();
			break;
		/* Consolidate database calls */
		case 'consolidateDB':
			consolidateDB();
			break;
		case 'createImages':
			createImages();
			break;
		case 'deleteImages':
			deleteImages();
			break;
		case 'createDbEntries':
			createDbEntries();
			break;
			
		/* Optimize DB calls*/
		case 'optimizeDB':
			optimizeDB();
			break;
		
		/* Migration calls */
		case 'showMigration':
			HTML_RSGALLERY::RSGalleryHeader('cpanel', JText::_('COM_RSGALLERY2_MIGRATION_OPTIONS'));
			showMigration();
			HTML_RSGALLERY::RSGalleryFooter();
			break;
		case 'doMigration':
			doMigration();
			break;
			
		case 'test':
			test();
			break;
		default:
			HTML_RSGALLERY::RSGalleryHeader('cpanel', JText::_('COM_RSGALLERY2_MAINT_HEADER'));
			showMaintenanceCP( $option );
			HTML_RSGALLERY::RSGalleryFooter();
			break;
	}	// end task switch
}

function test() {
	// http://JOOMLA/administrator/index.php?option=com_rsgallery2&rsgOption=maintenance&task=test
	echo '<a href='.JRoute::_('index.php?option=com_rsgallery2&rsgOption=maintenance&task=test').'>function test() in admin/options/maintenance </a><p></p>';
	// Put test code here:
	
	//echo galleryUtils::newImages(1);
	
	




}// end of function test()

/**
 * Shows Migration main screen
 * It shows detected gallerysystem and offers a migration option
 */
function showMigration() {
    require_once(JPATH_RSGALLERY2_ADMIN.'/includes/install.class.php');
    
    //Initialize new install instance
    $rsgInstall = new rsgInstall();

    if (isset($_REQUEST['type']))
        $type = mosGetParam ( $_REQUEST, 'type'  , '');
    else
        $type = NULL;


	if( $type=='' ) {
		$rsgInstall->showMigrationOptions();	
	} else {
        $result = $rsgInstall->doMigration( $type );
        if( $result !==true ) {
            echo $result;
            HTML_RSGallery::showCP();
    	} else {
        	echo JText::_('COM_RSGALLERY2_MIGRATION_SUCCESSFUL');
        	HTML_RSGallery::showCP();
    	}
	}
}

function doMigration() {
	$type  	= JRequest::getVar('type', null);
	require_once(JPATH_RSGALLERY2_ADMIN.'/includes/install.class.php');
	
	$migrate_class = "migrate_".$type; 
	$migrate = new $migrate_class;
	$migrate->migrate();
}

/**
 * Shows Control Panel for maintenance of RSGallery2
 */
function showMaintenanceCP() {
	html_rsg2_maintenance::showMaintenanceCP();
}

function regenerateImages() {
	//Select the right gallery, multiple galleries or select them all
	$lists['gallery_dropdown'] = galleryUtils::galleriesSelectList(null, "gid[]", true, "MULTIPLE");
	
	html_rsg2_maintenance::regenerateImages($lists);
}
/**
 * Function will regenerate thumbs for a specific gallery or set of galleries
 * @todo Check if width really changed, else no resize needed. 
 * Perhaps by sampling the oldest thumb from the gallery and checking dimensions against current setting. 
 */
function executeRegenerateThumbImages() {
	global $rsgConfig;
	$mainframe =& JFactory::getApplication();
	$error = 0;
	$gid = JRequest::getVar( 'gid', array());
	if ( empty($gid) ) {
		$mainframe->redirect("index.php?option=com_rsgallery2&rsgOption=maintenance&task=regenerateThumbs", JText::_('COM_RSGALLERY2_NO_GALLERY_SELECTED'));
		return;
	}

	foreach ($gid as $id) {
    	if ($id > 0) {
    		//Check if resize is really needed. It takes a lot of resources when changing thumbs when dimensions did not change!
    		if ( !rsg2_maintenance::thumbSizeChanged($id) ) {
				$mainframe->redirect("index.php?option=com_rsgallery2&rsgOption=maintenance&task=regenerateThumbs", JText::_('COM_RSGALLERY2_THUMBNAIL_SIZE_DID_NOT_CHANGE_REGENERATION_NOT_NEEDED'));
				return;
			} else {
				$gallery = rsgGalleryManager::_get($id);
				$images = $gallery->items();
				foreach ($images as $image) {
					$imagename = imgUtils::getImgOriginal($image->name, true);
					if (!imgUtils::makeThumbImage($imagename)) {
						//Error counter
						$error++;
					}
				}
    		}
    	}
    }
    if ($error > 0) {
    	$msg = JText::_('COM_RSGALLERY2_MAINT_REGEN_ERRORS');
    } else {
		$msg = JText::_('COM_RSGALLERY2_MAINT_REGEN_NO_ERRORS');
    }
    $mainframe->redirect("index.php?option=com_rsgallery2&rsgOption=maintenance&task=regenerateThumbs", $msg);
}
/**
 * Function will regenerate display images for a specific gallery or set of galleries
 * @todo Check if width really changed, else no resize needed. 
 */
function executeRegenerateDisplayImages() {
	global $rsgConfig;
	$mainframe =& JFactory::getApplication();
	$error = 0;
	$gid = JRequest::getVar( 'gid', array());
	if ( empty($gid) ) {
		$mainframe->redirect("index.php?option=com_rsgallery2&rsgOption=maintenance&task=regenerateThumbs", JText::_('COM_RSGALLERY2_NO_GALLERY_SELECTED'));
		return;
	}

	foreach ($gid as $id) {
    	if ($id > 0) {
			$gallery = rsgGalleryManager::_get($id);
			$images = $gallery->items();
			foreach ($images as $image) {
				//Get full path of the original image, e.g. 
				//  "C:\xampp\htdocs\images\rsgallery\original\test space in name.jpg" or 
				//  "/public_html/httpdocs/images/rsgallery/original/test space in name.jpg"
				//  So get path not URL (2nd argument "local" false in getImgOriginal)
				//  clean it (get correct Directory Seperator and remove double slashes)
				//  and convert "%20" to spaces: " " with rawurldecode.
				$originalImageFullPath = imgUtils::getImgOriginal($image->name, true);
				$originalImageFullPath = rawurldecode(JPath::clean($originalImageFullPath));
				//Get the name of the image
				$parts = pathinfo( $originalImageFullPath );
				$newName = $parts['basename'];
				//Get the correct width for the display image
				$width = getimagesize( $originalImageFullPath );
				if( !$width ){
					//error (no width found)
					$mainframe->enqueueMessage(JText::sprintf('COM_RSGALLERY2_COULD_NOT_CREATE_DISPLAY_IMAGE_WITH_NOT_FOUND', $newName), $type= 'error');
					$error++;
				} else {
					//the actual image width and height and its max
					$height = $width[1];
					$width = $width[0];
					if ($height > $width) {
						$maxSideImage = $height;
					} else {
						$maxSideImage = $width;
					}
					// if original is wider or higher than display size, create a display image
					if( $maxSideImage > $rsgConfig->get('image_width') ) {
						$result = imgUtils::makeDisplayImage( $originalImageFullPath, $newName, $rsgConfig->get('image_width') );
					} else {
						$result = imgUtils::makeDisplayImage( $originalImageFullPath, $newName, $maxSideImage );
					}
					//If creation of image failed: let user know
					if( !$result ){
					//	imgUtils::deleteImage( $newName );
						$mainframe->enqueueMessage(JText::sprintf('COM_RSGALLERY2_COULD_NOT_CREATE_DISPLAY_IMAGE', $newName), $type= 'error');
						$error++;
					}
				}
			}
    	}
    }
    if ($error > 0) {
    	$msg = JText::_('COM_RSGALLERY2_MAINT_REGEN_ERRORS_DISPLAY');
    } else {
		$msg = JText::_('COM_RSGALLERY2_MAINT_REGEN_NO_ERRORS');
    }
    $mainframe->redirect("index.php?option=com_rsgallery2&rsgOption=maintenance&task=regenerateThumbs", $msg);
}

function consolidateDB() {
	$consolidate = new rsg2_consolidate();
	$consolidate->consolidateDB();
}

function createImages() {
	global $rsgConfig;
	$mainframe =& JFactory::getApplication();
	//Check if id or name is set
	if ( isset( $_REQUEST['id'] ) ) {
		$id = JRequest::getInt( 'id', null);
		$name = galleryUtils::getFileNameFromId($id);
	}
	elseif ( isset($_REQUEST['name'] ) ) {
		$name    = JRequest::getVar( 'name', null);
	} else {
		$mainframe->redirect("index.php?option=com_rsgallery2&rsgOption=maintenance", JText::_('COM_RSGALLERY2_NO_FILEINFORMATION_FOUND_THIS_SHOULD_NEVER_HAPPEN'));
	}
	
	//Just for readability of code
	$original = JPATH_ORIGINAL . DS . $name;
	$display  = JPATH_DISPLAY . DS . imgUtils::getImgNameDisplay($name);
	$thumb    = JPATH_THUMB . DS . imgUtils::getImgNameThumb($name);
	
	//If only thumb exists, no generation possible so redirect.
	if (!file_exists($original) AND !file_exists($display) AND file_exists($thumb) ) {
		$mainframe->redirect("index.php?option=com_rsgallery2&rsgOption=maintenance&task=consolidateDB", JText::_('COM_RSGALLERY2_MAINT_REGEN_ONLY_THUMB'));
		return;
	}
	//Go make images
	if ( file_exists($original) ) {
		//Check if display image exists, if not make it.
		if (!file_exists($display)) {
	    	imgUtils::makeDisplayImage($original, NULL, $rsgConfig->get('image_width') );
	    }
		if (!file_exists($thumb)) {
	        imgUtils::makeThumbImage($original);
	    }
	} else {
	    if (file_exists($display)) {
	        copy($display, $original);
	    }
	    if (!file_exists($thumb)) {
	        imgUtils::makeThumbImage($display);
	    }
	}
	$mainframe->redirect("index.php?option=com_rsgallery2&rsgOption=maintenance&task=consolidateDB",$name.' '.JText::_('COM_RSGALLERY2_MAINT_REGEN_SUCCESS'));
}

function deleteImages() {
	$mainframe =& JFactory::getApplication();
	$database =& JFactory::getDBO();
	$name = JRequest::getVar('name', null);
    
    if ( imgUtils::deleteImage( $name ) ) {
    	$txt = JText::_('COM_RSGALLERY2_MAGE-S_DELETED_SUCCESFULLY');
    } else {
    	$txt = JText::_('COM_RSGALLERY2_IMAGE-S_WERE_NOT_DELETED');
    }
    
    $mainframe->redirect("index.php?option=com_rsgallery2&rsgOption=maintenance&task=consolidateDB", $txt);
}

function createDbEntries() {
	$name = JRequest::getVar('name'  , null);
	$t_id = JRequest::getVar('t_id'  , null);
    $gid = JRequest::getInt('gallery_id'  , null);
    echo "<pre>";
    print_r($name);
    echo "</pre>";
    echo "We are going to create an entry for $name in $t_id.";
}

/**
 * Used in the consolidate database function
 * Creates images based on an image id or an image name
 */
function regenerateImage() {
	$mainframe =& JFactory::getApplication();
	global $rsgConfig;
	$database =& JFactory::getDBO();
	
	//Check if id or name is set
	if ( isset( $_REQUEST['id'] ) ) {
		$id = JRequest::getInt( 'id', null);
		$name = galleryUtils::getFileNameFromId($id);
	}
	elseif ( isset($_REQUEST['name'] ) ) {
		$name    = JRequest::getVar( 'name', null);
	} else {
		$mainframe->redirect("index.php?option=com_rsgallery2&task=batchupload", JText::_('COM_RSGALLERY2_NO_FILEINFORMATION_FOUND_THIS_SHOULD_NEVER_HAPPEN'));
	}
	
	//Just for readability of code
	$original = JPATH_ORIGINAL . DS . $name;
	$display  = JPATH_DISPLAY . DS . imgUtils::getImgNameDisplay($name);
	$thumb    = JPATH_THUMB . DS . imgUtils::getImgNameThumb($name);
	    
	if ( file_exists($original) ) {
		//Check if display image exists, if not make it.
		if (!file_exists($display)) {
	    	imgUtils::makeDisplayImage($original, NULL, $rsgConfig->get('image_width') );
	    }
		if (!file_exists($thumb)) {
	        imgUtils::makeThumbImage($original);
	    }
	} else {
	    if (file_exists($display)) {
	        copy($display, $original);
	    }
	    if (!file_exists($thumb)) {
	        imgUtils::makeThumbImage($display);
	    }
	}
}

/**
 * Checks database for problems and optimizes tables
 */
function optimizeDB() {
	$mainframe =& JFactory::getApplication();
	$database =& JFactory::getDBO();
	
	require_once(JPATH_ROOT . DS . "administrator" . DS . "components" . DS . "com_rsgallery2" . DS . "includes" . DS . "install.class.php");
	$install = new rsgInstall();
	$tables = $install->tablelistNew;
	foreach ($tables as $table) {
		$database->setQuery("OPTIMIZE $table");
		$database->query();
	}
	$mainframe->redirect("index.php?option=com_rsgallery2&amp;rsgOption=maintenance",JText::_('COM_RSGALLERY2_MAINT_OPTIMIZE_SUCCESS'));
}
?>