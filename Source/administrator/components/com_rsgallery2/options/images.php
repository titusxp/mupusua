<?php
/**
* Images option for RSGallery2
* @version $Id: images.php 1085 2012-06-24 13:44:29Z mirjam $
* @package RSGallery2
* @copyright (C) 2003 - 2011 RSGallery2
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* RSGallery is Free Software
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once( $rsgOptions_path . 'images.html.php' );
require_once( $rsgOptions_path . 'images.class.php' );
require_once( JPATH_RSGALLERY2_ADMIN . DS . 'admin.rsgallery2.html.php' );

$cid = JRequest::getVar("cid", array(), 'default', 'array' );

switch ($task) {
	case 'new':
		editImage( $option, 0 );
		break;
	
	case 'batchupload':
		HTML_RSGallery::RSGalleryHeader('', JText::_('COM_RSGALLERY2_SUBMENU_BATCH-UPLOAD'));
		batchupload($option);
		HTML_RSGallery::RSGalleryFooter();
		break;
		
	case 'save_batchupload':
		save_batchupload();
        break;
        
	case 'upload':
		uploadImage( $option );
		break;
		
	case 'save_upload':	
		saveUploadedImage( $option );
		break;
		
	case 'edit':
		JRequest::setVar('id', $cid[0]);
		editImage( $option, $cid[0] );
		break;

	case 'editA':
		editImage( $option, $id );
		break;

	case 'apply':
	case 'save':
		saveImage( $option );
		break;

	case 'remove':
		removeImages( $cid, $option );
		break;

	case 'publish':
		publishImages( $cid, 1, $option );
		break;

	case 'unpublish':
		publishImages( $cid, 0, $option );
		break;

	case 'approve':
		break;

	case 'cancel':
		cancelImage( $option );
		break;

	case 'orderup':
		orderImages( intval( $cid[0] ), -1, $option );
		break;

	case 'orderdown':
		orderImages( intval( $cid[0] ), 1, $option );
		break;
	
	case 'saveorder':
		saveOrder( $cid );
		break;
	
	case 'reset_hits':
		resetHits( $cid );
		break;
	
	case 'copy_images':
		copyImage( $cid, $option );
		break;
		
	case 'move_images':
		moveImages( $cid, $option );
		break;
		
	case 'showImages':
		showImages( $option );
		break;
		
	default:
		showImages( $option );
}

/**
* Compiles a list of records
* @param database A database connector object
*/
function showImages( $option ) {
	global $mosConfig_list_limit;
	$mainframe =& JFactory::getApplication();
	$database = JFactory::getDBO();
	
	$gallery_id 		= intval( $mainframe->getUserStateFromRequest( "gallery_id{$option}", 'gallery_id', 0 ) );
	$limit      = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');   
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
	$search 	= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search 	= $database->getEscaped( trim( strtolower( $search ) ) );

	$where = array();

	if ($gallery_id > 0) {
		$where[] = "a.gallery_id = $gallery_id";
	}
	if ($search) {
		$where[] = "LOWER(a.title) LIKE '%$search%'";
	}

	// get the total number of records
	$query = "SELECT COUNT(1)"
	. "\n FROM #__rsgallery2_files AS a"
	. (count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
	;
	$database->setQuery( $query );
	$total = $database->loadResult();

	jimport('joomla.html.pagination');
	$pageNav = new JPagination( $total, $limitstart, $limit  );

	$query = "SELECT a.*, cc.name AS category, u.name AS editor"
	. "\n FROM #__rsgallery2_files AS a"
	. "\n LEFT JOIN #__rsgallery2_galleries AS cc ON cc.id = a.gallery_id"
	. "\n LEFT JOIN #__users AS u ON u.id = a.checked_out"
	. ( count( $where ) ? "\n WHERE " . implode( ' AND ', $where ) : "")
	. "\n ORDER BY a.gallery_id, a.ordering"
	;
	$database->setQuery( $query, $pageNav->limitstart, $pageNav->limit );

	$rows = $database->loadObjectList();
	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	// build list of categories
	$javascript = 'onchange="document.adminForm.submit();"';
	$lists['gallery_id'] = galleryUtils::galleriesSelectList( $gallery_id, 'gallery_id', false, $javascript );
	$lists['move_id'] = galleryUtils::galleriesSelectList( $gallery_id, 'move_id', false, '', 0 );
	html_rsg2_images::showImages( $option, $rows, $lists, $search, $pageNav );
}

/**
* Compiles information to add or edit
* @param integer The unique id of the record to edit (0 if new)
*/
function editImage( $option, $id ) {
	$my = JFactory::getUser();
	$database = JFactory::getDBO();
	$mainframe =& JFactory::getApplication();
	
	$lists = array();
	
	$row = new rsgImagesItem( $database );
	// load the row from the db table
	$row->load( (int)$id );

	$canAdmin	= $my->authorise('core.admin', 'com_rsgallery2');
	$canEditItem = $my->authorise('core.edit','com_rsgallery2.item.'.$row->id);
	$canEditStateItem = $my->authorise('core.edit.state','com_rsgallery2.item.'.$row->id);

	if (!$canEditItem){
		$mainframe->redirect( "index.php?option=$option&rsgOption=images", JText::_('JERROR_ALERTNOAUTHOR'), 'error' );
	}
	
	// fail if checked out not by 'me'
	if ($row->isCheckedOut( $my->id )) {
		$mainframe->redirect( "index.php?option=$option&rsgOption=$rsgOption", "The module $row->title is currently being edited by another administrator." );
	}

	if ($id) {
		$row->checkout( $my->id );
	} else {
		// initialise new record
		$row->published = 1;
		$row->approved 	= 1;
		$row->order 	= 0;
		$row->gallery_id 	= intval( JRequest::getInt( 'gallery_id', 0 ) );
	}

	// build the html select list for ordering
	$query = "SELECT ordering AS value, title AS text"
	. "\n FROM #__rsgallery2_files"
	. "\n WHERE gallery_id = " . (int) $row->gallery_id
	. "\n ORDER BY ordering"
	;
	$lists['ordering'] 		= JHTML::_('list.specificordering', $row, $id, $query, 1 );
	// build list of categories
	$lists['gallery_id']	= galleryUtils::galleriesSelectList( $row->gallery_id, 'gallery_id', true, Null, 0 );
	// build the html select list
	if ($canEditStateItem) {
		$lists['published'] = JHTML::_("select.booleanlist", 'published', 'class="inputbox"', $row->published );
	} else {
		$lists['published'] = ($row->published ? JText::_('JYES') : JText::_('JNO'));
	}
	// build list of users when user has core.admin, else give owners name
	if ($canAdmin) {
		$lists['userid'] 		= JHTML::_('list.users', 'userid', $row->userid, 1, NULL, 'name', 0 );
	} else {
		$lists['userid'] 		= JFactory::getUser($row->userid)->name;
	}
	$file 	= JPATH_SITE .'/administrator/components/com_rsgallery2/options/images.item.xml';
	$params = new JParameter( $row->params, $file);

	html_rsg2_images::editImage( $row, $lists, $params, $option );
}

/**
* Saves the record on an edit form submit
* @param database A database connector object
*/
function saveImage( $option, $redirect = true ) {
	global  $rsgOption;
	$mainframe =& JFactory::getApplication();
	$database =& JFactory::getDBO();
	$my =& JFactory::getUser();

	$id = JRequest::getInt('id');
	$task = JRequest::getCmd('task');
	// Get the rules which are in the form … with the name ‘rules’ 
	// with type array (default value array())
	$data['rules']		= JRequest::getVar('rules', array(), 'post', 'array');
	
	$row = new rsgImagesItem( $database );
	$row->load($id);
	if (!$row->bind( JRequest::get('post') )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->descr = JRequest::getVar( 'descr', '', 'post', 'string', JREQUEST_ALLOWRAW );
	//Make the alias for SEF
	if(empty($row->alias)) {
            $row->alias = $row->title;
    }
    $row->alias = JFilterOutput::stringURLSafe($row->alias);

    //XHTML COMPLIANCE
	$row->descr = str_replace( '<br>', '<br />', $row->descr );
	
	// save params
	$params = JRequest::getVar( 'params', '' );
	if (is_array( $params )) {
		$txt = array();
		foreach ( $params as $k=>$v) {
			$txt[] = "$k=$v";
		}
		$row->params = implode( "\n", $txt );
	}

	// Joomla 1.6 ACL
	//Only save rules when there are rules (which were only shown to those with core.admin)
	if (!empty($data['rules'])) {
		// Get the form library
		jimport( 'joomla.form.form' );
		// Add a path for the form XML and get the form instantiated
		JForm::addFormPath(JPATH_ADMINISTRATOR.'/components/com_rsgallery2/models/forms/');
		$form = &JForm::getInstance('com_rsgallery2.params','item',array( 'load_data' => false ));
		// Filter $data which means that for $data['rules'] the Null values are removed
		$data = $form->filter($data);
		if (isset($data['rules']) && is_array($data['rules'])) {
			// Instantiate a JRules object with the rules posted in the form
			jimport( 'joomla.access.rules' );
			$rules = new JRules($data['rules']);
			// $row is an rsgImagesItem object that extends JTable with method setRules
			// this binds the JRules object to $row->_rules
			$row->setRules($rules);
		}
	}
	
	$row->date = date( 'Y-m-d H:i:s' );
	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->checkin();
	$row->reorder( "gallery_id = " . (int) $row->gallery_id );
	
	if ($redirect){
		if ($task == 'save'){
			$mainframe->redirect( "index.php?option=$option&rsgOption=$rsgOption" );
		} else { //apply
			$mainframe->redirect( "index.php?option=$option&rsgOption=$rsgOption&task=editA&hidemainmenu=1&id=$row->id" );
		}
	}
}

/**
* Deletes one or more records
* @param array An array of unique category id numbers
* @param string The current url option
*/
function removeImages( $cid, $option ) {
	global  $rsgOption, $rsgConfig;
	$mainframe =& JFactory::getApplication();
	$database =& JFactory::getDBO();
	
	$return="index.php?option=$option&rsgOption=images";
	if (!is_array( $cid ) || count( $cid ) < 1) {
		echo "<script> alert('Select an item to delete'); window.history.go(-1);</script>\n";
		exit;
	}
	//Delete images from filesystem
	if (count( $cid )) {
		//Delete images from filesystem
		foreach ($cid as $id) {
			$name 		= galleryUtils::getFileNameFromId($id);
			$thumb 		= JPATH_ROOT.$rsgConfig->get('imgPath_thumb') . '/' . imgUtils::getImgNameThumb( $name );
        	$display 	= JPATH_ROOT.$rsgConfig->get('imgPath_display') . '/' . imgUtils::getImgNameDisplay( $name );
        	$original 	= JPATH_ROOT.$rsgConfig->get('imgPath_original') . '/' . $name;
        
        	if( file_exists( $thumb )){
            	if( !JFile::delete( $thumb )){
				JError::raiseNotice('ERROR_CODE', JText::_('COM_RSGALLERY2_ERROR_DELETING_THUMB_IMAGE') ." ". $thumb);
				$mainframe->redirect( $return );
				return;
				}
			}
			if( file_exists( $display )){
				if( !JFile::delete( $display )){
				JError::raiseNotice('ERROR_CODE', JText::_('COM_RSGALLERY2_ERROR_DELETING_DISPLAY_IMAGE') ." ". $display);
				$mainframe->redirect( $return );
				return;
				}
			}
			if( file_exists( $original )){
				if( !JFile::delete( $original )){
				JError::raiseNotice('ERROR_CODE', JText::_('COM_RSGALLERY2_ERROR_DELETING_ORIGINAL_IMAGE') ." ". $original);
				$mainframe->redirect( $return );
				return;
				}
			}
			//Delete from database
			$row = new rsgImagesItem( $database );
			if (!$row->delete($id)){
				JError::raiseNotice('ERROR_CODE', JText::sprintf('COM_RSGALLERY2_ERROR_DELETING_ITEMINFORMATION_DATABASE_ID',$id ));
				$mainframe->redirect( $return );
				return;
			}
		}
		
	}
	$mainframe->redirect( $return , JText::_('COM_RSGALLERY2_MAGE-S_DELETED_SUCCESFULLY') );
}

/**
* Moves one or more items (images) to another gallery, ordering each item as the last one.
* @param array An array of unique category id numbers
* @param string The current url option
*/
function moveImages( $cid, $option ) {
	$mainframe =& JFactory::getApplication();
	$database =& JFactory::getDBO();

	//Get gallery id to move item(s) to
	$new_id = JRequest::getInt( 'move_id', '' );
	if ($new_id == 0) {
		echo "<script> alert('No gallery selected to move to'); window.history.go(-1);</script>\n";
		exit;
	}

	$row = new rsgImagesItem( $database );

	//Load each row, get new gallery_id/order and store (asset is stored as well with new gallery)
	foreach ($cid as $id) {
		$row->load( (int)$id );
		if ($row->gallery_id == $new_id) {
			//Item is already in this gallery:
			continue;
		}
		$row->gallery_id = $new_id;
		$row->ordering = $row->getNextOrder("gallery_id = " . (int) $row->gallery_id);
		if (!$row->store()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			exit();
		}
	}

	$mainframe->redirect( "index.php?option=$option&rsgOption=images", '' );
}

/**
* Publishes or Unpublishes one or more records
* @param array An array of unique category id numbers
* @param integer 0 if unpublishing, 1 if publishing
* @param string The current url option
*/
function publishImages( $cid=null, $publish=1,  $option ) {
	global  $rsgOption;
	$mainframe =& JFactory::getApplication();
	$database = JFactory::getDBO();
	$my =& JFactory::getUser();

	if (!is_array( $cid ) || count( $cid ) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );

	$query = "UPDATE #__rsgallery2_files"
	. "\n SET published = " . intval( $publish )
	. "\n WHERE id IN ( $cids )"
	. "\n AND ( checked_out = 0 OR ( checked_out = $my->id ) )"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new rsgImagesItem( $database );
		$row->checkin( $cid[0] );
	}
	$mainframe->redirect( "index.php?option=com_rsgallery2&rsgOption=$rsgOption" );
}
/**
* Moves the order of a record
* @param integer The increment to reorder by
*/
function orderImages( $uid, $inc, $option ) {
	global  $rsgOption;
	$mainframe =& JFactory::getApplication();
	$database = JFactory::getDBO();
	
	$row = new rsgImagesItem( $database );
	$row->load( (int)$uid );
	$row->move( $inc, "gallery_id = $row->gallery_id" );

	$mainframe->redirect( "index.php?option=$option&rsgOption=$rsgOption" );
}

/**
* Cancels an edit operation
* @param string The current url option
*/
function cancelImage( $option ) {
	global $rsgOption;
	$mainframe =& JFactory::getApplication();
	$database = JFactory::getDBO();
	
	$row = new rsgImagesItem( $database );
	$row->bind( $_POST );
	$row->checkin();
	$mainframe->redirect( "index.php?option=$option&rsgOption=$rsgOption" );
}

/**
 * Uploads single images
 */
function uploadImage( $option ) {
	$database =& JFactory::getDBO();
	//Check if there are galleries created
	$database->setQuery( "SELECT id FROM #__rsgallery2_galleries" );
    $database->query();
    if( $database->getNumRows()==0 ){
        HTML_RSGALLERY::requestCatCreation( );
        return;
    }
    
	//Create gallery selectlist
	$lists['gallery_id'] = galleryUtils::galleriesSelectList( NULL, 'gallery_id', false , Null, 0);
	html_rsg2_images::uploadImage( $lists, $option );
}

function saveUploadedImage( $option ) {
	global $id, $rsgOption;
	$mainframe = &JFactory::getApplication();
	$title = JRequest::getVar('title'  , array(), 'default', 'array');// We get an array of titles here  
	$descr = JRequest::getVar('descr'  , '', 'post', 'string', JREQUEST_ALLOWRAW); 
	$gallery_id = JRequest::getInt('gallery_id'  , '');
	$files = JRequest::getVar('images','', 'FILES');

	//For each error that is found, store error message in array
	$errors = array();
	foreach ($files["error"] as $key => $error) {
		if( $error != UPLOAD_ERR_OK ) {
			if ($error == 4) {//If no file selected, ignore
				continue;
			} else {
				//Create meaningfull error messages and add to error array
				$error = fileHandler::returnUploadError( $error );
				$errors[] = new imageUploadError($files["name"][$key], $error);
				continue;
			}
		}

		//Special error check to make sure the file was not introduced another way.
		if( !is_uploaded_file( $files["tmp_name"][$key] )) {
			$errors[] = new imageUploadError( $files["tmp_name"][$key], "not an uploaded file, potential malice detected!" );
			continue;
		}
		//Actually importing the image
		$e = fileUtils::importImage($files["tmp_name"][$key], $files["name"][$key], $gallery_id, $title[$key], $descr);
		if ( $e !== true )
			$errors[] = $e;

	}
	//Error handling if necessary
	if ( count( $errors ) == 0){
		$mainframe->redirect( "index.php?option=$option&rsgOption=$rsgOption", JText::_('COM_RSGALLERY2_ITEM_UPLOADED_SUCCESFULLY') );
	} else {
		//Show error message for each error encountered
		foreach( $errors as $e ) {
			JError::raiseWarning(0, $e->toString());
		}
		//If there were more files than errors, assure the user the rest went well
		if ( count( $errors ) < count( $files["error"] ) ) {
			echo "<br>".JText::_('COM_RSGALLERY2_THE_REST_OF_YOUR_FILES_WERE_UPLOADED_FINE');
		}
		$mainframe->redirect( "index.php?option=com_rsgallery2&rsgOption=images&task=upload");
	}		
}

/**
 * Resets hits to zero
 * @param array image id's
 * @todo Warn user with alert before actually deleting
 */
function resetHits ( &$cid ) {
	$mainframe =& JFactory::getApplication();
	$database =& JFactory::getDBO();

	//Reset hits
	$cids = implode( ',', $cid );

	$query = 'UPDATE `#__rsgallery2_files` SET '.
			' `hits` = 0 '.
			' WHERE `id` IN ( '.$cids.' )';
	$database->setQuery($query);

	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}

	$mainframe->redirect( "index.php?option=com_rsgallery2&rsgOption=images", JText::_('COM_RSGALLERY2_HITS_RESET_TO_ZERO_SUCCESFULL') );
}

function saveOrder( &$cid ) {
	$mainframe =& JFactory::getApplication();
	$database =& JFactory::getDBO();

	$total		= count( $cid );
	$order 		= JRequest::getVar("order", array(), 'default', 'array' );

	$row 		= new rsgImagesItem( $database );
	
	$conditions = array();

	// update ordering values
	for ( $i=0; $i < $total; $i++ ) {
		$row->load( (int) $cid[$i] );
		if ($row->ordering != $order[$i]) {
			$row->ordering = $order[$i];
			if (!$row->store()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
			} // if
			// remember to updateOrder this group
			$condition = "gallery_id=" . (int) $row->gallery_id;
			$found = false;
			foreach ( $conditions as $cond )
				if ($cond[1]==$condition) {
					$found = true;
					break;
				} // if
			if (!$found) $conditions[] = array($row->id, $condition);
		} // if
	} // for

	// execute updateOrder for each group
	foreach ( $conditions as $cond ) {
		$row->load( $cond[0] );
		$row->reorder( $cond[1] );
	} // foreach

	// clean any existing cache files
	$cache =& JFactory::getCache();
	$cache->clean( 'com_rsgallery2' );

	$msg 	= JText::_('COM_RSGALLERY2_NEW_ORDERING_SAVED');
	$mainframe->redirect( 'index.php?option=com_rsgallery2&rsgOption=images', $msg );
} // saveOrder

/**
* Copies one or more items (images) to the selected gallery, ordering each item as the last one.
* @param array An array of unique category id numbers
* @param string The current url option
*/
function copyImage( $cid, $option ) {
	$mainframe =& JFactory::getApplication();
	$database =& JFactory::getDBO();

	//For each error that is found, store error message in array
	$errors = array();
	
	//Get gallery id to copy item(s) to
	$cat_id = JRequest::getInt('move_id', '' );
	if (!$cat_id) {
		echo "<script> alert('No gallery selected to move to'); window.history.go(-1);</script>\n";
		exit;
	}
	
    //Create unique copy name
    $tmpdir	= uniqid( 'rsgcopy_' );
    
    //Get full path to copy directory
	$copyDir = JPath::clean( JPATH_ROOT.DS . 'media' . DS . $tmpdir . DS );
    if( !JFolder::create($copyDir ) ) {
    		$errors[] = 'Unable to create temp directory ' . $copyDir; 
    } else {
	    foreach( $cid as $id ) {
			$gallery = rsgGalleryManager::getGalleryByItemID($id);
	    	$item = $gallery->getItem( $id );
	    	$original = $item->original();
	    	$source = $original->filePath();
	    	
	    	$destination = $copyDir . $item->name;
	    	
	    	if( is_dir($copyDir) ) {
	    		if( file_exists( $source ) ) {
	    			
	    			if(!JFile::copy( $source, $destination)){
	    				$errors[] = 'The file could not be copied!';
	    			} else {
						//Actually importing the image
						$e = fileUtils::importImage($destination, $item->name, $cat_id, $item->title, $item->description);
						if ( $e !== true )	$errors[] = $e;
						if(!JFile::delete($destination)) $errors[] = 'Unable to delete the file' . $item->name;
					}
				}
			}
	    }
	    
	    if(!rmdir($copyDir)) $errors[] = 'Unable to delete the temp directory' . $copyDir;	
    }

	//Error handling if necessary
	if ( count( $errors ) == 0){
		$mainframe->redirect( "index.php?option=$option&rsgOption=images", JText::_('COM_RSGALLERY2_ITEM-S_COPIED_SUCCESSFULLY') );
	} else {
		//Show error message for each error encountered
		foreach( $errors as $e ) {
			echo $e->toString();
		}
		//If there were more files than errors, assure the user the rest went well
		if ( count( $errors ) < count( $files["error"] ) ) {
			echo "<br>".JText::_('COM_RSGALLERY2_REST_OF_THE_ITEMS_COPIED_SUCCESSFULLY');
		}
	}
}

function batchupload($option) {
	global $rsgConfig;
	$database = JFactory::getDBO();
	$mainframe =& JFactory::getApplication();
	$FTP_path = $rsgConfig->get('ftp_path');

	//Retrieve data from submit form
	$batchmethod 	= JRequest::getCmd('batchmethod', null);
	$uploaded 		= JRequest::getBool('uploaded', null);
	$selcat 		= JRequest::getInt('selcat', null);
	$zip_file 		= JRequest::getVar('zip_file', null, 'FILES'); 
	$ftppath 		= JRequest::getVar('ftppath', null);
	$xcat 			= JRequest::getInt('xcat', null);
	
	//Check if at least one gallery exists, if not link to gallery creation
	$database->setQuery( "SELECT id FROM #__rsgallery2_galleries" );
	$database->query();
	if( $database->getNumRows()==0 ){
		HTML_RSGALLERY::requestCatCreation( );
		return;
	}
	
	//New instance of fileHandler
	$uploadfile = new fileHandler();
	
	if (isset($uploaded)) {//true when form in step 1 of batchupload is submitted
		if ($batchmethod == "zip") {
			if ($uploadfile->checkSize($zip_file) == 1) {
				//$ziplist = $uploadfile->handleZIP($zip_file);//MK// [change] [handleZIP uses PclZip that is no longer in J1.6]
				$ziplist = $uploadfile->extractArchive($zip_file);//MK// [todo] [check extractArchive]
				if (!$ziplist){
					//Extracting archive failed
					$mainframe->redirect( "index.php?option=com_rsgallery2&rsgOption=images&task=batchupload");
				}
			} else {
				//Error message: file size
				$mainframe->redirect( "index.php?option=com_rsgallery2&rsgOption=images&task=batchupload", JText::_('COM_RSGALLERY2_ZIP-FILE_IS_TOO_BIG'));
			}
		} else {//not zip thus ftp
			$ziplist = $uploadfile->handleFTP($ftppath);
		}
		html_rsg2_images::batchupload_2($ziplist, $uploadfile->extractDir);//Step 2 in batchupload process
	} else {
		html_rsg2_images::batchupload($option);//Step 1 in batchupload process
	}
}//End function

function save_batchupload() {
    global  $rsgConfig;
	$mainframe =& JFactory::getApplication();
	$database = JFactory::getDBO();
    //Try to bypass max_execution_time as set in php.ini
    set_time_limit(0);
    
    $FTP_path = $rsgConfig->get('ftp_path');

    $teller 	= JRequest::getInt('teller'  , null);
    $delete 	= JRequest::getVar('delete'  , null, 'post', 'array');
    $filename 	= JRequest::getVar('filename'  , null, 'post', 'array');
    $ptitle 	= JRequest::getVar('ptitle'  , null, 'post', 'array');
    $descr 		= JRequest::getVar('descr'  , array(0), 'post', 'array');
	$extractdir = JRequest::getCmd('extractdir'  , null);
	
    //Check if all categories are chosen
	if (isset($_REQUEST['category']))
		$category = JRequest::getVar('category'  , array(0), 'post', 'array');
    else
        $category = array(0);

    if ( in_array('0', $category) || 
		 in_array('-1', $category)) {
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
}
