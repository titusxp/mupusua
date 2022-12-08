<?php
/**
* This file handles gallery manipulation functions for RSGallery2
* @version $Id: gallery.manager.php 1085 2012-06-24 13:44:29Z mirjam $
* @package RSGallery2
* @copyright (C) 2005 - 2011 RSGallery2
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* RSGallery2 is Free Software
*/
defined( '_JEXEC' ) or die( 'Access Denied.' );

/**
* Gallery utilities class
* @package RSGallery2
* @author Jonah Braun <Jonah@WhaleHosting.ca>
*/
class rsgGalleryManager{

	/**
	 * returns the rsgGallery object with all associated items (one of which is the given item id)
	 *
	 * @param id of item
	 */
	function getGalleryByItemID( $id = null ) {
		$database =& JFactory::getDBO();
		$mainframe =& JFactory::getApplication();

		// Make sure that the $id is an integer
		if( $id === null ){
			$id = JRequest::getInt( 'id', 0 );
		}
		$query = 'SELECT `gallery_id` FROM `#__rsgallery2_files` WHERE `id` = '. (int) $id;

		$database->setQuery ($query);
		$gid = $database->loadResult();
		
		if ($gid) {
			$rsgGalleryObject = rsgGalleryManager::get( $gid );
			return $rsgGalleryObject;	
		} else {
			// Redirect the user when the id of the gallery is not available
			$msg = JText::_('COM_RSGALLERY2_REQUESTED_GALLERY_DOES_NOT_EXIST');
			$mainframe->redirect("index.php",$msg);
		}
	}
	
	/**
	 * Returns an rsgItem_image (or rsgItem_audio) object, which is taken from
	 * an rsgGallery object and its associated items, based on the given item id.
	 * @param id of an item
	 * @deprecated Use rsgGallery->getItem() instead!
	**/
	function getItem( $id = null ){
		$gallery = rsgGalleryManager::get();
		return $gallery->getItem($id);
	}

    /**
     * Returns an rsgGallery object.
     * Checks for catid, gid in $_GET if no item id is given, 
     * and if those are not found then checks for (item) id in $_GET 
     * to get gallery id. 
     * @param id of the gallery
     */
	function get( $id = null ){
		global $rsgConfig;
		$mainframe =& JFactory::getApplication();
		$user	= JFactory::getUser();
		$groups	= $user->getAuthorisedViewLevels();

		if( $id === null ){
			$id = JRequest::getInt( 'catid', 0 );
			$id = JRequest::getInt( 'gid', $id );
			
			if( !$id ){
				// check if an item id is set and if so return the gallery for that item id
				if( JRequest::getInt( 'id', 0 ))
					return rsgGalleryManager::getGalleryByItemID();
			}
		}

		$gallery = rsgGalleryManager::_get( $id );

		// Only show a gallery in the frontend if it's published and user has view access, 
		// else only show it when user is owner (shows red H icon to show that the gallery is
		// unpublished in the frontend) --> View Access Levels
		// In the backend they all galleries are shown.
		if ($mainframe->isSite()) {	// Frontend check
			$owner 		= ($user->id == $gallery->uid);			// Owner check
			$access 	= in_array($gallery->access, $groups);	// Access check
			$published	= ($gallery->published == 1);			// Published check
			if (!($published AND $access)) {
				if (!$owner) {
					// "You are not authorised to view this resource."
					$mainframe->redirect("index.php", JText::_('JERROR_ALERTNOAUTHOR'));
				}
			} 
		}
		//Add gallery to list to show
		return $gallery;
	}

    /**
     * returns an array of all images in $parent and sub galleries
     * @param int id of parent gallery
     * @todo this is a stub, no functionality yet
     */
    function getFlatArrayofImages( $parent ){
        return true;
    }
    /**
     * returns an array of all sub galleris in $parent including $parent
     * @param int id of parent gallery
     * @todo this is a stub, no functionality yet
     */
    function getFlatArrayofGalleries( $parent ){
        return true;
    }

    /**
     * returns an array of galleries from an array of IDs
     * @param id of the gallery
     */
    function getArray( $cid ){
        $galleries = array();
        
        foreach( $cid as $gid ){
            $galleries[] = rsgGalleryManager::_get( $gid );
        }
        return $galleries;
    }
    
    /**
     * returns an array of galleries: the children of the given gallery that will be shown
     * @param id of parent gallery
     */
    function getList( $parent ){
        global $rsgConfig;
		$database = JFactory::getDBO();
		$app =& JFactory::getApplication();
        if( !is_numeric( $parent )) return false;
		
		$user	= JFactory::getUser();
		$groups	= $user->getAuthorisedViewLevels();
        
		$query = 'SELECT * FROM `#__rsgallery2_galleries` '.
                    ' WHERE `parent` = '. (int) $parent .
                    ' ORDER BY ordering ASC ';
        $database->setQuery($query);
        $rows = $database->loadAssocList();
        $galleries = array();

        foreach( $rows as $row ){
			// Only show gallery in the frontend if it's published and user has view access, 
			// else only show it when user is owner (shows red H icon to show that the gallery 
			// is unpublished in the frontend) --> View Access Levels
			if ($app->isSite()) {	// Frontend check
				$owner 		= ($user->id == $row['uid']);			// Check user is owner
				$access 	= in_array($row['access'], $groups);	// Check view access
				$published	= ($row['published'] == 1);			// Check published
				if (!($published AND $access)) {
					if (!$owner) {
						continue;	// don't show this gallery, e.g. don't add it to the array
					}
				}
				//Add gallery to list to show
				$galleries[] = new rsgGallery( $row );
			}
        }
        return $galleries;
    }

    /**
     * recursively deletes all galleries and subgalleries in array
     * @param array of gallery ids
     */
    function deleteArray( $cid ){
		// delete all galleries and sub galleries
        $galleries = rsgGalleryManager::_getArray( $cid );

        return rsgGalleryManager::_deleteTree( $galleries );
    }

    /*
        private functions
        no access checks are made, do not use outside this class!
    */

	/**
	 * Returns an rsgGallery object of the gallery which id was given
	 * with all associated items
	 * @param the id of a gallery
	*/
	function _get( $gallery ){
		static $galleries = array();

		if( !isset( $galleries[$gallery] )){
			$database =& JFactory::getDBO();
		
			if( !is_numeric( $gallery )) die("gallery id is not a number: $gallery");
			
			$query = 'SELECT * FROM `#__rsgallery2_galleries` '.
						' WHERE id = '. (int) $gallery .
						' ORDER BY `ordering` ASC ';
				//MK don't check on viewing access here: requires logic which is in functions getList and get
			$database->setQuery($query);
			$row = $database->loadAssocList();
			if( count($row)==0 && $gallery!=0 ){
				JError::raiseError( 1, "gallery id does not exist: $gallery" );
			}
			else if( count($row)==0 && $gallery==0 ){
				// gallery is root, and it aint in the db, so we have to create it.
				return rsgGalleryManager::_getRootGallery();
			}
			$row = $row[0];
		
			$galleries[$gallery] = new rsgGallery( $row );
		}
		return $galleries[$gallery];
	}

    /**
     * return the top level gallery
     * this is a little interesting, because the top level gallery is a pseudo gallery, but we need to create some 
     * usefull values so that it can be used as a real gallery.
     * @todo possibly have the top level gallery be a real gallery in the db.  this obviously needs to be discussed more.
     * @todo are these good defaults?  not sure....
     * @param rsgGallery object
     */
    function _getRootGallery(){
        global $rsgConfig;

        return new rsgGallery( array(
            'id'=>0,
            'parent'=>null,
            'name'=>'',
            'description'=>$rsgConfig->get("intro_text"),
            'published'=>1,
            'checked_out'=>false,
            'checked_out_time'=>null,
            'ordering'=>0,
            'date'=>'0000-00-00 00:00:00',
            'hits'=>0,
            'params'=>'',
            'user'=>'',
            'uid'=>'',
            'allowed'=>'',
            'thumb_id'=>'',
            'access'=>1		// Access is Public
        ));
    }
    
    /**
     * returns an array of galleries from an array of IDs
     * @param id of the gallery
     */
    function _getArray( $cid ){
        $galleries = array();
        
        foreach( $cid as $gid ){
            $galleries[] = rsgGalleryManager::_get( $gid );
        }
        return $galleries;
    }

    /**
     * recursively deletes a tree of galleries
     * @param id of the gallery
     * @todo this is a quick hack.  galleryUtils and imgUtils need to be reorganized; and a rsgImage class created to do this proper
     */
    function _deleteTree( $galleries ){
		$database =& JFactory::getDBO();
        foreach( $galleries as $gallery ){
            rsgGalleryManager::_deleteTree( $gallery->kids() );

            // delete images in gallery
            foreach( $gallery->items() as $item ){
				if (!imgUtils::deleteImage( galleryUtils::getFileNameFromId( $item->id ))) {
					$msg = JText::sprintf('COM_RSGALLERY2_UNABLE_DELETE_IMAGE', $item->name, $item->id);
					JFactory::getApplication()->enqueueMessage( $msg, 'Error' );
					JFactory::getApplication()->enqueueMessage( JText::_('COM_RSGALLERY2_DID_NOT_CONTINU_DELETING_GALLERY_AND_CONTENTS'), 'Error' );
					return false;
				}
            }

            // delete gallery
            $id = $gallery->get('id');
            if( !is_numeric( $id )) return false;
			
			//Check delete authorisation for this gallery
			if (!JFactory::getUser()->authorise('core.delete','com_rsgallery2.gallery.'.$id)) {
				return false;	//MK// todo check if this works correctly
			} else {
				$row = new rsgGalleriesItem( $database );
				if (!$row->delete($id)){
					JError::raiseError(500, $row->getError() );
				}
			}
		}
	}
}