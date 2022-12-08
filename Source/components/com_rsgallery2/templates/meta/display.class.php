<?php
/**
 * This class encapsulates the HTML for the non-administration RSGallery pages.
 * @version $Id: display.class.php 1098 2012-07-31 11:54:19Z mirjam $
 * @package RSGallery2
 * @copyright (C) 2003 - 2012 RSGallery2
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined( '_JEXEC' ) or die( 'Restricted Access' );

class rsgDisplay extends JObject{
	
	var $params = null;
	
	var $currentItem = null;
	function __construct(){
		global $rsgConfig;
		
		$this->gallery = rsgInstance::getGallery();

		//Pre 3.0.2: always got template 'semantic' even when showing a slideshow; $template is only used here to get templateparameters
		//Does the page show the slideshow? Then get slideshow name, else get template name.
		if (JRequest::getCmd('page') == 'slideshow') {
			$template = $rsgConfig->get('current_slideshow');
		} else {
			$template = $rsgConfig->get('template');
		}
		
		// load template parameters
		jimport('joomla.filesystem.file');
		// Read the ini file
		$ini	= JPATH_RSGALLERY2_SITE .DS. 'templates'.DS.$template.DS.'params.ini';
		if (JFile::exists($ini)) {
			$content = JFile::read($ini);
		} else {
			$content = null;
			$ini_contents = '';
			JFile::write($ini,$ini_contents);
		}
		$xml	= JPATH_RSGALLERY2_SITE .DS. 'templates'.DS.$template .DS.'templateDetails.xml';
		$this->params = new JParameter($content, $xml, 'template');
		
	}
	
	/**
	 * Switch for the main page, when not handled by rsgOption
	 */
	function mainPage(){
		global $rsgConfig;
		$page = JRequest::getCmd( 'page', '' );

		switch( $page ){
			case 'slideshow':
				$gallery = rsgGalleryManager::get();
				JRequest::setVar( 'rsgTemplate', $rsgConfig->get('current_slideshow'));
				//@todo This bit is leftover from J!1.5: look into whether or not this can be removed and how.
				rsgInstance::instance( array( 'rsgTemplate' => $rsgConfig->get('current_slideshow'), 'gid' => $gallery->id ));
			break;
			case 'inline':
				$this->inline();
			break;
			case 'viewChangelog':
				$this->viewChangelog();
			break;
			case 'test':
				$this->test();
				break;
			default:
				$this->showMainGalleries();
				$this->showThumbs();
		}
	}
	
	/**
	 * Debug only
	 */
	function test() {
		
		echo "test code goes here!";
		$folders = JFolder::folders('components/com_rsgallery2/templates');
		foreach ($folders as $folder) {
			if (preg_match("/slideshow/i", $folder)) {
				$folderlist[] = $folder;
			}
		}
		echo "<pre>";
		print_r($folderlist);
		echo "</pre>";
		
	}
	/**
	 *  write the footer
	 */
	function showRsgFooter(){
		global $rsgConfig, $rsgVersion;
	
		$hidebranding = '';
		if( $rsgConfig->get( 'displayBranding' ) == false )
			$hidebranding ="style='display: none'";
			
		?>
		<div id='rsg2-footer' <?php echo $hidebranding; ?>>
			<br /><br /><?php echo $rsgVersion->getShortVersion(); ?>
		</div>
		<div class='rsg2-clr'>&nbsp;</div>
		<?php
	}

	/**
	 * 
	 */
	function display( $file = null ){
		global $rsgConfig;
		$template = preg_replace( '#\W#', '', JRequest::getCmd( 'rsgTemplate', $rsgConfig->get('template') ));
		$templateDir = JPATH_RSGALLERY2_SITE . DS . 'templates' . DS . $template . DS . 'html';
	
		$file = preg_replace('/[^A-Z0-9_\.-]/i', '', $file);

		include $templateDir . DS . $file;
	}

	/**
	 * Shows the top bar for the RSGallery2 screen
	 */
	function showRsgHeader() {
		$rsgOption 	= JRequest::getCmd( 'rsgOption'  , '');
		$gid 		= JRequest::getInt( 'gid'  , null);
		
		if (!$rsgOption == 'mygalleries' AND !$gid) {
			?>
			<div class="rsg2-mygalleries">
			<a class="rsg2-mygalleries_link" href="<?php echo JRoute::_("index.php?option=com_rsgallery2&rsgOption=myGalleries");?>"><?php echo JText::_('COM_RSGALLERY2_MY_GALLERIES') ?></a>
			</div>
			<div class="rsg2-clr"></div>
			<?php
		}
	}
	
	/**
	 * Shows contents of changelog.php in preformatted layout
	 */
	function viewChangelog() {
		global $rsgConfig;
	
		if( !$rsgConfig->get('debug')){
			echo JText::_('COM_RSGALLERY2_FEATURE_ONLY_AVAILABLE_IN_DEBUG_MODE');
			return;
		}
		
		echo '<pre style="text-align: left;">';
		readfile( JPATH_SITE . '/administrator/components/com_rsgallery2/changelog.php' );
		echo '</pre>';
	}
	
    /**
     * Shows the proper Joomla path
     */
	function showRSPathWay() {
		$mainframe =& JFactory::getApplication();
		$pathway =& $mainframe->getPathway();
		
		// Only show pathway if rsg2 is the component
		$option = JRequest::getCmd('option');
		if( $option != 'com_rsgallery2' )
			return;

		//Check from where the path should be taken: if there is no gid in the 
		// menu-link, it is the root, e.g. gid=0, if there is a gid that's the 
		// start for this pathway
		$theMenu = JSite::getMenu();
		$theActiveMenuItem = $theMenu->getActive();
		if (isset($theActiveMenuItem->query['gid'])) { 
			$gidInActiveMenutItem = $theActiveMenuItem->query['gid'];
			} else {
			$gidInActiveMenutItem =  '0';
			}			
			
		//Get the gallery id (gid) of the currently gallery shown
		$gallery = rsgInstance::getGallery();
		$currentGallery = $gallery->id;

		//Get the current item shown
		$item = rsgInstance::getItem();

		//If the current gallery id (gid) is the one in the menu, no parent 
		// galleries are needed, if not, get the parent galleries up until 
		// the active one. 
		if (!($currentGallery == $gidInActiveMenutItem)){
			$galleries = array();
			$galleries[] = $gallery;
			//stop at the active one
			while ( $gallery->parent != $gidInActiveMenutItem) {
				$gallery = $gallery->parent();
				$galleries[] = $gallery;
			}
			$galleries = array_reverse($galleries);
			foreach( $galleries as $gallery ) {
				if ( $gallery->id == $currentGallery && empty($item) ) {
					$pathway->addItem( $gallery->name );
				} else {
					if($gallery->id != 0)
					{
						$link = 'index.php?option=com_rsgallery2&gid=' . $gallery->id;
						$pathway->addItem( $gallery->name, $link );
					}
				}
			}
		}

		//Add image name to pathway if an image is displayed (page in URL is the string 'inline')
		$page = JRequest::getCmd( 'page', '' );
		if ($page == 'inline') {
			$pathway->addItem( $item->title );
		}
	}

	/**
	 * Insert meta data and page title into head
	 */
	function metadata(){
		$app =& JFactory::getApplication();
		$document=& JFactory::getDocument();
		
		$option 	= JRequest::getCmd('option');
		$Itemid 	= JRequest::getInt('Itemid',Null);
		$gid 		= JRequest::getInt('gid',Null);
		$id 		= JRequest::getInt('id',Null);
		$limitstart = JRequest::getInt('limitstart',Null);
		$page		= JRequest::getCmd('page',Null);

		// Get the gid in the URL of the active menu item
		if (isset(JSite::getMenu()->getActive()->query['gid'])){
			$menuGid = JSite::getMenu()->getActive()->query['gid'];
		} else {
			$menuGid = Null;
		}
		
		// If RSG2 isn't the component being displayed, don't append meta data
		if( $option != 'com_rsgallery2' )
			return;

		// Get the title and description from gallery and (if shown) item
		if (isset($gid)) {
			if ($menuGid == $gid) {
				// Do nothing: showing menu item
				return;
			} else {
				// Get gallery title/description
				$title = $this->gallery->name;
				$description = $this->gallery->description;
				// Only add item title/description when item is shown (when page=='inline')
				if (isset($page) and $page = 'inline') {
					// Get current item, add item title to pagetitle 
					// and set item description in favor of gallery description
					$item = array_slice($this->gallery->items, $limitstart, 1);
					$title .= ' - '.$item[0]->title;
					$description = $item[0]->descr;
				}
			}
		} else {
			// No gid, only id
			// $this rsgDisplay_semantic object holds rsgGallery2 object with current gallery info
			$title = $this->gallery->name;
			$title .= ' - ';
			// Add image title
			$title .= rsgInstance::getItem()->title;
			// Get image description
			$description = rsgInstance::getItem()->descr;
		}

		// Clean up description
		$description = htmlspecialchars(stripslashes(strip_tags($description)), ENT_QUOTES );

		// Set page title and meta description
		$document->setTitle($title);
		$document->setMetadata('description', $description);

		return;
	}

	function getGalleryLimitBox(){
		$pagelinks = $this->pageNav->getLimitBox("index.php?option=com_rsgallery2");
		// add form for LimitBox
		$pagelinks = '<form action="'.JRoute::_("index.php?option=com_rsgallery2&gid=".$this->gallery->id).'" method="post">' .
			         $pagelinks . 
					'</form>';

		return $pagelinks; 
	}
	function getGalleryPageLinks(){
		$pagelinks = $this->pageNav->getPagesLinks("index.php?option=com_rsgallery2");
		return $pagelinks;
		
	}
	function getGalleryPagesCounter(){
		return $this->pageNav->getPagesCounter();
	}
	
	/***************************
		private functions
	***************************/
	
    /**
     * shows the image
     */
    function _showImageBox($name, $descr) {
        global $rsgConfig ;

        if ($rsgConfig->get('watermark') == true) {
            ?>
            <img class="rsg2-displayImage" src="<?php echo waterMarker::showMarkedImage($name);?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" />
            <?php
        } else {
            ?>
			<img class="rsg2-displayImage"  src="<?php echo imgUtils::getImgDisplay($name); ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>"  />
            <?php
        }
    }
    /**
     * Shows the comments screen
     */
    function _showComments() {
     	global $rsgConfig;
		$gallery = rsgGalleryManager::get();

		//Check if user is allowed to comment (permission rsgallery2.comment on asset com_rsgallery2.gallery."gallery id"
		if (JFactory::getUser()->authorise('rsgallery2.comment','com_rsgallery2.gallery.'.$gallery->id)) {
			$item = $gallery->getItem();
			$id = $item->id;
			
    		//Adding stylesheet for comments (is this needed as it is in rsgcomments.class.php as well?)
			$doc =& JFactory::getDocument();
			$doc->addStyleSheet(JURI_SITE."/components/com_rsgallery2/lib/rsgcomments/rsgcomments.css");
			
			$comment = new rsgComments();
			$comment->showComments($id);
			$comment->editComment($id);
		} else {
			echo JText::_('COM_RSGALLERY2_COMMENTING_IS_DISABLED');
		}
    }
    
    /**
     * Shows the voting screen
     */
    function _showVotes() {
    	global  $rsgConfig;
		$gallery = rsgGalleryManager::get();

		//Check if user is allowed to vote (permission rsgallery2.vote on asset com_rsgallery2.gallery."gallery id"
		if (JFactory::getUser()->authorise('rsgallery2.vote','com_rsgallery2.gallery.'.$gallery->id)) {
			//Adding stylesheet for comments 
			$doc =& JFactory::getDocument();
			$doc->addStyleSheet(JURI_SITE."/components/com_rsgallery2/lib/rsgvoting/rsgvoting.css");
    		
			$voting = new rsgVoting();
			$voting->showScore();
   			$voting->showVoting();
    	} else {
    		echo JText::_('COM_RSGALLERY2_VOTING_IS_DISABLED');
    	}
    }
    
    /**
     * Shows either random or latest images, depending on parameter
     * @param String Type of images. Options are 'latest' or 'random'
     * @param Int Number of images to show. Defaults to 3
     * @param String Style, options are 'vert' or 'hor'.(Vertical or horizontal)
     * @return HTML representation of image block.
     */
    function showImages($type="latest", $number = 3, $style = "hor") {
    	global $rsgConfig;
    	$database = JFactory::getDBO();
		
		//Check if backend permits showing these images
		if ( $type == "latest" AND !$rsgConfig->get('displayLatest') ) {
			return;
		} elseif ( $type == "random" AND !$rsgConfig->get('displayRandom') ) {
			return;
		}
		
    	switch ($type) {
    		case 'random':
				$query = 'SELECT file.date, file.gallery_id, file.ordering, file.id, file.name, file.title '.
                        ' FROM #__rsgallery2_files as file, #__rsgallery2_galleries as gal '.
                        ' WHERE file.gallery_id = gal.id and gal.published = 1 AND file.published = 1 '.
                        ' ORDER BY rand() limit '. (int) $number ;
    			$database->setQuery($query);
    			$rows = $database->loadObjectList();
    			$title = JText::_('COM_RSGALLERY2_RANDOM_IMAGES');
    			break;
    		case 'latest':
				$query = 'SELECT file.date, file.gallery_id, file.ordering, file.id, file.name, file.title '.
                        ' FROM #__rsgallery2_files as file, #__rsgallery2_galleries as gal '.
                        ' WHERE file.gallery_id = gal.id AND gal.published = 1 AND file.published = 1 '.
                        ' ORDER BY file.date DESC LIMIT '. (int) $number;
				$database->setQuery($query);
    			$rows = $database->loadObjectList();
    			$title = JText::_('COM_RSGALLERY2_LATEST_IMAGES');
    			break;
    	}
    	
    	if ($style == "vert") {
    	?>
    	     <ul id='rsg2-galleryList'>
                <li class='rsg2-galleryList-item' >
                    <table class="table_border" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td><?php echo $title;?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <?php
                    foreach($rows as $row) {
                        $l_start = $row->ordering - 1;
				$url = JRoute::_("index.php?option=com_rsgallery2&page=inline&id=".$row->id);
                        ?>
                        <tr>
                        <td align="center">
                            <div class="shadow-box">
                            	<div class="img-shadow">
                            	<a href="<?php echo $url;?>">
								<img src="<?php echo imgUtils::getImgThumb($row->name);?>" alt="<?php echo $row->title;?>" width="<?php echo $rsgConfig->get('thumb_width');?>" />
                                </a>
                            	</div>
                                <div class="rsg2-clr"></div>
                                <div class="rsg2_details"><?php echo JHTML::_("date",$row->date);?></div>
                            </div>
                        </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                </li>
            </ul>
            <?php
        } else {
            ?>
            <ul id='rsg2-galleryList'>
                <li class='rsg2-galleryList-item' >
                    <table class="table_border" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                        <td colspan="3"><?php echo $title;?></td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr>
                        <?php
                        foreach($rows as $row)
                            {
                            $l_start = $row->ordering - 1;
							$url = JRoute::_("index.php?option=com_rsgallery2&page=inline&id=".$row->id);
                            ?>
                            <td align="center">
                            <div class="shadow-box">
                            	<div class="img-shadow">
                            	<a href="<?php echo $url;?>">
								<img src="<?php echo imgUtils::getImgThumb($row->name);?>" alt="<?php echo $row->title;?>" width="<?php echo $rsgConfig->get('thumb_width');?>"  />
                            	</a>
                            	</div>
                            	<div class="rsg2-clr"></div>
								<div class="rsg2_details"><?php echo JText::_('COM_RSGALLERY2_UPLOADED-') ?>&nbsp;<?php echo JHTML::_("date",$row->date);?></div>
                            </div>
                            </td>
                            <?php
                            }
                        ?>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    </table>
                </li>
            </ul>
            <?php
        }
    }
    
	/**
	 * Write downloadlink for image
	 * @param int image ID
	 * @param string Text below button
	 * @param string Button or HTML link (button/link)
	 * @return HTML for downloadlink
	 */
	function _writeDownloadLink($id, $showtext = true, $type = 'button') {
		global $rsgConfig;
		if ( $rsgConfig->get('displayDownload') ) {
			echo "<div class=\"rsg2-toolbar\">";
			if ($type == 'button') {
				?>
				<a href="<?php echo JRoute::_('index.php?option=com_rsgallery2&task=downloadfile&id='.$id);?>">
				<img height="20" width="20" src="<?php echo JURI::base();?>/components/com_rsgallery2/images/download_f2.png" alt="<?php echo JText::_('COM_RSGALLERY2_DOWNLOAD')?>">
				<?php
				if ($showtext == true) {
					?>
					<br /><span style="font-size:smaller;"><?php echo JText::_('COM_RSGALLERY2_DOWNLOAD')?></span>
					<?php
				}
				?>
				</a>
				<?php
			} else {
				?>
				<a href="<?php echo JRoute::_('index.php?option=com_rsgallery2&task=downloadfile&id='.$id);?>"><?php echo JText::_('COM_RSGALLERY2_DOWNLOAD');?></a>
				<?php
			}
			echo "</div><div class=\"rsg2-clr\">&nbsp;</div>";
		}
	}
	
	/**
	 * Provides unformatted EXIF data for the current item
	 * @result Array with EXIF values
	 */
	function _showEXIF() {
		require_once(JPATH_ROOT . DS . "components" . DS . "com_rsgallery2" . DS . "lib" . DS . "exifreader" . DS . "exifReader.php");
		$image = rsgInstance::getItem();
		$filename = JPATH_ROOT . $image->original->name;
		
		$exif = new phpExifReader($filename);
		$exif->showFormattedEXIF();
 	}    
    
    function showSearchBox() {
		global $rsgConfig;
		
		if($rsgConfig->get('displaySearch') != 0)
		{
			require_once(JPATH_ROOT . DS . "components" . DS . "com_rsgallery2" . DS . "lib" . DS . "rsgsearch" . DS . "search.html.php");
			html_rsg2_search::showSearchBox();
		}
    }
    
    function showSearchBoxXX() {
    	$mainframe =& JFactory::getApplication();		
    	$css = "<link rel=\"stylesheet\" href=\"".JURI_SITE."/components/com_rsgallery2/lib/rsgsearch/rsgsearch.css\" type=\"text/css\" />";
    	$mainframe->addCustomHeadTag($css);
    	?>

    	<div align="right">
    	<form name="rsg2_search" method="post" action="<?php echo JRoute::_('index.php');?>">
    		<?php echo JText::_('COM_RSGALLERY2_SEARCH');?>
    		<input type="text" name="searchtext" class="searchbox" onblur="if(this.value=='') this.value='<?php echo JText::_('COM_RSGALLERY2_KEYWORDS');?>';" onfocus="if(this.value=='<?php echo JText::_('COM_RSGALLERY2_KEYWORDS');?>') this.value='';" value='<?php echo JText::_('COM_RSGALLERY2_KEYWORDS');?>' />
			<input type="hidden" name="option" value="com_rsgallery2" />
			<input type="hidden" name="rsgOption" value="search" />
			<input type="hidden" name="task" value="showResults" />
    	</form>
    	</div>
    	<?php
    }
    /*
    function showRSTopBar() {
        global $my, $mainframe, $rsgConfig,;
        $catid =JRequest::getInt( 'catid', 0 );
        $page = JRequest::getCmd( 'page'  , null);
        ?>
        <div style="float:right; text-align:right;">
        <ul id='rsg2-navigation'>
            <li>
                <a href="<?php echo JRoute::_("index.php?option=com_rsgallery2"); ?>">
                <?php echo JText::_('COM_RSGALLERY2_MAIN_GALLERY_PAGE'); ?>
                </a>
            </li>
            <?php 
            if ( !$my->id == "" && $page != "my_galleries" && $rsgConfig->get('show_mygalleries') == 1):
            ?>
            <li>
                <a href="<?php echo JRoute::_("index.php?option=com_rsgallery2&rsgOption=myGalleries");?>">
                <?php echo JText::_('COM_RSGALLERY2_MY_GALLERIES'); ?>
                </a>
            </li>
            <?php
            elseif( $page == "slideshow" ): 
            ?>
            <li>
                <a href="<?php echo JRoute::_("index.php?option=com_rsgallery2&page=inline&catid=".$catid."&id=".$_GET['id']);?>">
                <?php echo JText::_('COM_RSGALLERY2_EXIT_SLIDESHOW'); ?>
                </a>
            </li>
        <?php endif; ?>
        </ul>
        </div>
        <div style="float:left;">
        <?php if( isset( $catid )): ?>
            <h2 id='rsg2-galleryTitle'><?php htmlspecialchars(stripslashes(galleryUtils::getCatNameFromId($catid)), ENT_QUOTES) ?></h2>
        <?php elseif( $page != "my_galleries" ): ?>
            <h2 id='rsg2-galleryTitle'><?php echo JText::_('COM_RSGALLERY2_GALLERY') ?></h2>
        <?php endif; ?>
        </div>
        <?php
    }
	*/
}
?>
