<?php
defined('_JEXEC') or die;
/* The following line gets the application object for things like displaying the site name */
$app = JFactory::getApplication();
if(!defined('DS')){
define( 'DS', DIRECTORY_SEPARATOR );
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<jdoc:include type="head" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/setts.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/style3.css" type="text/css" />
<?php $stil = $_GET['style'];
if (isset($stil) && $stil != "1") { ?>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/style<?php echo $stil; ?>.css" type="text/css" /> <?php } else { echo ""; } ?>

<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/script.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/slides.min.jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/suckerfish.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/css3.js"></script>	
<?php if($this->params->get('rtlTemplate',1)) : ?>	
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/template_rtl.css" type="text/css" />
<?php else: ?>
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/template_ltr.css" type="text/css" />
<?php endif;?>
<?php require("admin/params.php"); ?>

<?php

if ($slidesimage1 || $slidesimage2 || $slidesimage3 || $slidesimage4 || $slidesimage5 || $slidesimage6) {
// use images from template manager
} else {
// use default images
$slidesimage1 = $this->baseurl . '/templates/' . $this->template . '/header/header01.jpg';
$slidesimage2 = $this->baseurl . '/templates/' . $this->template . '/header/header02.jpg';
}

?>
<?php if (($this->countModules('header') && $slides == 2) || ($slides == 1)): ?>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery.flexslider.js"></script>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/flexslider.css" type="text/css" media="screen" />
<script type="text/javascript">
$(window).load(function() {
$('#index-slider').flexslider({
animation: "<?php echo $slideseffect; ?>",  
slideDirection: "",  
slideshow: true,              
slideshowSpeed: 4500,      
animationDuration: 500,
directionNav: true, 
controlNav: false  
});	
});
</script>
<?php endif; ?>	

</head>

<body>
<div id="container"><a name="bktop"></a>

<div class="container" id="headersite">
<div class="base">
<div id="header" class="twelvecol"><!--header starts here-->	
<div id="logo" class="threecol"><!--logo starts here-->				
<?php if (($showDefaultLogo) !=0) : ?>				
<a class="defaultLogo" href="<?php echo $this->baseurl; ?>/"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo/<?php echo htmlspecialchars($defaultLogo);?>" style="border:0;" alt="" /></a>
<?php endif;?>
<?php if (($showMediaLogo) !=0) : ?>				
<a class="mediaLogo" href="<?php echo $this->baseurl; ?>/"><img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($mediaLogo);?>" style="border:0;" alt="" /></a>
<?php endif;?>
<?php if (($showTextLogo) !=0) : ?>				
<a class="textLogo" href="<?php echo $this->baseurl; ?>/"><?php echo htmlspecialchars($textLogo);?></a>
<?php endif;?>
<?php if (($showSlogan) !=0) : ?>				
<div class="slogan"><?php echo htmlspecialchars($slogan);?></div>
<?php endif;?>
</div><!--logo ends here --> 

<?php if ($this->countModules('nav')) { ?><!--nav starts here-->
<div id="nav" class="ninecol last">
<jdoc:include type="modules" name="nav" style="xhtml" />
</div>
<?php } ?><!--nav ends here --> 
</div><!--header ends here --> 
</div>
</div>

<?php if (($this->countModules('header') && $slides == 2) || ($slides == 1)): ?>
<div class="container" id="showwrap">
<div class="base">
<div class="flexslider" id="index-slider">
<!-- You CAN NOT remove (or unreadable) this without mixwebtemplates.com permission. -->
<div id="mcpanel"> DESIGNED BY MIXWEBTEMPLATES </div>
<!-- You CAN NOT remove (or unreadable) this without mixwebtemplates.com permission. -->
<ul class="slides">
<?php if ($slidesimage1): ?>
<li>
<?php if ($slideslink1): ?><a href="<?php echo $slideslink1; ?>"><?php endif;?><img src="<?php echo $slidesimage1; ?>" alt="" /><?php if ($slideslink1): ?></a><?php endif;?>
<?php if ($slidescaption1): ?><p class="flex-caption"><?php echo $slidescaption1; ?></p><?php endif;?>
</li>
<?php endif;?>
<?php if ($slidesimage2): ?>
<li>
<?php if ($slideslink2): ?><a href="<?php echo $slideslink2; ?>"><?php endif;?><img src="<?php echo $slidesimage2; ?>" alt="" /><?php if ($slideslink2): ?></a><?php endif;?>
<?php if ($slidescaption2): ?><p class="flex-caption"><?php echo $slidescaption2; ?></p><?php endif;?>
</li>
<?php endif;?>
<?php if ($slidesimage3): ?>
<li>
<?php if ($slideslink3): ?><a href="<?php echo $slideslink3; ?>"><?php endif;?><img src="<?php echo $slidesimage3; ?>" alt="" /><?php if ($slideslink3): ?></a><?php endif;?>
<?php if ($slidescaption3): ?><p class="flex-caption"><?php echo $slidescaption3; ?></p><?php endif;?>
</li>
<?php endif;?>
<?php if ($slidesimage4): ?>
<li>
<?php if ($slideslink4): ?><a href="<?php echo $slideslink4; ?>"><?php endif;?><img src="<?php echo $slidesimage4; ?>" alt="" /><?php if ($slideslink4): ?></a><?php endif;?>
<?php if ($slidescaption4): ?><p class="flex-caption"><?php echo $slidescaption4; ?></p><?php endif;?>
</li>
<?php endif;?>
<?php if ($slidesimage5): ?>
<li>
<?php if ($slideslink5): ?><a href="<?php echo $slideslink5; ?>"><?php endif;?><img src="<?php echo $slidesimage5; ?>" alt="" /><?php if ($slideslink5): ?></a><?php endif;?>
<?php if ($slidescaption5): ?><p class="flex-caption"><?php echo $slidescaption5; ?>.</p><?php endif;?>
</li>
<?php endif;?>
<?php if ($slidesimage6): ?>
<li>
<?php if ($slideslink6): ?><a href="<?php echo $slideslink6; ?>"><?php endif;?><img src="<?php echo $slidesimage6; ?>" alt="" /><?php if ($slideslink6): ?></a><?php endif;?>
<?php if ($slidescaption6): ?><p class="flex-caption"><?php echo $slidescaption6; ?></p><?php endif;?>
</li>
<?php endif;?>
</ul><!--END UL SLIDES-->

</div><!--END FLEXSLIDER-->
	
</div>
</div>
<?php endif; ?>	

<div class="container">
<div class="base">
<?php if ($this->countModules('breadcrumbs')) { ?><!--breadcrumbs starts here-->
<div id="breadcrumbs" class="twelvecol">
<jdoc:include type="modules" name="breadcrumbs"  />
</div>
<?php } ?><!--breadcrumbs ends here --> 
</div>
</div>


<?php if($this->countModules('top1') || $this->countModules('top2') || $this->countModules('top3') || $this->countModules('top4')) : ?>
<div class="container" id="maintopwrap">
<div class="base">
<?php
if ($this->countModules('top1') && $this->countModules('top2') || $this->countModules('top1') && $this->countModules('top3') || $this->countModules('top1') && $this->countModules('top4') || $this->countModules('top2') && $this->countModules('top1') || $this->countModules('top2') && $this->countModules('top3') || $this->countModules('top2') && $this->countModules('top4') || $this->countModules('top3') && $this->countModules('top1') || $this->countModules('top3') && $this->countModules('top2') || $this->countModules('top3') && $this->countModules('top4') || $this->countModules('top4') && $this->countModules('top1') || $this->countModules('top4') && $this->countModules('top2') || $this->countModules('top4') && $this->countModules('top3') ) $top=1;				
if ($this->countModules('top1') && $this->countModules('top2') && $this->countModules('top3') || $this->countModules('top1') && $this->countModules('top2') && $this->countModules('top4') || $this->countModules('top1') && $this->countModules('top3') && $this->countModules('top4') || $this->countModules('top2') && $this->countModules('top3') && $this->countModules('top4')) $top=2;

if ($this->countModules('top1') && $this->countModules('top2') && $this->countModules('top3') && $this->countModules('top4')) $top=3;
?>

<?php if($this->countModules('top1') || $this->countModules('top2') || $this->countModules('top3') || $this->countModules('top4')) : ?>

<div class="twelvecol clearfix"><!--top starts here-->			
<?php if ($this->countModules('top1')): ?><!--top1 starts here-->
<div id="top1" class=" <?php if ( $top == 1 ):echo ('sixcol'); elseif ( $top == 2 ):echo ('fourcol'); elseif ( $top == 3 ):echo ('threecol'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="top1" style="xhtml" />
</div> <!--top1 ends here-->
<?php endif; ?>
<?php if ($this->countModules('top2')): ?><!--top2 starts here-->
<div id="top2" class=" <?php if ( $top == 1 && $this->countModules('top3') || $top == 1 && $this->countModules('top4') ):echo ('sixcol'); elseif ( $top == 1): echo ('sixcol last'); elseif ( $top == 2 ):echo ('fourcol'); elseif ( $top == 3 ):echo ('threecol');else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="top2" style="xhtml" />
</div> <!--top2 ends here-->
<?php endif; ?>
<?php if ($this->countModules('top3')): ?><!--top3 starts here-->
<div id="top3" class=" <?php if ( $top == 1 && $this->countModules('top4')):echo ('sixcol'); elseif ( $top == 1):echo ('sixcol last'); elseif ( $top == 2 && $this->countModules('top4')):echo ('fourcol'); elseif ($top == 2): echo ('fourcol last'); elseif ( $top == 3 ):echo ('threecol'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="top3" style="xhtml" />
</div> <!--top3 ends here-->
<?php endif; ?>
<?php if ($this->countModules('top4')): ?><!--top4 starts here-->
<div id="top4" class=" <?php if ( $top == 1 ):echo ('sixcol last'); elseif ( $top == 2 ):echo ('fourcol last'); elseif ( $top == 3 ):echo ('threecol last'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="top4" style="xhtml" />
</div> <!--top4 ends here-->
<?php endif; ?>
</div><!--top ends here-->
<?php endif; ?>
</div>
</div>
<?php endif; ?>

<?php if($this->countModules('user6') || $this->countModules('user7') || $this->countModules('user8')) : ?>
<div class="container" id="maintop">
<div class="base">
<?php
if ($this->countModules('user6') && $this->countModules('user7')) $maintop=1;
if ($this->countModules('user7') && $this->countModules('user8')) $maintop=2;
if ($this->countModules('user6') && $this->countModules('user8')) $maintop=3;
if ($this->countModules('user6') && $this->countModules('user7') && $this->countModules('user8')) $maintop=4;
?>

<?php if($this->countModules('user6') || $this->countModules('user7') || $this->countModules('user8')) : ?>

<div id="maintop" class="clearfix"><!--user6 starts here-->			
<?php if ($this->countModules('user6')): ?><!--user6 starts here-->
<div id="user6" class=" <?php if ( $maintop == 1 ):echo ('threecol'); elseif ( $maintop == 3 ):echo ('threecol'); elseif ( $maintop == 4 ):echo ('threecol'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="user6" style="xhtml" />
</div> <!--user6 ends here-->
<?php endif; ?>
<?php if ($this->countModules('user7')): ?><!--user7 starts here-->
<div id="user7" class=" <?php if ( $maintop == 1 ):echo ('ninecol last'); elseif ( $maintop == 2 ):echo ('ninecol'); elseif ( $maintop == 4 ):echo ('sixcol'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="user7" style="xhtml" />
</div> <!--user7 ends here-->
<?php endif; ?>
<?php if ($this->countModules('user8')): ?><!--user8 starts here-->
<div id="user8" class=" <?php if ( $maintop == 2 ):echo ('threecol last'); elseif ( $maintop == 3 ):echo ('ninecol last'); elseif ( $maintop == 4 ):echo ('threecol last'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="user8" style="xhtml" />
</div> <!--user8 ends here-->
<?php endif; ?>
</div><!--maintop ends here-->
<?php endif; ?>
</div>
</div>
<?php endif; ?>

<div class="container">
<div class="base">
<div id="message" class="twelvecol"><!--message starts here-->
<jdoc:include type="message" />
</div><!--message ends here-->
</div>
</div>

<div class="container" id="mainbgr">
<div class="base">			
<div id="main" class="clearfix"><!--main starts here-->	
<?php if ($this->countModules('left') && $this->countModules('right')): ?>
<div id="left" class=" threecol"><!--left starts here-->
<jdoc:include type="modules" name="left" style="xhtml" />
</div> <!--left ends here-->
<div id="maincontent" class="sixcol"><!--maincontent starts here-->
<jdoc:include type="modules" name="bookmarks" style="xhtml" />
<jdoc:include type="component" />
<jdoc:include type="modules" name="user5" style="xhtml" />  
</div><!--maincontent ends here-->
<div id="right" class=" threecol last"><!--right starts here-->
<jdoc:include type="modules" name="right" style="xhtml" />
</div> <!--right ends here-->
<?php elseif ( $this->countModules('left')) : ?>
<div id="left" class=" threecol"><!--left starts here-->
<jdoc:include type="modules" name="left" style="xhtml" />
</div> <!--left ends here-->	
<div id="maincontent" class="ninecol last"><!--maincontent starts here-->
<jdoc:include type="modules" name="bookmarks" style="xhtml" />
<jdoc:include type="component" />
<jdoc:include type="modules" name="user5" style="xhtml" /> 
</div><!--maincontent ends here-->
<?php elseif ( $this->countModules('right')): ?>
<div id="maincontent" class="ninecol"><!--maincontent starts here-->
<jdoc:include type="modules" name="bookmarks" style="xhtml" />
<jdoc:include type="component" />
<jdoc:include type="modules" name="user5" style="xhtml" /> 
</div><!--maincontent ends here-->
<div id="right" class=" threecol last"><!--right starts here-->
<jdoc:include type="modules" name="right" style="xhtml" />
</div> <!--right ends here-->			
<?php else : ?>
<div id="maincontent" class="twelvecol"><!--maincontent starts here-->
<jdoc:include type="modules" name="bookmarks" style="xhtml" />
<jdoc:include type="component" />
</div><!--maincontent ends here-->
<?php endif; ?>

</div><!--main ends here-->
</div>
</div>

<?php if($this->countModules('user9') || $this->countModules('user10') || $this->countModules('user11')) : ?>
<div class="container" id="mainbottomwrap">
<div class="base">
<?php
if ($this->countModules('user9') && $this->countModules('user10')) $mainbottom=1;
if ($this->countModules('user10') && $this->countModules('user11')) $mainbottom=2;
if ($this->countModules('user9') && $this->countModules('user11')) $mainbottom=3;
if ($this->countModules('user9') && $this->countModules('user10') && $this->countModules('user11')) $mainbottom=4;
?>

<?php if($this->countModules('user9') || $this->countModules('user10') || $this->countModules('user11')) : ?>

<div id="mainbottom" class="clearfix"><!--mainbottom starts here-->			
<?php if ($this->countModules('user9')): ?><!--user9 starts here-->
<div id="user9" class=" <?php if ( $mainbottom == 1 ):echo ('threecol'); elseif ( $mainbottom == 3 ):echo ('threecol'); elseif ( $mainbottom == 4 ):echo ('threecol'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="user9" style="xhtml" />
</div> <!--user9 ends here-->
<?php endif; ?>
<?php if ($this->countModules('user10')): ?><!--user10 starts here-->
<div id="user10" class=" <?php if ( $mainbottom == 1 ):echo ('ninecol last'); elseif ( $mainbottom == 2 ):echo ('ninecol'); elseif ( $mainbottom == 4 ):echo ('sixcol'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="user10" style="xhtml" />
</div> <!--user10 ends here-->
<?php endif; ?>
<?php if ($this->countModules('user11')): ?><!--user11 starts here-->
<div id="user11" class=" <?php if ( $mainbottom == 2 ):echo ('threecol last'); elseif ( $mainbottom == 3 ):echo ('ninecol last'); elseif ( $mainbottom == 4 ):echo ('threecol last'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="user11" style="xhtml" />
</div> <!--user11 ends here-->
<?php endif; ?>
</div><!--mainbottom ends here-->
<?php endif; ?>
</div>
</div>
<?php endif; ?>

<?php if($this->countModules('bottom1') || $this->countModules('bottom2') || $this->countModules('bottom3') || $this->countModules('bottom4')) : ?>
<div class="container" id="bottomwrap">
<div class="base">
<?php
if ($this->countModules('bottom1') && $this->countModules('bottom2') || $this->countModules('bottom1') && $this->countModules('bottom3') || $this->countModules('bottom1') && $this->countModules('bottom4') || $this->countModules('bottom2') && $this->countModules('bottom1') || $this->countModules('bottom2') && $this->countModules('bottom3') || $this->countModules('bottom2') && $this->countModules('bottom4') || $this->countModules('bottom3') && $this->countModules('bottom1') || $this->countModules('bottom3') && $this->countModules('bottom2') || $this->countModules('bottom3') && $this->countModules('bottom4') || $this->countModules('bottom4') && $this->countModules('bottom1') || $this->countModules('bottom4') && $this->countModules('bottom2') || $this->countModules('bottom4') && $this->countModules('bottom3') ) $bottom=1;				
if ($this->countModules('bottom1') && $this->countModules('bottom2') && $this->countModules('bottom3') || $this->countModules('bottom1') && $this->countModules('bottom2') && $this->countModules('bottom4') || $this->countModules('bottom1') && $this->countModules('bottom3') && $this->countModules('bottom4') || $this->countModules('bottom2') && $this->countModules('bottom3') && $this->countModules('bottom4')) $bottom=2;
if ($this->countModules('bottom1') && $this->countModules('bottom2') && $this->countModules('bottom3') && $this->countModules('bottom4')) $bottom=3;
?>

<?php if($this->countModules('bottom1') || $this->countModules('bottom2') || $this->countModules('bottom3') || $this->countModules('bottom4')) : ?>

<div id="bottom" class="clearfix"><!--bottom starts here-->			
<?php if ($this->countModules('bottom1')): ?><!--bottom1 starts here-->
<div id="bottom1" class=" <?php if ( $bottom == 1 ):echo ('sixcol'); elseif ( $bottom == 2 ):echo ('fourcol'); elseif ( $bottom == 3 ):echo ('threecol'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="bottom1" style="xhtml" />
</div> <!--bottom1 ends here-->
<?php endif; ?>
<?php if ($this->countModules('bottom2')): ?><!--bottom2 starts here-->
<div id="bottom2" class=" <?php if ( $bottom == 1 && $this->countModules('bottom3') || $bottom == 1 && $this->countModules('bottom4') ):echo ('sixcol'); elseif ( $bottom == 1): echo ('sixcol last'); elseif ( $bottom == 2 ):echo ('fourcol'); elseif ( $bottom == 3 ):echo ('threecol');else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="bottom2" style="xhtml" />
</div> <!--bottom2 ends here-->
<?php endif; ?>
<?php if ($this->countModules('bottom3')): ?><!--bottom3 starts here-->
<div id="bottom3" class=" <?php if ( $bottom == 1 && $this->countModules('bottom4')):echo ('sixcol'); elseif ( $bottom == 1):echo ('sixcol last'); elseif ( $bottom == 2 && $this->countModules('bottom4')):echo ('fourcol'); elseif ($bottom == 2): echo ('fourcol last'); elseif ( $bottom == 3 ):echo ('threecol'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="bottom3" style="xhtml" />
</div> <!--bottom3 ends here-->
<?php endif; ?>
<?php if ($this->countModules('bottom4')): ?><!--bottom4 starts here-->
<div id="bottom4" class=" <?php if ( $bottom == 1 ):echo ('sixcol last'); elseif ( $bottom == 2 ):echo ('fourcol last'); elseif ( $bottom == 3 ):echo ('threecol last'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="bottom4" style="xhtml" />
</div> <!--bottom4 ends here-->
<?php endif; ?>
</div><!--bottom ends here-->
<?php endif; ?>
</div>
</div>
<?php endif; ?>

<?php if($this->countModules('footer1') || $this->countModules('footer2') || $this->countModules('footer3') || $this->countModules('footer4')) : ?>
<div class="container" id="footerwrap">
<div class="base">
<?php
if ($this->countModules('footer1') && $this->countModules('footer2') || $this->countModules('footer1') && $this->countModules('footer3') || $this->countModules('footer1') && $this->countModules('footer4') || $this->countModules('footer2') && $this->countModules('footer1') || $this->countModules('footer2') && $this->countModules('footer3') || $this->countModules('footer2') && $this->countModules('footer4') || $this->countModules('footer3') && $this->countModules('footer1') || $this->countModules('footer3') && $this->countModules('footer2') || $this->countModules('footer3') && $this->countModules('footer4') || $this->countModules('footer4') && $this->countModules('footer1') || $this->countModules('footer4') && $this->countModules('footer2') || $this->countModules('footer4') && $this->countModules('footer3') ) $footer=1;	
if ($this->countModules('footer1') && $this->countModules('footer2') && $this->countModules('footer3') || $this->countModules('footer1') && $this->countModules('footer2') && $this->countModules('footer4') || $this->countModules('footer1') && $this->countModules('footer3') && $this->countModules('footer4') || $this->countModules('footer2') && $this->countModules('footer3') && $this->countModules('footer4')) $footer=2;
if ($this->countModules('footer1') && $this->countModules('footer2') && $this->countModules('footer3') && $this->countModules('footer4')) $footer=3;
?>

<?php if($this->countModules('footer1') || $this->countModules('footer2') || $this->countModules('footer3') || $this->countModules('footer4')) : ?>

<div id="footer" class="clearfix"><!--footer starts here-->			
<?php if ($this->countModules('footer1')): ?><!--footer1 starts here-->
<div id="footer1" class=" <?php if ( $footer == 1 ):echo ('sixcol'); elseif ( $footer == 2 ):echo ('fourcol'); elseif ( $footer == 3 ):echo ('threecol'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="footer1" style="xhtml" />
</div> <!--footer1 ends here-->
<?php endif; ?>
<?php if ($this->countModules('footer2')): ?><!--footer2 starts here-->
<div id="footer2" class=" <?php if ( $footer == 1 && $this->countModules('footer3') || $footer == 1 && $this->countModules('footer4') ):echo ('sixcol'); elseif ( $footer == 1): echo ('sixcol last'); elseif ( $footer == 2 ):echo ('fourcol'); elseif ( $footer == 3 ):echo ('threecol');else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="footer2" style="xhtml" />
</div> <!--footer2 ends here-->
<?php endif; ?>
<?php if ($this->countModules('footer3')): ?><!--footer3 starts here-->
<div id="footer3" class=" <?php if ( $footer == 1 && $this->countModules('footer4')):echo ('sixcol'); elseif ( $footer == 1):echo ('sixcol last'); elseif ( $footer == 2 && $this->countModules('footer4')):echo ('fourcol'); elseif ($footer == 2): echo ('fourcol last'); elseif ( $footer == 3 ):echo ('threecol'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="footer3" style="xhtml" />
</div> <!--footer3 ends here-->
<?php endif; ?>
<?php if ($this->countModules('footer4')): ?><!--footer4 starts here-->
<div id="footer4" class=" <?php if ( $footer == 1 ):echo ('sixcol last'); elseif ( $footer == 2 ):echo ('fourcol last'); elseif ( $footer == 3 ):echo ('threecol last'); else: echo ('twelvecol'); endif; ?> ">
<jdoc:include type="modules" name="footer4" style="xhtml" />
</div> <!--footer4 ends here-->
<?php endif; ?>
</div><!--footer ends here-->
<?php endif; ?>
</div>
</div>
<?php endif; ?>

<div class="container" id="copyrightwrap">
<div class="base">
<div id="copyright" class="clearfix"><!--copyright starts here-->
<?php require("footer.php"); ?>
</div><!--copyright ends here-->
<?php if (($backtotop) !=0) : ?><!--backtotop starts here-->
<div id="backtotop" >          
<a href="#bktop" title="BACK TO TOP"><img src="templates/<?php echo $this->template?>/images/backtotop.png" style="border:0;" alt="TOP" /></a>
</div><!--backtotop ends here-->
<?php endif; ?><!--backtotop ends here-->
</div>
</div>

<div class="container">
<div class="base">
<?php if ($this->countModules('debug')) { ?><!--debug starts here-->
<div id="debug" class="twelvecol ">
<jdoc:include type="modules" name="debug" style="xhtml" />
</div>
<?php } ?><!--debug ends here --> 
</div>
</div>

</div><!--container id ends here -->

<?php if( $analyticsCode ){//<--analytics. ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $analyticsCode; ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php }//analytics.--> ?>
<!--[if lte IE 6]><script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/ie6/warning.js"></script><script>window.onload=function(){e("<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/ie6/")}</script><![endif]-->
</body>
</html>
