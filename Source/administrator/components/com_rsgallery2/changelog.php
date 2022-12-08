<?php
/**
* Changelog for RSGallery2
* @version $Id: changelog.php 1098 2012-07-31 11:54:19Z mirjam $
* @package RSGallery2
* @copyright (C) 2003 - 2012 RSGallery2
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* RSGallery is Free Software
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>

Check for the latest version of RSGallery2 at http://www.rsgallery2.nl/

1. Changelog
------------
This is a non-exhaustive but informative changelog for
RSGallery2, including alpha, beta and stable releases.
Our thanks to all those people who've contributed bug reports and
code fixes.

Legend:

* -> Security Fix
# -> Bug Fix
+ -> Addition
^ -> Change
- -> Removed
! -> Note


! To do: Don't install/remove database table #__rsgallery2_acl
! To do: Backend: Installation of template does not function (yet).
! To do: find all 'config_' links that don't have rsgOption=config and add it.
  To do: Delete galleries: create filter in gallery view and check that delete-permission is granted for deleting subgalleries/images. Right now you may delete everything if you have delete permission for the component, even if an item/(sub)gallery doesn't have delete permission.
  To do: Convert JParameter to JForm http://docs.joomla.org/Adapting_a_Joomla_1.5_extension_to_Joomla_1.6#Converting_Your_JParameters_to_JForms

---------------- Recent ----------------

* --------------- 3.2.0 -- SVN 1098 -- 2012-07-31 -------------

2012-07-31 Mirjam - SVN 1096
^ Comment form allows only bold/italic/underline and saves accordingly

2012-07-26 Mirjam - SVN 1094
^ Comments are limited to only have bold/italic/underline in them.
^ For metadata: only get gid from menu item URL when one is set to avoid Notice.

2012-07-13 Mirjam - SVN 1091
+ Added (empty) index.html to each directory

2012-07-09 Mirjam - SVN 1090
! Added Control Panel note for those with "Configure" permission about Create Own/Delete Own/Edit State Own being limited to frontend for now
^ Help screen for permissions (options.rsgallery2.html) is updated)
^ "Default state for uploaded images (for users with Edit State permission)" now also takes "Edit State Own" permission into account (in the frontend)

2012-07-09 Mirjam - SVN 1089
^ Now using JHtmlTabs instead of JPane for description/voting/comment/exif tabs

2012-07-05 Mirjam - SVN 1088
^ Comments no longer use BBCode and are now saved as HTML

2012-06-17 Mirjam - SVN 1084
# Metadata: only item title/description when item is showing (new condition: not limitstart but page=inline).
^ Superadministrators (they have core.admin) can see the unpublished items/galleries in the frontend. Their styling has class system-unpublished with style inherited from the Joomla template.
# The number of indicated galleries shown between parentheses for subgalleries of a gallery (gallery view) can now include the items in their subgalleries (with setting "Include items in child galleries when displaying number of items in a gallery" = Yes).

2012-06-17 Mirjam - SVN 1083
^ Now using JHtmlTabs instead of JPane for My Galleries tabs
# Fixed Fatal error when deleting item via Consolidate Database (Class 'rsgImagesItem' not found in .../administrator/components/com_rsgallery2/includes/img.utils.php on line 416)
! When you get a message "Item could not be deleted from the database" and "Image(s) were not deleted!" after attempying to delete an item via Consolidate Database, it could be a problem with the asset: find the item in RSGallery2's backend, open the item and save it. Then try deleting it again.
# Fixed: Regenerate display images can be used on images with spaces in their filenames.
# Fixed: Item pagination was incorrect when having unpublished items in a gallery.
^ Mouse pointer will be a "hand" for an item showing when Joomla Modal is used as popup option.

2012-06-10 Mirjam - SVN 1082
# Gallery thumbnail can no longer be a thumbnail of a published item in a unpublished subgallery.
# (Published) Items in unpublished subgalleries no longer count for the number of images their parent gallery (with setting "Include items in child galleries when displaying number of items in a gallery" = Yes).
+ When user is logged in, the blue/red/green icons showing that the user is owner/gallery is unpublished/user can upload are now showing for the list of subgalleries as well.
^ Some changes to the fi-FI finnish language file.

2012-06-07 Mirjam - SVN 1081
^ Small changes for duplicate language strings in all language files.

2012-06-06 Mirjam - SVN 1080
# Moved pageNav object for galleries in My Galleries out of "Display gallery limitbox"-if-statement
# Fixed "Notice: Undefined property: stdClass::$editor in ...\libraries\joomla\html\html\grid.php on line 327": Checked out images in My Galleries now show username of the 'editor' who checked it out

2012-06-06 Mirjam - SVN 1079
! All available languages now have all language strings (new ones in English). Cleaned up list of unused and duplicate strings of before version 3. Intention is to add new language strings not only to en-GB file, but also to the other language files at the bottom of those files (although they will be in english then).

2012-06-05 Mirjam - SVN 1078
^ Two new options in RSGallery2's Configuration: Show only items owned by the logged in user in My Galleries (default no) and Show only galleries owned by the logged in user in My Galleries (default no)
# Frontend My Galleries now checks number of images allowed per user correctly upon upload

2012-06-04 Mirjam - SVN 1077
+ Added options where user can choose to show a link to the slideshow from the gallery view (table and float) and the display image view. There are now three options for three different locations.
# In frontpage galleries view there is a dropdown box (depending on settings, e.g. set "Display gallery limitbox" to "Always") with option COM_RSGALLERY2_ALL which did not show any galleries. Not only is this fixed, this is now also done with Joomla default pagination.
# Added params section in Slideshow One's templateDetails.xml to remove "Notice: Undefined property: JSimpleXMLElement::$params"

2012-06-03 Mirjam - SVN 1076
^ Bumped version number to 3.1.1 (for sql updates)
^ Increased the length of fields `name` and `title` for the items to 255 characters and changed these numbers for fresh installations as well.
+ Added the option to include the items in any child galleries when displaying the number of items in a gallery (Configuration > tab: Display > Slider: Front Page (default: yes).

2012-06-03 Mirjam - SVN 1075
^ The language string COM_RSGALLERY2_IMAGES was used for both "Images" and "images": a new string is introduced, COM_RSGALLERY2_CONTROL_PANEL_TAB_IMAGES to be able to have the difference (thanks to user Ripley). For all available languages the extra string was added with the same translation as COM_RSGALLERY2_IMAGES.
+ Automatically add index.html to directories that RSGallery2 uses for its images (when you open the RSG2 Control Panel/use the watermark functions for the first time)

2012-05-28 Mirjam - SVN 1074
^ New finnish language file thanks to user Ripley

2012-05-14 Mirjam - SVN 1073
# "Class 'JFormFieldList' not found" when translating RSG2 menu item with JoomFish 2.5 alpha

2012-04-25 Mirjam - SVN 1072
# Fixed apply/save in Configuration Raw Edit screen
+ added the authorisation.class.php missing from the last commit

2012-04-25 Mirjam - SVN 1071
+ Added *.own permssions in Frontend (!) My Galleries (e.g. permission to delete (etc.) items/galleries owned by the logged in user)
	Create Own: set at component and gallery level. This allows the user to upload images to galleries that he owns and create galleries in parent galleries that he owns.
	Delete Own: set at component, gallery and item level. This allows the user to delete images or galleries that he owns.
	Edit State Own: set at component, gallery and item level. This allows the user to edit the state (published or not) of images or galleries that he owns.

2012-02-29 Mirjam - SVN 1069
# Authorisation checks on frontend My Galleries (create gallery in top gallery, edit permission also checks edit.own combined with ownership)

2012-02-20 Mirjam - SVN 1067
# Fixed upload with graphics library Netpbm

2012-02-13 Mirjam - SVN 1063
+ Updated de-DE language file (based on SVN1061) and de-DE menu-items thanks to user Chfrey (updated credits)
# In case of an error in Step 1 of the FTP upload, the user will get redirected to the Batchupload screen and the error message is more user friendly.

2012-01-25 Mirjam - SVN 1062
# Fixed fatal error when deleting gallery with images
^ When item could not be deleted from database an error was thrown not specifying the problem. Now user is told which item is causing the problem, and deletion of rest is halted. (Error could be with asset-deletion handled by Joomla: re-saving the item fixed this problem; problem with asset deletion is that there is no good error message coming from Joomla).

---------------- 3.1.0 -- SVN 1061 -- 2012-01-24 -------------

2012-01-18 Mirjam - SVN 1059
# New gallery saves by default to first position, text describing this in Gallery New screen was wrong
# Fixed meta description and page title

2012-01-01 Mirjam - SVN 1057
^ Created sliders for Configuration’s tab Images
^ Removed unused settings “Resize portrait images by height using Display Picture Width”, “Create directories if they don't exist “, “Resize Option” and “User can only comment once” (all commented).
^ The Allowed filetypes are hardcoded (images: "jpg",'jpeg',"gif","png"), no longer showing them in input box. 
^ Moved setting FTP Path tot Image Upload section and corrected base path information. 
^ Hardcoded textstring “(ex. C:\ffmpeg\ffmpeg.exe)” now translatable.
^ Upon Save in Configuration now using Joomla messages instread of RSG2 printAdminMsg
# Corrected missing language strings showing in pagination when you have a paginated list of galleries in the front-end
- Removed directory preparedLanguages that held a number of language files that were automatically converted from RSGallery2 1.x to 2.x, they had to be changed since the way Joomla handled language strings changed. Reason: there were no volunteers to update those langages from Joomla 1.0.x & RSGallery2 1.x to Joomla 1.5.x & RSGallery2 2.x nor the conversion to Joomla 1.6/1.7/2.5 & RSGallery2 3.x.

2012-01-01 Mirjam - SVN 1056
! Changes to let RSG2 work on J!2.5 (backwards compatibility issues to be solved in extension):
^ Get $task and $option in admin.rsgallery2.php
^ Get jimport( 'joomla.access.rules' ); where new JRules object is declared
^ Submenu toolbar (contents of file: toolbar.rsgallery2.php) only executed from backend

2011-12-21 Mirjam - SVN 1055
^ Added text color to 'Caroussel backgroundcolor and color thumbs-text'

2011-12-21 Mirjam - SVN 1054
+ Updated it-IT language file (based on SVN1053) and it-IT menu-items thanks to user Scioz (updated credits)
+ Updated nl-NL language file (based on SVN1053)

2011-12-15 Mirjam - SVN 1053
+ Updated it-IT language file (based on v3.0.1) thanks to user Scioz

2011-12-01 Mirjam - SVN 1052
+ Added the possibility of using parameters in Slideshow Parth (template parameters are saved upon RSGallery2 upgrade)

2011-11-28 Mirjam - SVN 1051
^ Comment and vote permission is no longer set in the Control Panel > Configuration > tab: Images > Commenting/Voting enabled, but in the Permission settings: Options button for the component and Set Permission button per gallery when editing a gallery (added message upon upgrade about this)
+ Captcha option for commenting on images: now uses Securimage 3.0 by Drew Philips (www.phpcaptcha.org)
- Removed Captcha that used Security Images component in comment form

2011-11-08 Mirjam - SVN 1050
+ Added choice for menu-item that links directly to the slideshow.

2011-11-08 Mirjam - SVN 1049
+ Added View Access Level to galleries: 
	* Galleries in the frontend are only shown 1) if the gallery is published and the user has
		view access, or 2) if the user is the owner of the gallery (a red H icon will indicate
		unpublished galleries)
	* Items (e.g. images) in the frontend are only shown 1) if the gallery to which they belong to
		is published and the user has view access for the gallery, or 2) if the user is the owner
		of the gallery to which the item belongs and the item is published
	* In My Galleries only those items and galleries are shown for which the user has View
		Access. Exception: Super Administrators see all items and galleries
	* Note: View Access is not 'inherited': If you're not allowed to see gallery Fruit, then
		you won't see its subgallery Apples even when you have View Access to that gallery (if there
		is a menu-item linking directly to the subgallery Apples it will show, it's parent View
		Access does not matter).
	Note: anyone who knows where the images are stored on the server and knows what the image
	name is can access the image directly. 
	
^ Database changes: Added `access` field to `#__rsgallery2_galleries` and set to 1 (Public access) for all galleries; increase in the length of fields `name` and `title` for the items.

---------------- 3.0.1 -- SVN 1046 -- 2011-10-05 -------------

2011-08-04 Mirjam - SVN 1038/1039/1040
+ Frontend My Galleries: images list has selectboxes to (un)publish/delete multiple items (user needs Edit State/Delete permission for individual items)
+ Frontend My Galleries: now has pagination: choice of items per page and after a change the page the user was on is remembered.
# Added Itemid to some MyGalleries links (for Joomla SEF)
# Added JRoute to MyGalleries form action (on my Images, for pagination)

2011-08-03 Mirjam - SVN 1037
+ Added regenerate display images option (watermarked images are made from these display images at first view)

2011-08-02 Mirjam - SVN 1034
+ Added option to set default state for uploaded images to (un)published (for users with Edit State permission for the chosen gallery)
# Watermark display image was showing original image

2011-07-27 Mirjam - SVN 1033
+ Added persian language files (fa-IR)
+ Added zip upload in frontend MyGalleries
^ changed 'TYPE=MyISAM' to 'ENGINE=MyISAM' since TYPE is removed in MySQL 5.5

---------------- 3 RC1 -- SVN 1026 -- 2011-05-08 -------------

2011-05-08 Mirjam - SVN 1026
# Redirect link voting includes Itemid
# Redirect link (delete) comments includes Itemid
# Delete comments from frontend available for users with core.admin

2011-04-27 Mirjam - SVN 1023
+ Added 2nd Help button for RSG2 ACL information on Control Panel page, only visible to those with core.admin (=configure permission).
# Use JHtml::_('select.option'... instead of JHTMLSelect::option since "The JHTML widgets are lazily included depending on usage" (http://forum.joomla.org/viewtopic.php?p=1158553#p1158553)
# Fixed several "Use of undefined constant"-notices.
# In select list current parent may not be disabled in selectlist.
^ Used 'total' number of items for pagination in My galleries is no longer dependent on owned items, but return all items.
# Number of item shown is now number of published items, not total number of items.

2011-04-20 Mirjam - SVN 1022
# Fixed "Notice: Use of undefined constant" in galleries.html.php
^ Rearranged some of the Control Panel tabs contents.
# Fixed backend Control Panel tabs problem with Internet Explorer.
^ Commented out (non functional) edit/delete buttons for logged in frontend users within gallery (template semantic/html/thumbs_float.php and thumbs_table.php within div id="rsg2-adminButtons").

2011-04-19 Mirjam - SVN 1021
- Removed deprecated rsgAccess functions (class extending JObject) in v3.
+ Added 'Unpublished' text to items that are unpublished, they are only shown in the frontend to users with core.admin.

2011-04-18 Mirjam - SVN 1020
- Removed slideshow phatfusion since it uses Mootools 1.11 and J!1.6 uses a later version of Mootools
+ Backend: implemented basic ACL core.edit/edit.own/edit.state/delete (e.g. checks on core.edit for component to show edit button, checks also with filtered galleries).
# Corrected path to galleries.item.xml file for gallery parameters.
^ Backend: Move/copy button for images: set correct parent asset.
+ Added language .sys.ini files for all available language (all en-GB values except nl-NL)

2011-04-12 Mirjam - SVN 1019
^ Backend item owner no longer changes upon save. User with core.admin may change owner for item and gallery.
+ Backend: implemented ACL core.admin & core.manage
^ Frontend My galleries shows all levels of galleries up to a depth of 20.

2011-04-01 Mirjam - SVN 1018
+ Frontend My galleries uses token for forms and all functions check assets.
+ Used IE disabled option fix in My galleries form http://www.lattimore.id.au/2005/07/01/select-option-disabled-and-the-javascript-solution/


2011-03-28 Mirjam - SVN 1017
^ Moved .sys.ini files to admin/language/en-GB/en-GB.com_rsgallery2.sys.ini etc (to show translated XML string in installation).
^ Changed My galleries to work with rsgImagesItem and rsgGalleriesItem objects instead of maken UPDATE sql statements (these are extension classes for JTable for which the store() and delete() methods create/remove assets).

2011-03-23 Mirjam - SVN 1016
- Removed pre-J!1.6 ACL config variables uu_createCat (can user create categories) and acl_enabled (enable ACL)
^ Implemented ACL in My galleries (frontend user upload/edit/create/editstate)!!!

2011-03-21 Mirjam - SVN 1015
^ Frontend My galleries works (also with Joomla SEF): edit/delete/create image/gallery, but without ACL

2011-03-14 Mirjam - SVN 1014
+ Save button on edit image and edit gallery pages (addition to save & close)
+ J!1.6 ACL: rules can be set for the component, galleries and images

2011-02-01 Mirjam - SVN 1012
# Adjusted pathway so that item name is only added when item is shown
^ There are only J!1.0 migration classes plus two debug migration classes. The latter two 'work'. Show 'Migration Options' only in debug mode.
^ Updated Template Manager and template details
^ Updated slideshows, JonDesign's SmoothGallery v2.1beta is now used in slideshow_parth for its compatibility with Mootools 1.3
! PhatFusion slideshow does not work, it's only Mootools 1.11 compatible

2011-01-26 Mirjam
# Description now shows in Slideshow Parth
# Fixed batch (zip) upload

2011-01-19 Mirjam - SVN 1007
# Fixed javascript alerts/checks in backend: (batch)upload, galleryname, itemname with galleryselect.

2011-01-17 Mirjam - SVN 1006
# Control panel icon does not show after installation on installation info page.
# Frontend: download icon did not show.
# Advanced SEF for RSG2 uses aliases and removed ?limitstart=0 in URL (advancedSEF)
# Untranslatable items: "- Top Gallery -", "New ordering saved" when changing order items, date format Items
^ FTP example path has trailing slash, and tooltip has moved.
^ Zip upload is renamed to Batch upload at it also refers to FTP
^ Upload of item of unsupported type now redirects to Item Upload

2011-01-13 Mirjam - SVN 1005
^ Changed advanced router
+ Added alias to items and galleries to use in (advanced) router
+ Added/updated credits for languages, also withing language files

2010-12-28 Mirjam
# Pathway now shows image name correctly
+ Added some language strings 
^ Reverted: changed help screen that is no longer in /help/en-gb/ (changed in J!1.6 RC1) 
# Installation script (and XML) now uses RSGallery2 language files (.ini and .sys.ini)

2010-09-01 - 2010-12-21 Mirjam SVN 1001
All kinds of changes to get RSG2 ready and working in J!1.6 (pre-alpha status):
BACKEND
- Removed reference to XML library
- Removed require_once( JApplicationHelper::getPath('toolbar_default') );
- Removed Java Uploader menu item as it was not implemented
^ Changed references to index2.php to index.php
^ Replace global $mainframe; by $mainframe =& JFactory::getApplication();
^ Replace require_once( JPATH_ADMINISTRATOR . '/includes/pageNavigation.php' ); by  import('joomla.html.pagination'); to be able to use JPagination
^ Replace global $option; by JRequest::getCmd('option'); 
^ Changed query SELECT a.*, u.name AS editor, a.parent AS parent_id, a.name AS title" because in J1.6 parent property is parent_id and name property is title (or alias)
^ Non-breaking space: HTML name: &nbsp; replaced by HTML number: &#160;.
^ PCLZIP is no longer included in J!1.6. Use JArchive instead (Rewrite batch upload)
^ addCustomHeadTag is deprecated in J!1.5, use JDocument->addCustomTag (only when document type is HTML)
^ Changed code to show published/reorder icons correcty in J!1.6
^ Changed help screen that is no longer in /help/en-gb/ but in /help/ 
^ With some help of EasyCreator all language strings have been converted: no spaces in keys, keys start with COM_RSGALLERY2_, no punctuation marks in keys; values in double quotes. E.g. COM_RSGALLERY2_KEY=”Value”. Removed redundand keys, or when they have all translations, commented them. Comment sign is a semi-colon ;. Needs to be checked by translators.
+ added jimport( 'joomla.html.parameter' ); in init.rsgallery2.php for JParameter
+ Around pageLinks a div with class pagination is needed (or else you’ll just see a bulleted list)
+ For menutree the elements directory is removed and a models/fields/gallery.php is created for a dropdown list where the gallery can be chosen: this adds parameter gid to the URL, so one can choose e.g. the root, with gid 0, or any other gallery. This also involved changes in the views/gallery/tmpl/default.xml.
+ Added submenu: the submenu no longer appears automatically from the xml file admin submenu items: need  JSubMenuHelper::addEntry
^ Changed reference to #__components table, that no longer exists in J!1.6, to #__extensions table 
+ Started with Backend ACL in JPATH_COMPONENT.'/helpers/ rsgallery2.php'; NOTE J!1.6 ACL is NOT implemented yet!

FRONTEND
- Removed require_once( JPATH_ROOT . '/includes/HTML_toolbar.php' );
- Removed (legacy) mosToolBar
^ Added JToolBar styling to mygalleries.css
^ Minor adjustments to CSS
^ Changed JHTML::_("date", $kid->date,"d-m-Y" ) to JHTML::_("date", $kid->date,JText::_('DATE_FORMAT_LC3')
^ Pathway now working (global $option; replaced by $option = JRequest::getCmd('option');) and adjusted for the fact that subgalleries now also may be menu items.
^ With some help of EasyCreator all language strings have been converted: no spaces in keys, keys start with COM_RSGALLERY2_, no punctuation marks in keys; values in double quotes. E.g. COM_RSGALLERY2_KEY=”Value”. Removed redundand keys, or when they have all translations, commented them. Comment sign is a semi-colon ;. Needs to be checked by translators.

2010-10-20 Mirjam
! Domain rsgallery2.net was lost to the RSGallery2 Team in september 2010.
  SVN and File Releases are still on http://joomlacode.org/gf/project/rsgallery2
  where packages now show j10 for Joomla!1.0 and j15 for Joomla!1.5.
^ New domain rsgallery2.nl will be used from now on, changed in the code.

2010-10-20 Mirjam
# Order/reorder in Backend Galleries now works correctly and reorder images show only when they can be used
^ Manifest rsgallery2.xml now used method="upgrade" so uninstalling RSG2 and revisiting its menu-items after installation is no longer neccessary. It writes over all existing files mentioned in the xml, so backing up of any file changes, e.g. to the existing template, is needed.

2010-08-22 Mirjam - SVN 989
^ Updated german and french language file (thanks to Günter Hoffman)

2010-05-20 Mirjam - SVN 986
+ Added setting useIPTCinformation (default off): choice of using image IPTC information for title and description when uploading images (single file/batch upload).

2010-04-09 Mirjam - SVN 985
# Changed all Help buttons to JToolBarHelper::help( 'screen.rsgallery2',true); and moved the screen.rsgallery2.html file to the correct folder /help/en-GB/ to be accessable: now all Help buttons are functional with updated information.

2010-03-30 Mirjam - SVN 983
+ Added menutree option to choose gallery tied to the menu item from list of galleries, including root gallery
# Changed router.php to correctly get gid when menuitem shows (sub)gallery and not rootgallery (otherwise resulting in hit() error)
+ Updated rsgallery2.xml to include views directory (thus now also installing Jonahs display-view from SVN955, but hidden through the metadata.xml settings)

2010-03-17 Mirjam - SVN 982
# Added if !defined('JPATH_RSGALLERY2_ADMIN'){} to avoid notice because when SEF is used this constant is defined in two places

2010-03-13 Mirjam - SVN 981
# Fix on resize of portrait images with DB: GD::resize portrait images now based on input $targetWidth, 
	not on display size (before svn 965) or thumb size (since 965). 
# Small fixes in function createImages() in maintenance.php.

---------------- 2.1.1 ------- svn 978 -- 2010-03-04 -------------

2010-03-02 Mirjam - SVN 976
^ Changed use of PEAR_Error to JError::raiseNotice and return false instead of new PEAR_Error (PEAR_Error is PHP4 not PHP5 and deprecated in Joomla 1.6)
# Backend display item moved inside 'case item->type' for image: was error for type mp3
+ Added JText language strings for error handling

2010-02-26 Mirjam - SVN 975
^ getSiteURL() and getPath() are deprecated in J1.5 (and removed from J1.6): changed to J1.5 native methods

2010-02-   Mirjam - SVN 974
# Fixed gallery and item names and descriptions in backend and frontend - last part
! Now special characters can by used in My Galleries 'new' and 'save'

2010-02-24 Mirjam - SVN 971
# Fixed gallery and item names and descriptions in backend and frontend, e.g. multiplying \ on save
! All names in database are not escaped, escaping is done just befor insert query
	or in store() of object
! Item and gallery descriptions are in JREQUEST_ALLOWRAW format

2010-02-18 Mirjam - SVN 968
# Ability to edit and delete galleries fixed in frontend My Galleries - use gid not catid
! gallery list to choose from is unaware of which user is logged on, function galleryUtils::galleriesSelectList is used for front- and backend

2010-02-16 Mirjam - SVN 967
# filenames with spaces were not allowed when regenerating proportional images with GD2
# portrait images were not resized according to thumb_width (it used image width) - fixed
! proportional resizing uses thumb_width for max width and height

2010-02-15 Mihir
# upgrade now possible without legacy turned on - changed getting db-prefix

2010-02-15 Mirjam
+ Added and changed language strings that were hardcoded instead of JText: en-GB and nl-NL

---------------- 2.1.0 beta -- svn 956 -- 2009-09-17 -------------

2008-12-14 John Caprez
+ added advanced SEF that uses category name and item title instead if its id (names and titles must ne unique!)

2008-12-12 John Caprez
+ video functionality 
  mov,flv and avi files can be uploaded. 
  To be able to convert video files a conversion application must be set up.
  The converter is not part of the RSGallery2 package.
  The predefined settings are for the ffmpeg converter (http://ffmpeg.mplayerhq.hu/)
  To display the videos the open source flv player is used (http://www.osflv.com/)
  

2008-11-24 John Caprez
^ using default meta page title instead of "RSGallery2"
# backend gallery ordering
# template manager deleting wrong templates
^ using SecurityImages 5.0 API
# fixed gallery pagination
+ SEF urls for gallery and item pagination (see site/router.php for details) 
- Lightbox popup
+ Mootools popup
! changes in the way the watermarked image url is retreived
+ many new translation

2008-07-15 Ronald Smit
+ Added slideshow phatfusion to distribution

2008-05-17 John Caprez
+ added router for SEF Url
+ lots of untranslated text
^ watermarked images are now stored and cached with different names to avoid collisions on high trafic sites
# fixed breadcrumb links
# fixed various voting/comenting bugs

2008-05-16 Jonah Braun
 # fixed path naming in template installer

2008-04-11 John Caprez 
 + added template manager to the new template installer
 # fixed voting lockup and configuration
 # fixed HTML matadata and pathway 
 - removed image/pagebreak/read-more buttons from WYSIWYG editor
 + added WYSIWYG editor for image upload
 ^ using J1.5 translation framework
 ! the old language files have been converted by a script.


2008-03-17 Jonah Braun
 + Clean port of J1.5.1 com_installer to be the new template installer. 
 * Allow public users to comment switch now works. 
 + Added cleanStart option to slideshowone
 # fixed display_thumbs_maxPerPage when set to 0 to show all thumbs
 + Made saving config way better.  This should improve installation time as well.

2008-02-22 Jonah Braun
 # fixing delete comment bug

2008-02-01 Jonah Braun
 # description at top of gallery is now gallery description and not always component text

---------------- 1.14.1 alpha -- svn 584 -- 2008-01-18 -------------

2008-01-14 Ronald Smit
 + Cleaned up maintenance section
 + Added language strings for maintenance section in english.php

2008-01-03 John Caprez
 + added WYSIWYG editor in MyGallery
 # fixed permissions for gallery creation in MyGallery

2007-12-26 John Caprez
 + added new template installer for J1.0 (template parameters are accessible through $this->params)
 # fixed some css issues
 + added voting permissions by gallery (see sql/upgrade_1.14.0_to_1.14.1.sql for neccesary database changes)

2007-12-20 Jonah Braun
 # Fixed uninstalling rsgTemplates in J1.5
 ^ Slideshow option only shows when more than one item is present.

2007-12-17 Ronald Smit
 + Added Zoom Gallery Migrator
 + Added description to lightbox++ popup
 + Added border and dropshadow to thumbs
 
2007-12-16 Ronald Smit
 + Added language strings
 + Added Lightbox++ popup to replace Highslide
 
2007-12-11 Ronald Smit
 + Started repairing Migration Option
 + Added Migration for Pony Gallery ML 2.4.1
 + Added Basic Search option for images
 ^ Cleaned up some code
 ! Only Pony Gallery Migration is working! Rest will follow

2007-12-07 Ronald Smit
 + Cleaned up admin.rsgallery2.php
 ^ Changed Control Panel to actually use the config class.
 + Removed batchupload from admin.rsgalelry2.php and moved to images.php
 ! I tagged a lot of functions to delete. After review they will be cleaned up.
 
2007-12-05 John Caprez
 # fixed bug in commenting
 ^ italian language file

2007-12-03 John Caprez
 # consistent pagination troughout all frontend 

2007-12-01 John Caprez
 # special char issue solved
 # improved PHP4 compatability

2007-11-26 Ronald Smit
 + Added new slideshow option, called slideshow_parth
 + Added switch in backend to select the slideshow option.
 ^ Cleaned out some obsolete backend stuff

2007-11-23 Ronald Smit
 + Added Maintenance section to the backend
 + Added Optimize tables, Regenerate thumbs and Consolidate database.
 ! Consolidate Database is not complete yet.
 ! Language strings not added yet.

2007-11-23 John Caprez
 # Gallery and item page navigation running parallely are handled propperly now
 
2007-11-20 John Caprez
 + New template manager for J1.5 (J1.0 will have same template manager as before)
 ^ Updated most links to have & replaced by &amp;
 + Added option to order thumbnails by date/name/rating/hits/default ascending or descending
 # unpublished items do not appear in random, latest and gallery thumb anymore
  
2007-11-18 Ronald Smit
 + Added EXIF configurable support to front- and backend, without need to have EXIF compiled into PHP

2007-11-15 Ronald Smit
 - Cleaned out display.class.php of both meta and semantic.
 ! Ready to remove tempDisplay from metatemplate. Last testing.

2007-11-15 Ronald Smit
 ^ Step one of the complete rewrite of My Galleries.
 ^ Moved all My Galleries related code into new library, called mygalleries
 ! Not finished yet. Marked all obsolete functions with X, deleting will follow after testing.

2007-11-15 John Caprez
 # Corrected SQL query to match data type when adding or editing gallery in front end.

2007-11-14 John Caprez
 # Recognition of file extension is now case insensitive. caused "wrong file format" error. 

---------------- 1.14.0 alpha -- svn 374 -- 2007-11-12 -------------

2007 Jonah Braun
 + Major updates to core functionality
 ^ Items are generic and no longer assumed as images.  Basic support for MP3 added.
 + Many objects are now cached resulting in a significant performance boost
 + Templating is more robust and powerful
 - Removed template Tables.  Use Semantic instead.
 - Removed or deprecated much legacy funcitonality
 ^ Moved J1.5 backport code to the J15Backort project
 ! Thanks to the many other contributers from the community

2007-10-30 John Caprez
 ^ Made semantic template XHTML compliant.
 ^ Modified j15backport to allow script and style inclusion to head section (XHTML compliance)
 ! Style inclusion is buggy in J1.5RC3 wil be fixed in J1.5RC4
 + Added mootools files to j15backport include folder
 ^ Using mootools instead of overlib for tooltips
 - Various PHP warnings

2007-10-29 Daniel Tulp
 ^ change script.js to script.php for language constant usage
 + added language constants
 
2007-10-20 John Caprez
 ^ process all url in semantic template with sefRelToAbs
 
2007-10-20 John Caprez
 # Fixed double sefRelToAbs on gallery name url

2007-10-19 John Caprez
 - removed border attribute from images for XHTML compliance
 # fixed access check for registered users
 
2007-09-22 Ronald Smit
 + Completed voting system
 + Added backend settings for voting
 + Added language strings for commenting and voting to front- and backend
 
2007-09-19 Ronald Smit
 + Added voting class to SVN
 
2007-07-05 Ronald Smit
 + Added fille joomla15.php and included this in init.rsgallery2.php
 - Removed all J15 mimicing out of init.rsgallery2.php
 
2007-06-23 Jonathan DeLaigle
 - Removed pattemplate usage from admin config

2007-06-17 Ronald Smit
 + Added delete option to frontend commenting system
 
2007-06-11 Ronald Smit
 + Added fullblown commenting system, based on BBCode.
 ! Requires database changes from file upgrade_1.12.2_to_1.13.2.sql
 
2007-06-06 Jonah Braun
 + added template photoBox
 # fixed meta tags.  rsgDisplay->metadata(); must be called from the templates index.php.
 - removed JPATH_RSGALLERY2_TEMPLATE, multiple templates can now be used on the same page.

---------------- 1.13.1 alpha -- svn 41 -- 2007-05-24 -------------

2007-05-24 Daniel Tulp
 ^ Added language definitions to english.php
 ^ Replaced hardcoded strings with language definitions
 
2007-05-23 Jonah Braun
 # Fixed undefined imageUploadError by moving the class to file.utils.php.
 ^ Added note to watermarking advising it is not to be used on production sites.

2007-05-21 Jonah Braun
 # Altered microMacro template to use image titles instead of filenames.

2007-05-20 Ronald Smit
 + Added move images function to backend image manager

---------------- 1.13.0 alpha -- svn 25 -- 2007-05-18 -------------

2007-05-04 Jonah Braun
 + added template Super Clean

2007-04-27 Ronald Smit
 # Fixed frontend ZIP-upload routine.

2007-04-02 Jonah Braun
 ^ templating system modified, approaching finished state
 + added templates: Tables, Simple Flash, debug_ListEverything
 
2007-03-24 Jonah Braun
 ^ moved config functions to new rsgOption config
 + added access check to certain functions
 ! only admin and super admin can access config, migration, uninstall and db debug features

2007-03-24 Daniel Tulp
 + Added new language definitions to english.php
 ^ Replaced hardcoded text strings in code with new language definitions

2007-03-24 Ronald Smit
 + Added allowed filetypes to config area
 - Removed some obsolete code
 
2007-03-23 Jonah Braun
 ^ db optimize: changed count(*) to count(1)
 + modified utils architecture for multiple file type handling

2007-03-22 Ronald Smit
 # Fixed presentation error not filling out gallery block in single view.
 
2007-03-20 Jonah Braun
 + gallery xml output and templating system
 + Todd Dominey's free flash slideshow

2007-03-17 Ronald Smit
 + Added Reset hits option in backend
 
2007-03-11 Ronald Smit
 ^ Rewritten FTP upload routine
 ^ Rewritten parts of template system to ease use of galleryblocl templating
 # Added core of customized galleryblock layout to templating system
 
2007-03-08 Ronald Smit
 # Fixed HTML tags in frontend thumbs and display image
 
2007-03-02 Ronald Smit
 # Fixed pathway support
 + Added download link
 # Fixed switch for status icons
 # Fixed clickable thumbnails in main gallery page
 
2007-03-01 Ronald Smit
 + Added better upload size checking.
 
2007-02-27 Ronald Smit
 + Added gallery details in frontend
 + Added owner name of gallery to frontend representation
 
2007-02-26 Ronald Smit
 + Added option to change owner of gallery in backend
 
2007-02-24 Ronald Smit
 # Fixed missing pagination in frontend
 ^ Moved footer out of template
  
2007-02-23 Ronald Smit
 + Added box option in template $tpl->showMainGalleries('box').
 + Added readable error statements when uploading files.
 
2007-02-21 Ronald Smit
 ^ Rewritten batch upload system. Should be more stable now.
 ! Error trapping is not complete yet!
 # Fixed show random/latest not switchable from backend
 # Fixed missing slideshow link.
 
2007-02-20 Ronald Smit
 # Fixed bug in template system when tabs are not activated.
 
2007-02-19 Ronald Smit
 + Added template file for display image
 
2007-02-18 Daniel Tulp
 + Added html editing functions dor templating system
 ^ Altered CSS editing functions to work with templating system
 - removed CSS edit button on cpanel

2007-02-18 Ronald Smit
 + Added transparency to Watermark text, including backend settings.
 
2007-02-17 Ronald Smit
 + Added templating system for frontend.

---------------- 1.12.2 alpha -- svn 587 -- 2007-02-13 -------------

2007-02-14 Ronald Smit
 # Removed shadow borders around thumbs due to issues in some browsers.

2007-02-12 Jonah Braun
 ^ fixed 1.11.0 to 1.11.1 upgrade bug
 ^ fixed slideshow bug, thanks Alex Boone
 ^ fixed gallery thumbnail list in Gallery: New/Edit when no images are present

2007-02-11 Ronald Smit
 + Added option to select watermarking font
 
2007-02-08 Ronald Smit
 + Fixed frontend problem in IE with new CSS borders.

2007-02-07 Ronald Smit
 + Added nice CSS border around thumbs and display image

2007-02-01 Jonah Braun
 # added fix for possible hardcoded table prefix for #__rsgallery2_acl
 ^ rewrote upgrade version detection because of existing logic flaw

2007-01-30 Jonah Braun
 - removed method calls in complex syntax to support older php versions

2007-01-29 Ronald Smit
 ^ Reformatted the Configuration tabs, using fieldsets to organize for cleaner look

2007-01-28 Daniel Tulp
 ^ Limitbox default value can now be set by administrator and limitbox can be turned off/if/on

2007-01-27 Ronald Smit
 # Fixed bug where uploading images with "Keep Original Images" set to No, goes wrong.

2007-01-26 Jonah Braun
 ^ Finished rsgConfig.  Ready for general use now.

2007-01-25 Jonah Braun
 # Fixed init.rsgallery2.php so that it can be used inside modules.

2007-01-21 Ronald Smit
 # Fixed faulty version detection upon install with multiple Joomla installation in one DB, causing upgrade on a non-existing installation.
 
2007-01-21 Daniel Tulp
 + Added missing language constants to english.php
 ^ Converted hardcoded text strings to new language constants
 # Removed not needed inclusion of the configuration.php file in rsgallery2.html.php
 
2007-01-20 Ronald Smit
 + Added filecount in frontend including subdirectories
 + Added showing thumbs from subgalleries also in random setting.
 
2007-01-14 Ronald Smit
 + Added possibility to select gallery thumbnail from top or subgalleries
 
2007-01-08 Ronald Smit
 + Added status feature for galleries. It shows a number of status icons.
 + Added backend switch for status icons
 + Added tooltips to the status icons
 
2007-01-07 Ronald Smit
 + Added "Create Database Entry" option within the Consolidate Database functionality.(Limited for now, one image at a time)
 # Fixed frontend upload bug.
 
2007-01-06 Ronald Smit
 # Fixed consolidate database bug, not creating missing images.
 # Fixed error in call to deleteImage in img.utils.php
 + Added watermarking to popup image.
 
2007-01-05 Ronald Smit
 # Fixed error when using FTP upload
 # Fixed not working Save button in frontend gallery creation.
 
---------------- 1.12.1 alpha -- svn 530-- 2007-01-04 ----------------

2007-01-04 Jonah Braun
 # fixed 1.12.0 to 1.12.0 upgrade bug
 ^ changed upgrade detect and migrate routines
 # fixed minor error in upgrade_1.11.10_to_1.11.11.sql
 # fixed pat-Error when viewing configuration

2007-01-04 Ronald Smit
 + Added error checking to FTP upload.
 + Added some global variables for the imagepaths in init.rsgallery2.php.

2007-01-03 Jonah Braun
 # fixed paging bug for old version of php

2007-01-03 Ronald Smit
 # Fixed upload bug with open_basedir restrictions.
 # Fixed bug in backend upload sequence where empty file fields generate errors.

---------------- 1.12.0 alpha -- svn 520-- 2007-01-03 ----------------

2007-01-02 Jonah Braun
 # fixed unpublished gallery showing bug
 + added missing pagenav for frontend gallery listing

2007-01-02 Ronald Smit
 + Added advanced ordering for View Images screen and View Galleries screen
 + Added more information in the mouseover within View Galleries (Title and description)
 # Fixed wrong reference to upgrade SQL in install class file.
 
2006-12-29 Ronald Smit
 # Fixed frontend delete gallery bug.
 # Finished ACL into the frontend gallery creation process.
 
2006-12-22 Ronald Smit
 + Implemented images class
 + Rewritten single file uploads
 
2006-12-20 Ronald Smit
 + Added new images class and upgrade script for DB changes

2006-12-18 Jonah Braun
 + added option to show image names under thumbnails
 + added gallery description to gallery view
 # fixed false db record entry on new image import fail

2006-12-16 Ronald Smit
 # Fixed bug not being able to delete image from the frontend.
 # Normalized tables a bit more.
 
2006-12-15 Ronald Smit
 # Fixed bug overwriting user ID when editing gallery details in backend
 
---------------- 1.11.11 alpha -- svn 489-- 2006-12-12 ----------------
2006-12-12 Jonah Braun
 + cleaned up initialization, created init.rsgallery2.php

2006-12-6 Ronald Smit
 + Added upgrade SQL for ACL support
 + Added upgrade option in install.class.php
 # Fixed some small bugs in Titleblock in frontend
 # Fixed array_combine() error for PHP 4.x
 
2006-12-5 Ronald Smit
 + Added ACL support for uploading, editing and deleting images from frontend
 + Added new icons for frontend filelist
 
2006-12-4 Ronald Smit
 + ACL enabled gallery select dropdown box for image upload in frontend.
 
2006-12-3 Ronald Smit
 # Fixed last JPATH_ issues
 # Fixed sefRelToAbs error in backend. As the class is used in both front- and backend, removed it from the class and introduced it into the frontend where needed.

2006-11-21 Ronald Smit
 + Defined RSGallery2 globals out of Joomla 1.5 globals (
 + JPATH_RSGALLERY2_SITE(frontend absolute path to component directory) and JPATH_RSGALLERY2_ADMIN(Backend absolute path to component directory)

2006-11-16 Ronald Smit
 # Fixed error using rsgAccess on accessing main gallery page
 # Fixed strange characters while unzipping a file in /media
 + Added switch options for My Galleries and Create Galleries in backend
 
2006-11-13 Jonah Braun
 # fixed big for multiple gallery delete

2006-11-13 Jonah Braun
 + recursive gallery deletion now works properlly; deletes all sub galleries and images
 # minor fix to ACL class

2006-11-12 Ronald Smit
 + Added some extra functionality to the ACL class.
 # Fixed some backend upload problems.
 + Added ACL switch to backend control panel and removed some unused user switches.
 
2006-11-10 Ronald Smit
 # Fixed bug in frontend layout, because of div problems
 # Fixed bug with display image not beeing generated on upload
 ^ Changed code for warningbox, making it easier and smaller.
 
2006-11-08 Ronald Smit
 + Option in backend to select No popup, normal popup or fancy popup. Defaults to normal to avoid errors in IE6
 + Added corresponding language variables to english.php
 # Fixed reordering bug as mentioned by Borislav
 
2006-11-06 Daniel Tulp
 ^ Simplyfied chinese, Greek language, French, Russian, Italian, Dutch, German, Polish language files have been updated through the course of weeks
 ^ Hopefully last hardcoded language strings have been removed 

2006-11-06 Ronald Smit
 ^ Started introdcuing Joomla 1.5 globals in backend to prepare for migration already
 ^ Cleaned up some unused code in backend.
 
2006-11-04 Ronald Smit
 + Added deletion of images not in the database in the Consolidate Database function.
 + Added checkboxes to Consolidate Database function (Not working yet!)
  
2006-11-09 Jonah Braun
 ^ Updated Czech language.  Thanks David Zirhut
 # partially cleaned up toolbars.

2006-10-31 Ronald Smit
 # Fixed upload error in backend, stating "invalid argument supplied in foreach()"
 + Added extra replace check for <BR> into <br /> for HTML gallery description.
 
2006-10-30 Ronald Smit
 + Added HTML support for the gallery description.
 
2006-10-29 Ronald Smit
 + Save and update routine for Access Control implemented
 + SQL statement for #__rsgallery2_acl added to rsgallery2.sql (commented out for now)
 
2006-10-28 Ronald Smit
 + Added permissions HTML to New/Edit Gallery Screen
 + Added some functions to access.class.php

---------------- 1.11.10 alpha -- svn 393-- 2006-10-26 ----------------
2006-10-26 Daniel Tulp
 ^+ Total language translation complete
 # Added a lot of Itemid's to links

2006-10-24 Jonah Braun
 + added classes rsgGalleryManager, rsgGallery and rsgAccess for improved galleries handling.  not yet complete.
 + added frontend function listEverything to test aformentioned features

2006-10-20 Daniel Tulp
 ^ Traditional Chinese language update by Sun Yu (Meto Sun)

2006-10-18 Daniel Tulp
 + added italian language file
 ^ changed francais.php to french.php and file is now completely translated
 + added Edit CSS feature
 
2006-10-15 Daniel Tulp
 + Greek language file added (by Charis)
 ^ Brazilian Portuguese language file updated

2006-10-15 Ronald Smit
 # Fixed frontend notice "Undefined property: showdownload" in frontend
 # Moved download button to bottom of display images, to prevent layout problems
 ^ Replaced download class with leaner script. Now works in all browsers.
 
2006-10-14 Ronald Smit
 # Fixed backend control panel toolbar buttons in upload and batchupload
 
---------------- 1.11.8 alpha -- svn 366-- 2006-10-14 ----------------
2006-10-11 Ronald Smit
 + Added download link to display image. User can set show/hide in Configuration Area
 ! Download option does not show correct filename in Opera.

2006-10-05 Daniel Tulp
 ^ Changed all links in frontend to SEF urls
 ^ Help content is now available (basic RSgallery2 use)

2006-10-05 Ronald Smit
 + Added download class to config.rsgallery2.php to facilicate downloads
 
2006-10-05 Jonah Braun
 ^ updated Polish and Norwegian.  Thanks: Zbyszek Rosiek and Ronny Tjelle

2006-10-04 Ronald Smit
 + Added page navigation to main gallery page.
 + Added Highslide image popup for display image 

2006-10-03 Jonah Braun
 + added Really Uninstall option.  only for *nix and default image directories at this point.

2006-10-02 Jonah Braun
 # fixed installer compatibility bug for MySQL 3.x and 4.0.x
 # fixed multiple sql file upgrading bug

2006-10-01 Ronald Smit
 # Fixed upload issues from backend and added field validation and MosToolbar support
 # Fixed My galleries link showing up when it was disabled in background. Thanks to Daniel!
 # Fixed the use of single and double quotes in Introduction text of RSGallery2.

2006-09-28 Daniel Tulp
 + added traditional Chinese language. thanks Sun
 ^ changed dutch translation credits

---------------- 1.11.8 alpha -- svn 331-- 2006-09-22 ----------------
2006-09-21 Ronald Smit
 # Fixed image description bug, thanks to "Thundernail".
 + Added upgrade routine for extra field in #__rsgallery2_galleries
 
2006-09-19 Ronald Smit
 # Fixed upload bug, refering to nonexistent isAllowedFileType function
 
2006-09-15 Ronald Smit
 + Added support for selectable thumb image for front end gallery view. Only possible in backend for now.
 + Added version.rsgallery2.php with version information class for better version checking and upgrading
 # Fixed Overlib error in backend
 
2006-09-13 Ronald Smit
 # Fixed single file upload bug in backend
 + Updated rsgallery2.xml to reflect addition of norwegian.php

2006-09-12 Jonah Braun
 + added Norwegian translation.  thanks: Steinar Vikholt

---------------- 1.11.7 alpha -- svn 317 -- 2006-09-12 ----------------

2006-09-11 Ronald Smit
 ^ Completely rewritten rsgallery2.php and rsgallery2.html.php
 + Created class galleryUtils in config.rsgallery2.php and moved all relevant functions in there
 ^ Cleaned up config.rsgallery2.php
 + Added page navigation to imagelist in My Galleries
 
2006-09-02 Ronald Smit
 + Added fileHandler class to clean up zip-handling and ftp-handling
 ! Upload system does not work through class yet, except ZIP-upload in backend.
 
2006-08-31 Ronald Smit
 * Fixed variable initialization to support Register Global Emulation to be set to Off
 
2006-08-29 Ronald Smit
 + Added the option to create square thumbnails in stead of proportional thumbs

2006-08-27 Ronald Smit
 # Fixed user uploads settings. My Galleries shows up now according to settings in background.

2006-08-26 Ronald Smit
 + Added Consolidate Database routine. Report generation, generate missing images and delete from database all work now
 # Watermarking works with gif now
 
2006-08-20 Ronald Smit
 # Fixed "font not found" error while using watermarking
 + Added font directory and arial.ttf file
 
2006-08-08 Jonah Braun
 * disabled commenting if commenting turned off

---------------- 1.11.6 alpha -- svn 299 -- 2006-07-21 ------------------

2006-07-21 Jonah Braun
 # fixed gallery add/edit toolbar bug

---------------- 1.11.5 alpha -- svn 298 -- 2006-07-20 ------------------

2006-07-20 Jonah Braun
 + added view changelog feature for frontend (must be in debug mode)
 ^ eliminated RSG2 path, Joomla path used now.  thanks: Jeckel
 # fixed gallery thumbnail + Joomfish bug.  thanks: Carsten Nikiel

2006-07-20 Jonah Braun
 + backend pathway hack when using $rsgOption
 # fixed category name display in pathway.  thanks: Brad Waite
 # fixed category name display in category listing.  thanks: TonyW

2006-07-09 Ronald Smit
 + Basic Watermarking added, only jpg for now and only on the display image

2006-07-04 Jonah Braun
 ^ updated spanish translation
 ^ updated french translation

---------------- 1.11.4 alpha -- svn 285 -- 2006-06-29 ------------------

2006-06-29 Jonah Braun
 * hardened language files
 + added Spanish translation

---------------- 1.11.3 alpha -- svn 280 -- 2006-06-29 ------------------

2006-06-29 Dani� Tulp
 * secured rsgallery2.html.php against possible execution of arbitrary code.

2006-06-16 Jonah Braun
 ^ default name for image is now filename minus extension

---------------- 1.11.2 alpha -- svn 0272 -- 2006-06-13 ------------------

2006-06-13 Jonah Braun
 # fixed gallery filter and move options in Manage Images
 # replaced config.rsgallery2.php:showCategories2() with galleriesSelectList().  this fixes various bugs when selecting a gallery

---------------- 1.11.1 alpha -- svn 0269 -- 2006-06-08 ------------------

2006-06-08 Jonah Braun
 # fixed bug where 1.11.0 created #__rsgallery2_cats by mistake on new installs

---------------- 1.11.0 alpha -- svn 0269 -- 2006-06-08 ------------------

2006-06-07 Jonah Braun
 + new galleries integrated.  sql migration script added.
 + added the new RSG2 logo.  Congrats to Cory "ccdog" Webb for winning the contest!

2006-06-02 Jonah Braun
 + CZECH language

2006-05-26 Jonah Braun
 + new galleries prototype now available.  this should not interfer with the old categories...yet.

2006-05-23 Jonah Braun
 # MacOSX zip files with resource fork information now work

---------------- 1.10.14 alpha -- svn 0244 -- 2006-05-12 ------------------

2006-05-12 Jonah Braun
 + install.class.php now can use sql files for install/imports.  admin:sql/rsgallery2.sql is the sql install file.

2006-05-10 Kaleb Stolee
 + akogallery migration now works.

---------------- 1.10.13 alpha -- svn 0234 -- 2006-05-04 ------------------

2006-05-04 Jonah Braun
 ^ streamlined install routine.  upgrades are now done without asking.

2006-04-28 Dani� Tulp
 + Itemid variable added, Itemid of component is now used throughout the gallery

2006-04-20 Jonah Braun
 ^ backend gallery listing now unlimited.  this is a kludge, overall still buggy

---------------- 1.10.11 alpha -- svn 0215 -- 2006-04-17 ------------------

2006-04-17 Themba Mdakane
 ^ made frontend branding optional

2006-04-17 Jonah Braun
 + added german and brazilian portuguese

---------------- 1.10.10 alpha -- svn 0211 -- 2006-04-15 ------------------

2006-04-15 Jonah Braun
 + added raw config editor
 + added class rsgGallery along with improved gallery editing, WYSIWYG support to come soon
 + new options for thumbnail display: float and table
 ^ made Purge Everything more thorough

2006-04-10 Jonah Braun
 + added new credits tab to the control panel

---------------- 1.10.9 alpha -- svn 0201 -- 2006-04-08 ------------------

2006-04-08 Jonah Braun
 # many small bug fixes
 # version number is accurate after upgrading
 ^ frontend gallery thumbnail display made better, not finished yet though...
 ^ backend config updated

---------------- 1.10.8 alpha -- svn 0195 -- 2006-04-04 ------------------

2006-04-04 Jonah Braun
 ^ changed control panel to be more consistant with Joomla!s.
 + added admin.rsgallery2.css
 + added View rsgConfig, this will become a raw configuration editor for debuging
 # version number now accurate after an upgrade

2006-04-01 Jonah Braun
 # added missing quotes to russian translation
 # fix for ftp upload from http://rsgallery2.net/component/option,com_simpleboard/func,view/id,487/catid,3/

---------------- 1.10.7 alpha -- svn 0185 -- 2006-03-24 ------------------

2006-03-23 Jonah Braun
 + thumbnail and other frontend bits rewritten in semantic html and css

2006-03-23 Jonah Braun
 + gallery listing rewritten in semantic html and css

---------------- 1.10.6 alpha -- svn 0174 -- 2006-03-04 ------------------

2006-03-03 Jonah Braun
 + Netpbm rewrite complete.  works for all supported image types.
 ^ fixed artf3775: category reording fails

---------------- 1.10.5 alpha -- svn 0171 -- 2006-03-04 ------------------

2006-03-02 Ronald Smit
 # ZIP-upload for frontend fixed
 # Category creation in frontend is fixed
 ^ Voting and commenting is now possible anonymously
 ^ Thumbnail in gallery main screen is now showing with right dimensions

2006-02-28 Jonah Braun
 ^ fixed artf3053: saving config says fails but actually saves
 + added view changelog feature

2006-02-24 Jonah Braun
 ^ streamlined installation, there is now one less step.
 + migration plugin arch is now functional

2006-02-23 Jonah Braun
 ^ instances of "settings" renamed "config[uration]"

---------------- 1.10.2 alpha -- svn 0146 -- 2006-02-15 ------------------

2006-02-15 Jonah Braun
 + GD2 and ImageMagick now support all common web image formats.

2006-02-12 Jonah Braun
 + added changelog.php, imported previous changelog.txt
 - removed changelog.txt

---------------- 1.10.1 alpha -- svn 0136 -- 2006-02-11 ------------------

2006-01 Ronald Smit
 + rewrote installation and migration routines
 ^ component, files and database tables renamed to rsgallery2

2006-01 Jonah Braun
 + rewrote all image utility functions.  currently only JPEG with the GD2 library supported

---------------- 1.9.5 alpha -- 2005-10-13 ------------------

2005-10 Jonah Braun
 ^ cleaned img.utils.php
 + rewrote imgUtils::makeThumb()

2005-10 Ronald Smit
 + Rewritten and completed FTP upload code
 + Rewritten saveConfig to match new values in settings.rsgallery.php
 + Added extra field to match $thumbpath in settings.rsgallery.php
 + Populated latest images and latest categories in Control Panel

---------------- 1.9.4 alhpa -- 2005-10-08 ------------------

2005-10 Jonah Braun
 ^ moved is_uploaded_file() check from importImage() to calling function

2005-10 Ronald Smit
 + ZIP upload rewrite complete
 + Added recent images and recent categories overview in Control Panel
 ^ Rewritten some toolbar layouts

2005-10 Tomislav Ribicic
 + added changelog.txt

---------------- 1.9.0-4 alphas -- 2005-09 ------------------

2005 Jonah Braun
 + major reorganization of code

----- RSGallery2 for Joomla! started by Tomislav Ribicic, Jonah Braun circa. 2005-08-17 -----

----- Maintaince and enhancements by Andy "Troozers" Stewart, Richard Foster -----

----- Original RSGallery for Mambo created by Ronald Smit circa. 2004-03-01 -----


2. Copyright and disclaimer
---------------------------
This application is opensource software released under the GPL.  Please
see source code and http://www.gnu.org/copyleft/gpl.html
