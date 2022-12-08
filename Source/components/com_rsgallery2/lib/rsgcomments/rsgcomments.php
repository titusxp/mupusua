<?php
/**
* This file contains Comments logic
* @version $Id: rsgcomments.php 1098 2012-07-31 11:54:19Z mirjam $
* @package RSGallery2
* @copyright (C) 2003 - 20011 RSGallery2
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* RSGallery is Free Software
*/

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require_once( JPATH_RSGALLERY2_SITE . DS . 'lib' . DS . 'rsgcomments' . DS . 'rsgcomments.class.php' );

$cid    = JRequest::getInt('cid', array(0) );
$task    = JRequest::getCmd('task', '' );
$option    = JRequest::getCmd('option', '' );
switch( $task ){
    case 'save':
    	//test( $option );
        saveComment( $option );
        break;
    case 'delete':
    	deleteComments( $option );
    	//test( $option );
    	break;
}

/**
 * Test function FOR DEVELOPMENT ONLY!
 * @param string The current url option
 */
function test( $option ) {
	$id	= JRequest::getInt('id'  , '');
	$item_id 	= JRequest::getInt('item_id'  , '');
	$catid 		= JRequest::getInt('catid'  , '');
	$redirect_url = JRoute::_("index.php?option=".$option."&page=inline&id=".$item_id."&catid=".$catid);
	echo "Here we will delete comment number ".$id."\\n and redirect to ".$redirect_url;
}

/**
 * Saves a comment to the database
 * @param option from URL
 * @todo Implement system to allow only one comment per user.
 */
function saveComment( $option ) {
	global $rsgConfig;
	$mainframe 	=& JFactory::getApplication();
	$my 		= JFactory::getUser();
	$database 	= JFactory::getDBO();

	//Retrieve parameters
	$user_ip	= $database->quote($_SERVER['REMOTE_ADDR']);			// Used in sql!
	$rsgOption	= JRequest::getCmd('rsgOption'  , '');
	$subject 	= $database->quote(JRequest::getString('ttitle', ''));	// Used in sql!
	$user_name	= $database->quote(JRequest::getString('tname', ''));	// Used in sql!
	$item_id 	= JRequest::getInt( 'item_id'  , '');
	$gid 		= JRequest::getInt( 'gid'  , '');
	$Itemid 	= JRequest::getInt( 'Itemid'  , '');
	$dateTime	= $database->quote(date('Y-m-d H:i:s'));				// Used in sql!

	$redirect_url = JRoute::_("index.php?option=".$option."&Itemid=$Itemid&page=inline&id=".$item_id, false);

	//Check if commenting is enabled (need $gid and $redirect_url)
	if (!JFactory::getUser()->authorise('rsgallery2.comment','com_rsgallery2.gallery.'.$gid)) {
		$mainframe->redirect($redirect_url, JText::_('COM_RSGALLERY2_COMMENTING_IS_DISABLED') );
		exit();
	}
	
	//Retrieve comment, filter it, do some more tests, get it database ready...
	$comment 	= JRequest::getVar('tcomment','','POST','STRING',JREQUEST_ALLOWHTML); 
	//	Clean the comment with the filter: strong, emphasis, underline (not a with attrib href for now)
	$allowedTags 		= array('strong','em','u','p','br');
	$allowedAttribs 	= array('');//array('href');
	$filter 			= & JFilterInput::getInstance($allowedTags,$allowedAttribs);
	$comment 			= $filter->clean($comment);
	//	Now do some extra tests on this comment and if they not pass, redirect the user
	$testFailed = false;
	if (preg_match_all('/target="(.....)/',$comment,$matches)) {
		foreach ($matches[1] as $match) {
			// allowed are target="_self" and target="_blank" (whitch has one letter too many)
			if (($match != "_self") AND ($match != "_blan")) {
				$testFailed = true;
			}
		}
		if ($testFailed){
			$mainframe->redirect( $redirect_url, JText::_('COM_RSGALLERY2_COMMENT_COULD_NOT_BE_ADDED') );
		}
	}
	//	Get comment "database ready"
	$comment 	= $database->Quote($comment);							// Used in sql!	
	
	//Check if user is logged in
	if ($my->id) {
		$user_id = (int) $my->id;
		//Check if only one comment is allowed
		if ($rsgConfig->get('comment_once') == 1) {
			//Check how many comments the user already made on this item
			$sql = 'SELECT COUNT(1) FROM `#__rsgallery2_comments` WHERE `user_id` = '. (int) $user_id .' AND `item_id` = '. (int) $item_id;
			$database->setQuery( $sql );
			$result = $database->loadResult();
			if ($result > 0 ) {
				//No further comments allowed, redirect
				$mainframe->redirect($redirect_url, JText::_('COM_RSGALLERY2_USER_CAN_ONLY_COMMENT_ONCE'));
			}
		}
	} else {
		$user_id = 0;
		//Check for unique IP-address and see if only one comment from this IP=address is allowed
	}
	
	//Captcha check
	if ($rsgConfig->get('comment_security') == 1) {
		//Securimage check - http://www.phpcaptcha.org
		//Include and call Securimage class
		include_once(JPATH_SITE.DS.'components'.DS.'com_rsgallery2'.DS.'lib'.DS.'rsgcomments'.DS.'securimage'.DS.'securimage.php');
		$securimage = new Securimage();
		//Check if user input is correct
		if ($securimage->check(JRequest::getString('captcha_code','','POST')) == false) {
			// The code was incorrect, go back (IE loses comment, Firefox & Safari keep it)
			echo "<script>confirm('".JText::_('COM_RSGALLERY2_INCORRECT_CAPTCHA_CHECK_COMMENT_IS_NOT_SAVED')."');window.history.go(-1);</script>";
			exit;
		} 
		//Securimage check - http://www.phpcaptcha.org - end
	}

	//If we are here, start database thing !Make sure text is quoted and numbers are integers!
	$sql = "INSERT INTO #__rsgallery2_comments (id, user_id, user_name, user_ip, parent_id, item_id, item_table, datetime, subject, comment, published, checked_out, checked_out_time, ordering, params, hits)" .
			" VALUES (" .
			"''," . 				//Autoincrement id (int)
			$user_id	."," .		//User id (int)
			$user_name	."," .		//User name (varchar(100)) -> quoted above
			$user_ip	."," .		//User IP address (varchar(50)) -> quoted above
			"''," .					//Parent id, defaults to zero. (int)
			$item_id."," .			//Item id (int)
			"'com_rsgallery2'," .	//Item table, if rsgallery2 commenting, field is empty (varchar(50))
			$dateTime	."," .		//Datetime (datetime)
			$subject	."," .		//Subject (varchar(100)) -> quoted above
			$comment	."," .		//Comment text (text) -> quoted above
			"1," .					//Published, defaults to 1 (int)
			"''," .					//Checked out (int)
			"''," .					//Checked_out_time (datetime)
			"''," .					//Ordering (int)
			"''," .					//Params (text)
			"''" .					//Hits (int)
			")";
	$database->setQuery( $sql );
	if ( $database->query() ) {
		$mainframe->redirect( $redirect_url, JText::_('COM_RSGALLERY2_COMMENT_ADDED_SUCCESFULLY') );
	} else {
		$mainframe->redirect( $redirect_url, JText::_('COM_RSGALLERY2_COMMENT_COULD_NOT_BE_ADDED') );
	}
	
}

/**
* Deletes a comment
* @param array An array of unique comment id numbers
* @param string The current url option
*/
function deleteComments( $option ) {
	$mainframe =& JFactory::getApplication();
	$database =& JFactory::getDBO();
	
	// Get the current JUser object
	$user = &JFactory::getUser();

	//Check permission to delete (only for users with core.admin on RSG2)
	if (!JFactory::getUser()->authorise('core.admin','com_rsgallery2'))
		die('Only admins can delete comments.');

	//Get parameters
	$id			= JRequest::getInt( 'id', '' );
	$item_id 	= JRequest::getInt( 'item_id'  , '');
	$catid 		= JRequest::getInt( 'catid'  , '');
	$Itemid 	= JRequest::getInt( 'Itemid'  , '');

	if ( !empty($id) ) {
		$query = 'DELETE FROM `#__rsgallery2_comments` WHERE `id` = '. (int) $id;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}
	$mainframe->redirect(JRoute::_("index.php?option=".$option."&Itemid=$Itemid&page=inline&id=".$item_id."&catid=".$catid, false), JText::_('COM_RSGALLERY2_COMMENT_DELETED_SUCCESFULLY') );
}
