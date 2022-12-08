<?php

defined('_JEXEC') or die;

/* The following line gets the application object for things like displaying the site name */
$app = JFactory::getApplication();

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
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/grid.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template;?>/css/joomla.css" type="text/css" />

<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/suckerfish.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/css3.js"></script>	

</head>


<body class="contentpane">

<div class="container">
	<div class="row">
		<div id="componentPage" class="twelvecol"><!--component.php starts here-->
			<jdoc:include type="message" />
			<jdoc:include type="component" />
		</div><!--component.php ends here-->
	</div>
</div>


</body>
</html>