<?php
/**
* Initialize default instance of RSGallery2
* @version $Id: rsgallery2.php 1011 2011-01-26 15:36:02Z mirjam $
* @package RSGallery2
* @copyright (C) 2003 - 2006 RSGallery2
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* RSGallery is Free Software
*/
defined( '_JEXEC' ) or die( 'Access Denied.' );

// initialize RSG2 core functionality
require_once( JPATH_SITE. DS . "administrator" . DS . "components" . DS . "com_rsgallery2" . DS . "init.rsgallery2.php" );

// create a new instance of RSGallery2
rsgInstance::instance();
