<?php
/**
* RSGallery2 Toolbar Menu HTML
* @version $Id: toolbar.rsgallery2.html.php 1085 2012-06-24 13:44:29Z mirjam $
* @package RSGallery2
* @copyright (C) 2003 - 2011 RSGallery2
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
**/

// ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

class menu_rsg2_submenu{
	function addRSG2Submenu($rsgOption = '', $task = '') {

		//The template manager (still) has its own submenu
		if (!($rsgOption == 'installer')){
			//Control Panel
			JSubMenuHelper::addEntry(
				JText::_('COM_RSGALLERY2_SUBMENU_CONTROL-PANEL'),
				'index.php?option=com_rsgallery2',
		        (($rsgOption=='' AND $task == '' ) OR ($rsgOption == 'config')));
			//Upload
			JSubMenuHelper::addEntry(
				JText::_('COM_RSGALLERY2_SUBMENU_UPLOAD'),
				'index.php?option=com_rsgallery2&rsgOption=images&task=upload',
		        $rsgOption=='images' AND $task == 'upload');
		    //Batch Upload
			JSubMenuHelper::addEntry(
				JText::_('COM_RSGALLERY2_SUBMENU_BATCH-UPLOAD'),
				'index.php?option=com_rsgallery2&rsgOption=images&task=batchupload',
		        $rsgOption=='images' AND $task == 'batchupload');
			//Items
			JSubMenuHelper::addEntry(
				JText::_('COM_RSGALLERY2_SUBMENU_ITEMS'),
				'index.php?option=com_rsgallery2&rsgOption=images',
		        $rsgOption=='images' AND ($task == '' OR $task == 'view_images'));
		    //Galleries
			JSubMenuHelper::addEntry(
				JText::_('COM_RSGALLERY2_SUBMENU_GALLERIES'),
				'index.php?option=com_rsgallery2&rsgOption=galleries',
		        $rsgOption=='galleries' AND $task == '');

		}
	}
}

class menu_rsg2_maintenance{
	// Only those with core.manage can get here via $rsgOption = maintenance
	
	function regenerateThumbs() {
		// Check if core.admin is allowed
		$canDo	= Rsgallery2Helper::getActions();
		if ($canDo->get('core.admin')) {
			JToolBarHelper::custom('executeRegenerateDisplayImages','forward.png','forward.png','COM_RSGALLERY2_MAINT_REGEN_BUTTON_DISPLAY', false);
			JToolBarHelper::custom('executeRegenerateThumbImages','forward.png','forward.png','COM_RSGALLERY2_MAINT_REGEN_THUMBS', false);
			JToolBarHelper::spacer();
			JToolBarHelper::help( 'screen.rsgallery2',true);
		}
	}
}

class menu_rsg2_images{
    function upload() {
		JToolBarHelper::title( JText::_('COM_RSGALLERY2_UPLOAD'), 'generic.png' );
        JToolBarHelper::spacer();
        JToolBarHelper::custom('save_upload','upload.png','upload.png','COM_RSGALLERY2_UPLOAD', false);
        JToolBarHelper::spacer();
        JToolBarHelper::cancel();
        JToolBarHelper::spacer();
        JToolBarHelper::help( 'screen.rsgallery2',true );
    }

    function show() {
		$galleryId = JRequest::getInt('gallery_id',0);
		$canDo	= Rsgallery2Helper::getActions($galleryId);

        JToolBarHelper::title( JText::_('COM_RSGALLERY2_MANAGE_ITEMS'), 'generic.png' );
		
		if ($canDo->get('core.create')) {
			JToolBarHelper::custom('move_images','forward.png','forward.png','COM_RSGALLERY2_MOVE_TO', true);
			JToolBarHelper::custom('copy_images','copy.png','copy.png','COM_RSGALLERY2_COPY', true);
			JToolBarHelper::custom('upload','upload.png','upload.png','COM_RSGALLERY2_UPLOAD', false);
			JToolBarHelper::spacer();
		}
		if ($canDo->get('core.edit.state')) {
			JToolBarHelper::publishList();
			JToolBarHelper::unpublishList();
			JToolBarHelper::spacer();
		}
		if ($canDo->get('core.edit')) {
			JToolBarHelper::editListX();
			JToolBarHelper::spacer();
		}
        if ($canDo->get('core.delete')) {
		JToolBarHelper::deleteList();
        JToolBarHelper::spacer();
		}
		if ($canDo->get('core.admin')) {
			JToolBarHelper::custom('reset_hits','default.png','default.png','COM_RSGALLERY2_RESET_HITS', true);
			JToolBarHelper::spacer();
		}
        JToolBarHelper::help( 'screen.rsgallery2',true );
    }
    
    function edit() {
        JToolBarHelper::apply();
		JToolBarHelper::save();
        JToolBarHelper::spacer();
		JToolBarHelper::cancel();
        JToolBarHelper::spacer();
        JToolBarHelper::help( 'screen.rsgallery2',true );
    }
    
    function remove() {
        JToolBarHelper::cancel();
        JToolBarHelper::spacer();
        JToolBarHelper::custom('removeReal','delete_f2.png','','COM_RSGALLERY2_CONFIRM_REMOVAL', false);
        JToolBarHelper::spacer();
        JToolBarHelper::help( 'screen.rsgallery2',true );
        
    }
}

class menu_rsg2_galleries{
    function show() {
		$canDo	= Rsgallery2Helper::getActions();
		
		JToolBarHelper::title( JText::_('COM_RSGALLERY2_MANAGE_GALLERIES'), 'generic.png' );
        
		if ($canDo->get('core.edit.state')) {
			JToolBarHelper::publishList();
			JToolBarHelper::unpublishList();
			JToolBarHelper::spacer();
		}
        if ($canDo->get('core.edit')) {
			JToolBarHelper::editListX();
			JToolBarHelper::spacer();
		}
        if ($canDo->get('core.delete')) {
			JToolBarHelper::deleteList();
			JToolBarHelper::spacer();
		}
		if ($canDo->get('core.create')) {
			JToolBarHelper::addNewX();
			JToolBarHelper::spacer();
		}
        JToolBarHelper::help( 'screen.rsgallery2' ,true);
    }

    function edit() {
        JToolBarHelper::apply();
		JToolBarHelper::save();
        JToolBarHelper::spacer();
		JToolBarHelper::cancel();
        JToolBarHelper::spacer();
        JToolBarHelper::help( 'screen.rsgallery2',true );
    }
    
    function remove() {	//When a gallery is checked and delete is clicked this function is called to confirm removal
        JToolBarHelper::cancel();
        JToolBarHelper::spacer();
        JToolBarHelper::trash('removeReal', JText::_('COM_RSGALLERY2_CONFIRM_REMOVAL'), false);
        JToolBarHelper::spacer();
        JToolBarHelper::help( 'screen.rsgallery2',true );
    }
}

class menuRSGallery {

    function adminTasksMenuX() {
    }
    
    function image_new() {
        JToolBarHelper::save();
        JToolBarHelper::cancel();
        JToolBarHelper::spacer();
        }

    function image_edit() {
        JToolBarHelper::save('save_image');
        JToolBarHelper::cancel('view_images');
        JToolBarHelper::spacer();
        
        }
    
    function image_batchUpload() {
		JToolBarHelper::title( JText::_('COM_RSGALLERY2_BATCH_UPLOAD'), 'generic.png' );
        if( JRequest::getBool('uploaded'  , null) )
        	JToolBarHelper::custom('save_batchupload','upload.png','upload.png','COM_RSGALLERY2_UPLOAD', false);
		else
        	JToolBarHelper::custom('batchupload','forward.png','forward.png','COM_RSGALLERY2_NEXT', false);
        JToolBarHelper::spacer();
        JToolBarHelper::help('screen.rsgallery2',true);
        }
    
    function image_upload() {
		JToolBarHelper::title( JText::_('COM_RSGALLERY2_UPLOAD'), 'generic.png' );
        JToolBarHelper::custom('upload','upload_f2.png','upload_f2.png','COM_RSGALLERY2_UPLOAD', false);
		JToolBarHelper::custom('upload','forward.png','forward.png','COM_RSGALLERY2_NEXT', false);
        }
    
    function images_show() {
        JToolBarHelper::addNew('forward');
        JToolBarHelper::editList('edit_image');
        JToolBarHelper::deleteList( '', 'delete_image', JText::_('COM_RSGALLERY2_DELETE') );
        //menuRSGallery::adminTasksMenu();
        }
        
    function config_rawEdit() {
		$canDo	= Rsgallery2Helper::getActions();

		if ($canDo->get('core.admin')) {
			JToolBarHelper::title( JText::_('COM_RSGALLERY2_CONFIGURATION_RAW_EDIT'), 'generic.png' );
			JToolBarHelper::apply('config_rawEdit_apply');
			JToolBarHelper::save('config_rawEdit_save');
			JToolBarHelper::cancel();
		}
    }
    
    function config_dumpVars() {
		$canDo	= Rsgallery2Helper::getActions();

		if ($canDo->get('core.admin')) {
			JToolBarHelper::title( JText::_('COM_RSGALLERY2_CONFIGURATION_VARIABLES'), 'generic.png' );
			JToolBarHelper::cancel();
			JToolBarHelper::spacer();
		}
    }
    
    function config_show() {
        JToolBarHelper::title( JText::_('COM_RSGALLERY2_CONFIGURATION'), 'generic.png' );
        JToolBarHelper::apply('applyConfig');
        JToolBarHelper::save('saveConfig');
        JToolBarHelper::cancel();
        JToolBarHelper::help('screen.rsgallery2',true);
        //menuRSGallery::adminTasksMenu();
        }
        
	function edit_main() {
		JToolBarHelper::save( 'save_main' );
		JToolBarHelper::spacer();
		JToolBarHelper::cancel('templates');
	}

	function edit_thumbs() {
		JToolBarHelper::save( 'save_thumbs' );
		JToolBarHelper::spacer();
		JToolBarHelper::cancel('templates');
	}

	function edit_display() {
		JToolBarHelper::save( 'save_display' );
		JToolBarHelper::spacer();
		JToolBarHelper::cancel('templates');
	}

	function simple(){
		$user = JFactory::getUser();
		$canConfigure = $user->authorise('core.admin', 	'com_rsgallery2');
		
        JToolBarHelper::title( JText::_('COM_RSGALLERY2_CONTROL_PANEL'), 'generic.png' );
		//options button, only for uses who are allowed to see/use this
		if ($canConfigure){
			JToolBarHelper::help( 'options.rsgallery2',true);
			JToolBarHelper::preferences('com_rsgallery2');
		}
        JToolBarHelper::help('screen.rsgallery2', true);
        //menuRSGallery::adminTasksMenu();
    }
} 

class menu_rsg2_jumploader {
	function show() {
		JToolBarHelper::title( JText::_('COM_RSGALLERY2_JAVA_UPLOADER'), 'generic.png' );
		JToolBarHelper::apply('');
		JToolBarHelper::save('');
		JToolBarHelper::cancel();
		JToolBarHelper::help('screen.rsgallery2',true);
	}
	
	function simple() {
		JToolBarHelper::title( JText::_('COM_RSGALLERY2_JAVA_UPLOADER'), 'generic.png' );
		JToolBarHelper::help('screen.rsgallery2',true);
	}
}
?>