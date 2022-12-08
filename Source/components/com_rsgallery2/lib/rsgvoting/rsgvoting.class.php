<?php
/**
* This file contains the class used for voging.
* @version $Id: rsgvoting.class.php 1085 2012-06-24 13:44:29Z mirjam $
* @package RSGallery2
* @copyright (C) 2003 - 2012 RSGallery2
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* RSGallery is Free Software
*/

defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

class rsgVoting {

    function rsgVoting() {
    }
    
    function showVoting( $option = "com_rsgallery2") {
    	global $rsgConfig;
		$item = rsgInstance::getItem();
		$gid = $item->gallery_id;
		
    	if (JFactory::getUser()->authorise('rsgallery2.vote','com_rsgallery2.gallery.'.$gid)) {
			$id = $item->id;
			require_once(JPATH_RSGALLERY2_SITE . DS . 'lib' . DS . 'rsgvoting' . DS .'tmpl' . DS . 'form.php');
	    }
    }

	
	function getTotal( $id ) {
		$database =& JFactory::getDBO();
		$sql = 'SELECT `rating` FROM `#__rsgallery2_files` WHERE `id` = '. (int) $id;
		$database->setQuery($sql);
		$total = $database->loadResult();
		
		return $total;
	}
	
	function getVoteCount( $id ) {
		$database =& JFactory::getDBO();
		$sql = 'SELECT `votes` FROM `#__rsgallery2_files` WHERE `id` = '. (int) $id;
		$database->setQuery($sql);
		$votes = $database->loadResult();
		
		return $votes;
	}
	
	function calculateAverage( $id ) {
		if (rsgVoting::getVoteCount($id) > 0) {
			$avg = rsgVoting::getTotal($id) / rsgVoting::getVoteCount($id);
   			$value = round(($avg*2), 0)/2;
   			return $value;
		} else {
			return 0;
		}
	}
	
	function showScore() {
		$item = rsgInstance::getItem();
		$id = $item->id;
		require_once(JPATH_RSGALLERY2_SITE . DS . 'lib' . DS . 'rsgvoting' . DS .'tmpl' . DS . 'result.php');
	}
	/**
	 * Check if the user already voted for this item
	 * @param int ID of item to vote on
	 * @return True or False
	 */
	function alreadyVoted( $id ) {
		global $rsgConfig;

		if($rsgConfig->get('voting_once') == 0)
			return false;
			
		//Check if cookie rsgvoting was set for this image!
		$cookie_name = $rsgConfig->get('cookie_prefix').$id;
		if (isset($_COOKIE[$cookie_name])) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Checks if it is allowed to vote in this gallery
	 * @return True or False
	 */
	function voteAllowed() {
		$item_id	= JRequest::getInt('id');
		$gid		= galleryUtils::getCatIdFromFileId($item_id);
		
		$voteAllowed = (JFactory::getUser()->authorise('rsgallery2.vote','com_rsgallery2.gallery.'.$gid) ? true : false);
		return $voteAllowed;
	}
}
?>
