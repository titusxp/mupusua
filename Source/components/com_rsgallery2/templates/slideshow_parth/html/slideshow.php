<?php
/**
 * @version $Id $
 * @package RSGallery2
 * @copyright (C) 2003 - 2011 RSGallery2
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
defined('_JEXEC') or die('Restricted access');

global $rsgConfig;
$doc =& JFactory::getDocument();
JHTML::_("behavior.mootools");

//Add stylesheets and scripts to header
$css1 = JURI::base().'components/com_rsgallery2/templates/slideshow_parth/css/jd.gallery.css';
$doc->addStyleSheet($css1);
$css2 = JURI::base().'components/com_rsgallery2/templates/slideshow_parth/css/template.css';
$doc->addStyleSheet($css2);
$js2 = JURI::base().'components/com_rsgallery2/templates/slideshow_parth/js/jd.gallery.js';
$doc->addScript($js2);
$js3 = JURI::base().'components/com_rsgallery2/templates/slideshow_parth/js/jd.gallery.transitions.js';
$doc->addScript($js3);
?>

<!-- Override default CSS styles -->
<style>
	/* Slideshow width and height */
	#myGallery, #myGallerySet, #flickrGallery {
		width: 		<?php echo ($this->params->get('slideshowWidth') ? $this->params->get('slideshowWidth') : $this->maxSlideshowWidth);?>px;
		height: 	<?php echo ($this->params->get('slideshowHeight') ? $this->params->get('slideshowHeight') : $this->maxSlideshowHeight);?>px;
	}
	/* Background color for the slideshow element */
	.jdGallery .slideElement {
		background-color: <?php echo $this->params->get('slideshowBackgroundcolor','#000000');?>;
	}
	/* Background color of links (Override personal.css) */
	#main a:hover, #main a:active, #main a:focus{
		background-color: transparent;
	}
	/* slideInfoZone text color */
	#main .slideInfoZone h2, #main .slideInfoZone p{ 
		color: 		<?php echo $this->params->get('slideInfoZoneTextcolor','#EEEEEE'); ?>;
	}
	/* Carousel backgroundcolor, color item title, height */
	.jdGallery .carousel { 
		background-color: <?php echo $this->params->get('carouselBackgroundcolor','#000000');?>;
		color:		<?php echo $this->params->get('carouselTextcolor','#FFFFFF'); ?>;
		height:		<?php echo $this->params->get('carouselHeight','135'); ?>px;
	}
	/* Carousel height for thumbs-text position (= .jdGallery .carousel {height} + 20px ) */
	.jdGallery div.carouselContainer {
		height:		<?php echo ($this->params->get('carouselHeight','135')+20); ?>px;				
	}
	/* Carousel backgroundcolor thumbs-text */
	.jdGallery a.carouselBtn {
		background: <?php echo $this->params->get('carouselBackgroundcolor','#333333'); ?>;
		color:		<?php echo $this->params->get('carouselTextcolor','#FFFFFF'); ?>;
	}
	/* Carousel color numberlabel */
	.jdGallery .carousel .label .number {
		color: 		<?php echo $this->params->get('carouselNumberlabelColor','#B5B5B5'); ?>;
	}
	/* slideInfoZone background color, height */
	.jdGallery .slideInfoZone, .jdGallery .slideInfoZone h2 {
		background-color: <?php echo $this->params->get('slideInfoZoneBackgroundcolor','#333333');?>;
		height:  	<?php echo $this->params->get('slideInfoZoneHeight','60'); ?>px;
	}
</style>

<script type="text/javascript">
	function startGallery() {
		var myGallery = new gallery($('myGallery'), {
			/* Automated slideshow */
			timed: <?php echo $this->params->get('automated_slideshow',1);?>,
			/* Show the thumbs carousel */
			showCarousel: <?php echo $this->params->get('showCarousel',1);?>,
			/* Text on carousel tab */
			textShowCarousel: '<?php echo (($this->params->get('textShowCarousel') == '') ? JText::_('COM_RSGALLERY2_SLIDESHOW_PARTH_THUMBS') : $this->params->get('textShowCarousel'));?>',
			/* Thumbnail height */
			thumbHeight: <?php echo $this->params->get('thumbHeight',50);?>,
			/* Thumbnail width*/
			thumbWidth: <?php echo $this->params->get('thumbWidth',50);?>,
			/* Fade duration in milliseconds (500 equals 0.5 seconds)*/
			fadeDuration: <?php echo $this->params->get('fadeDuration',500);?>,
			/* Delay in milliseconds (6000 equals 6 seconds)*/
			delay: <?php echo $this->params->get('delay',6000);?>,
			/* Disable the 'open image' link for the images */
			embedLinks: <?php echo $this->params->get('embedLinks',1);?>,
			defaultTransition: '<?php echo $this->params->get('defaultTransition','fade');?>',
			showInfopane: <?php echo $this->params->get('showInfopane',1);?>,
			slideInfoZoneSlide: <?php echo $this->params->get('slideInfoZoneSlide',1);?>,
			showArrows: <?php echo $this->params->get('showArrows',1);?>
		});
	}
	window.addEvent('domready',startGallery);
</script>

<div class="content">

<?php
	//Show link only when menu-item is a direct link to the slideshow
	if (JRequest::getCmd('view') !== 'slideshow') {
?>
		<div style="float: right;">
			<a href="index.php?option=com_rsgallery2&Itemid=<?php echo JRequest::getInt('Itemid');?>&gid=<?php echo $this->gid;?>">
				<?php echo JText::_('COM_RSGALLERY2_BACK_TO_GALLERY');?>
			</a>
		</div>
<?php
	}
?>
	<div class="rsg2-clr">
	</div>
	<div style="text-align:center;font-size:24px;">
		<?php echo $this->galleryname;?>
	</div>
	<div class="rsg2-clr">
	</div>
	<div id="myGallery">
		<?php echo $this->slides;?>
	</div><!-- end myGallery -->
</div><!-- End content -->