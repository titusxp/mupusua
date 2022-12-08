<?php
/**
* This file contains the non-presentation processing for the Admin section of RSGallery.
* @version $Id: admin.rsgallery2.php 1085 2012-06-24 13:44:29Z mirjam $
* @package RSGallery2
* @copyright (C) 2003 - 2012 RSGallery2
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* RSGallery is Free Software
*/
defined( '_JEXEC' ) or die( 'Access Denied.' );

//Initialize RSG2 core functionality
require_once( JPATH_SITE.'/administrator/components/com_rsgallery2/init.rsgallery2.php' );

//Instantate user variables but don't show a frontend template
rsgInstance::instance( 'request', false );

//Load Tooltips
JHTML::_('behavior.tooltip');

require_once JPATH_COMPONENT.'/helpers/rsgallery2.php';

//Access check
$canAdmin	= JFactory::getUser()->authorise('core.admin',	'com_rsgallery2');
$canManage	= JFactory::getUser()->authorise('core.manage',	'com_rsgallery2');
if (!$canManage) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}


?>
<link href="<?php echo JURI_SITE; ?>/administrator/components/com_rsgallery2/admin.rsgallery2.css" rel="stylesheet" type="text/css" />
<?php

require_once( JApplicationHelper::getPath('admin_html') );

global $opt, $catid, $uploadStep, $numberOfUploads, $e_id ;
$task				= JRequest::getCmd('task');
$option				= strtolower(JRequest::getCmd('option'));
//$opt				= JRequest::getCmd('opt', null );//Removed after 3.1.0
$catid				= JRequest::getInt('catid', null);
$uploadStep			= JRequest::getInt('uploadStep', 0 );
$numberOfUploads	= JRequest::getInt('numberOfUploads', 1 );
//$e_id				= JRequest::getInt('e_id', 1 );//Removed after 3.1.0

$cid    = JRequest::getInt('cid', array(0) );
$id     = JRequest::getInt('id', 0 );

$rsgOption = JRequest::getCmd('rsgOption', null );

$my = JFactory::getUser();

/**
 * this is the new $rsgOption switch.  each option will have a switch for $task within it.
 */
switch( $rsgOption ) {
    case 'galleries':
        require_once( $rsgOptions_path . 'galleries.php' );
    	break;
    case 'images':
        require_once( $rsgOptions_path . 'images.php' );
    	break;
    case 'comments':
        require_once( $rsgOptions_path . 'comments.php' );
   		break;
    case 'config':
        require_once( $rsgOptions_path . 'config.php' );
    	break;
//	case 'template':
//		require_once( $rsgOptions_path . 'templates.php' );
//		break;
	case 'installer':
		require_once( $rsgOptions_path . 'installer.php' );
		break;
	case 'maintenance':
    	require_once( $rsgOptions_path . 'maintenance.php' );
    	break;
}

// only use the legacy task switch if rsgOption is not used. [MK not truely legacy but still used!]
// these tasks require admin or super admin privledges.
if( $rsgOption == '' )	
switch ( JRequest::getCmd('task', null) ){
	//Special/debug tasks
    case 'purgeEverything':
        purgeEverything();	//canAdmin check in this function
        HTML_RSGallery::showCP();
        HTML_RSGallery::RSGalleryFooter();
        break;
    case 'reallyUninstall':
        reallyUninstall();	//canAdmin check in this function
        HTML_RSGallery::showCP();
        HTML_RSGallery::RSGalleryFooter();
        break;
    //Config tasks
    // this is just a kludge until all links and form vars to configuration functions have been updated to use $rsgOption = 'config';
    /*
    case 'applyConfig':
    case 'saveConfig':
    case "showConfig":
    */
    case 'config_dumpVars':
    case 'config_rawEdit_apply':
    case 'config_rawEdit_save':
    case 'config_rawEdit':
		$rsgOption = 'config';
		require_once( $rsgOptions_path . 'config.php' );
    break;
	//Image tasks
    case "edit_image":
        HTML_RSGallery::RSGalleryHeader('edit', JText::_('COM_RSGALLERY2_EDIT'));
        editImageX($option, $cid[0]);
        HTML_RSGallery::RSGalleryFooter();
        break;

    case "uploadX":
		JFactory::getApplication()->enqueueMessage( 'Marked for removal: uploadX', 'Notice' );
        HTML_RSGallery::RSGalleryHeader('browser', JText::_('COM_RSGALLERY2_UPLOAD'));
        showUpload();
        HTML_RSGallery::RSGalleryFooter();
        break;

    case "batchuploadX":
		JFactory::getApplication()->enqueueMessage( 'Marked for removal: batchuploadX', 'Notice' );
        HTML_RSGallery::RSGalleryHeader('', JText::_('COM_RSGALLERY2_UPLOAD_ZIP-FILE'));
        batch_upload($option, $task);
        HTML_RSGallery::RSGalleryFooter();
        break;
    case "save_batchuploadX":
		JFactory::getApplication()->enqueueMessage( 'Marked for removal: save_batchuploadX', 'Notice' );
        save_batchupload();
        break;
    //Image and category tasks
    case "categories_orderup":
    case "images_orderup":
        orderRSGallery( $cid[0], -1, $option, $task );
        break;
    case "categories_orderdown":
    case "images_orderdown":
        orderRSGallery( $cid[0], 1, $option, $task );
        break;
	//Special/debug tasks
    case 'viewChangelog':
        HTML_RSGallery::RSGalleryHeader('viewChangelog', JText::_('COM_RSGALLERY2_CHANGELOG'));
        viewChangelog();
        HTML_RSGallery::RSGalleryFooter();
        break;
    case "controlPanel":
    default:
        HTML_RSGallery::showCP();
        HTML_RSGallery::RSGalleryFooter();
        break;
}

/**
* @param string The name of the php (temporary) uploaded file
* @param string The name of the file to put in the temp directory
* @param string The message to return
*/
function uploadFile( $filename, $userfile_name, $msg ) {
	
	$baseDir = JPATH_SITE . '/media' ;

	if (file_exists( $baseDir )) {
		if (is_writable( $baseDir )) {
			if (move_uploaded_file( $filename, $baseDir . $userfile_name )) {
				if (JFTP::chmod( $baseDir . $userfile_name )) {
					return true;
				} else {
					$msg = JText::_('COM_RSGALLERY2_FAILED_TO_CHANGE_THE_PERMISSIONS_OF_THE_UPLOADED_FILE');
				}
			} else {
				$msg = JText::_('COM_RSGALLERY2_FAILED_TO_MOVE_UPLOADED_FILE_TO_MEDIA_DIRECTORY');
			}
		} else {
			$msg = JText::_('COM_RSGALLERY2_UPLOAD_FAILED_AS_MEDIA_DIRECTORY_IS_NOT_WRITABLE');
		}
	} else {
		$msg = JText::_('COM_RSGALLERY2_UPLOAD_FAILED_AS_MEDIA_DIRECTORY_DOES_NOT_EXIST');
	}
	return false;
}

function viewChangelog(){
    echo '<pre>';
    readfile( JPATH_RSGALLERY2_ADMIN.'/changelog.php' );
    echo '</pre>';
}

/**
 * deletes all pictures, thumbs and their database entries. It leaves category information in DB intact.
 * this is a quick n dirty function for development, it shouldn't be available for regular users.
 */
function purgeEverything(){
    global $rsgConfig;

	//Access check
	$canAdmin	= JFactory::getUser()->authorise('core.admin',	'com_rsgallery2');
	if (!$canAdmin) {
		return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	} else {
		$fullPath_thumb = JPATH_ROOT.$rsgConfig->get('imgPath_thumb') . '/';
		$fullPath_display = JPATH_ROOT.$rsgConfig->get('imgPath_display') . '/';
		$fullPath_original = JPATH_ROOT.$rsgConfig->get('imgPath_original') . '/';

		processAdminSqlQueryVerbosely( 'DELETE FROM #__rsgallery2_files', JText::_('COM_RSGALLERY2_PURGED_IMAGE_ENTRIES_FROM_DATABASE') );
		processAdminSqlQueryVerbosely( 'DELETE FROM #__rsgallery2_galleries', JText::_('COM_RSGALLERY2_PURGED_GALLERIES_FROM_DATABASE') );
		processAdminSqlQueryVerbosely( 'DELETE FROM #__rsgallery2_config', JText::_('COM_RSGALLERY2_PURGED_CONFIG_FROM_DATABASE') );
		processAdminSqlQueryVerbosely( 'DELETE FROM #__rsgallery2_comments', JText::_('COM_RSGALLERY2_PURGED_COMMENTS_FROM_DATABASE') );
		processAdminSqlQueryVerbosely( 'DELETE FROM #__rsgallery2_acl', JText::_('COM_RSGALLERY2_ACCESS_CONTROL_DATA_DELETED' ));
		
		// remove thumbnails
		HTML_RSGALLERY::printAdminMsg( JText::_('COM_RSGALLERY2_REMOVING_THUMB_IMAGES') );
		foreach ( glob( $fullPath_thumb.'*' ) as $filename ) {
			if( is_file( $filename )) unlink( $filename );
		}
		
		// remove display imgs
		HTML_RSGALLERY::printAdminMsg( JText::_('COM_RSGALLERY2_REMOVING_ORIGINAL_IMAGES') );
		foreach ( glob( $fullPath_display.'*' ) as $filename ) {
			if( is_file( $filename )) unlink( $filename );
		}
		
		// remove display imgs
		HTML_RSGALLERY::printAdminMsg( JText::_('COM_RSGALLERY2_REMOVING_ORIGINAL_IMAGES') );
		foreach ( glob( $fullPath_original.'*' ) as $filename ) {
			if( is_file( $filename )) unlink( $filename );
		}
		
		HTML_RSGALLERY::printAdminMsg( JText::_('COM_RSGALLERY2_PURGED'), true );
	}
}

/**
 * drops all RSG2 tables, deletes image directory structure
 * use before uninstalling to REALLY uninstall
 * @todo This is a quick hack.  make it work on all OS and with non default directories.
 */
function reallyUninstall(){
    
    //Access check
	$canAdmin	= JFactory::getUser()->authorise('core.admin',	'com_rsgallery2');
	if (!$canAdmin) {
		return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	} else {
		passthru( "rm -r ".JPATH_SITE."/images/rsgallery");
		HTML_RSGALLERY::printAdminMsg( JText::_('COM_RSGALLERY2_USED_RM_-R_TO_ATTEMPT_TO_REMOVE_JPATH_SITE_IMAGES_RSGALLERY') );

		processAdminSqlQueryVerbosely( 'DROP TABLE IF EXISTS #__rsgallery2_acl', JText::_('COM_RSGALLERY2_DROPED_TABLE___RSGALLERY2_GALLERIES') );
		processAdminSqlQueryVerbosely( 'DROP TABLE IF EXISTS #__rsgallery2_files', JText::_('COM_RSGALLERY2_DROPED_TABLE___RSGALLERY2_FILES') );
		processAdminSqlQueryVerbosely( 'DROP TABLE IF EXISTS #__rsgallery2_cats', JText::_('COM_RSGALLERY2_DROPED_TABLE___RSGALLERY2_GALLERIES') );
		processAdminSqlQueryVerbosely( 'DROP TABLE IF EXISTS #__rsgallery2_galleries', JText::_('COM_RSGALLERY2_DROPED_TABLE___RSGALLERY2_GALLERIES') );
		processAdminSqlQueryVerbosely( 'DROP TABLE IF EXISTS #__rsgallery2_config', JText::_('COM_RSGALLERY2_DROPED_TABLE___RSGALLERY2_CONFIG') );
		processAdminSqlQueryVerbosely( 'DROP TABLE IF EXISTS #__rsgallery2_comments', JText::_('COM_RSGALLERY2_DROPED_TABLE___RSGALLERY2_COMMENTS') );

		HTML_RSGALLERY::printAdminMsg( JText::_('COM_RSGALLERY2_REAL_UNINST_DONE') );
	}
}

/**
 * runs a sql query, displays admin message on success or error on error
 * @param String sql query
 * @param String message to display on success
 * @return boolean value indicating success
 */
function processAdminSqlQueryVerbosely( $query, $successMsg ){
    $database =& JFactory::getDBO();
    
    $database->setQuery( $query );
    $database->query();
    if($database->getErrorMsg()){
            HTML_RSGALLERY::printAdminMsg( $database->getErrorMsg(), true );
            return false;
    }
    else{
        HTML_RSGALLERY::printAdminMsg( $successMsg );
        return true;
    }
}

/* Removed after v3.1.0
function save_batchuploadX() {
    global $database, $mainframe, $rsgConfig;
    
    //Try to bypass max_execution_time as set in php.ini
    set_time_limit(0);
    
    $FTP_path = $rsgConfig->get('ftp_path');

    $teller 	= JRequest::getInt('teller'  , null);
    $delete 	= JRequest::getVar('delete'  , null);
    $filename 	= JRequest::getVar('filename'  , null);
    $ptitle 	= JRequest::getVar('ptitle'  , null);
    $descr 		= JRequest::getVar('descr'  , array(0));
	$extractdir = JRequest::getVar('extractdir'  , null);
	
    //Check if all categories are chosen
    if (isset($_REQUEST['category']))
        $category = JRequest::getVar('category'  , null);
    else
        $category = array(0);

    if ( in_array("0",$category) ) {
        $mainframe->redirect("index.php?option=com_rsgallery2&task=batchupload", JText::_('COM_RSGALLERY2_ALERT_NOCATSELECTED'));
	}

     for($i=0;$i<$teller;$i++) {
        //If image is marked for deletion, delete and continue with next iteration
        if (isset($delete[$i]) AND ($delete[$i] == 'true')) {
            //Delete file from server
            unlink(JPATH_ROOT.DS."media".DS.$extractdir.DS.$filename[$i]);
            continue;
        } else {
            //Setting variables for importImage()
            $imgTmpName = JPATH_ROOT.DS."media".DS.$extractdir.DS.$filename[$i];
            $imgName 	= $filename[$i];
            $imgCat	 	= $category[$i];
            $imgTitle 	= $ptitle[$i];
            $imgDesc 	= $descr[$i];
            
            //Import image
            $e = imgUtils::importImage($imgTmpName, $imgName, $imgCat, $imgTitle, $imgDesc);
            
            //Check for errors
            if ( $e !== true ) {
                $errors[] = $e;
            }
        }
    }
    //Clean up mediadir
    fileHandler::cleanMediaDir( $extractdir );
    
    // Error handling
    if (isset($errors )) {
        if ( count( $errors ) == 0) {
            echo JText::_('COM_RSGALLERY2_ITEM_UPLOADED_SUCCESFULLY');
        } else {
            foreach( $errors as $err ) {
                echo $err->toString();
            }
        }
    } else {
        //Everything went smoothly, back to Control Panel
        $mainframe->redirect("index.php?option=com_rsgallery2", JText::_('COM_RSGALLERY2_ITEM_UPLOADED_SUCCESFULLY'));
    }
}/**/

function cancelGallery($option) {
    $mainframe->redirect("index.php?option=$option");
}
?>
