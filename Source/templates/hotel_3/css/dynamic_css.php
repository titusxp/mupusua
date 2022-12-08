<?php
header("Content-type: text/css");
if (isset($_GET['width'])) 
{ $width = $_GET['width'];}
else { $width = '980'; }
if (isset($_GET['font'])) 
{ $font = $_GET['font'];}
else { $font = 'sans-serif'; }
if (isset($_GET['font_title'])) 
{ $font_title = $_GET['font_title'];}
else { $font_title = 'sans-serif'; }
if (isset($_GET['font_content'])) 
{ $font_content = $_GET['font_content'];}
else { $font_content = 'sans-serif'; }
if (isset($_GET['width_left'])) 
{ $width_left = $_GET['width_left'];}
else { $width_left = '200px'; }
if (isset($_GET['width_right'])) 
{ $width_right = $_GET['width_right'];}
else { $width_right = '200px'; }
if (isset($_GET['width_left_side'])) 
{ $width_left_side = $_GET['width_left_side'];}
else { $width_left_side = '300px'; }
if (isset($_GET['width_item'])) 
{ $width_item = $_GET['width_item'];}
else { $width_item = '170'; }
if (isset($_GET['colorh2'])) 
{ $colorh2 = $_GET['colorh2'];}
else { $colorh2 = '006d98'; }
if (isset($_GET['color_link'])) 
{ $color_link = $_GET['color_link'];}
else { $color_link = 'c35d1e'; }
if (isset($_GET['website_title_color'])) 
{ $website_title_color = $_GET['website_title_color'];}
else { $website_title_color = 'c35d1e'; }
if (isset($_GET['intro_color'])) 
{ $intro_color = $_GET['intro_color'];}
else { $intro_color = 'ffffff'; }
if (isset($_GET['top_menu_color'])) 
{ $top_menu_color = $_GET['top_menu_color'];}
else { $top_menu_color = 'ffffff'; }
?>


/** 	COLOR 			**/


.website-title {
color:#<?php echo $website_title_color ; ?>;
}

.module-intro, .module-intro h3 {
color:#<?php echo $intro_color ; ?>;
}

.top_menu li a, #top_menu li span.separator {
color:#<?php echo $top_menu_color ; ?>;
}


/** 			MENUS 		**/

.bottom_menu li.active a, .bottom_menu li:hover a {
color: #<?php echo $color_link ; ?>;
}

a, .readmore a, input[type="submit"], button, .breadcrumb a:hover,
.horizontal_menu li.active a, .horizontal_menu li:hover a {
color: #<?php echo $color_link ; ?>;
}

.drop-down li li:hover > a, .drop-down li li.active > a, .drop-down li li.active > span {
color: #<?php echo $color_link ; ?>;
}

/**		TITLE 		**/

h2, h2 a {
color: #<?php echo $colorh2 ; ?>;
}


/** 		DROP DOWN MENU 			**/

.drop-down li {
width : <?php echo $width_item ; ?>px;
}

.drop-down li ul {
width : <?php echo $width_item ; ?>px;
}

.drop-down li ul ul {
left: <?php echo ( $width_item - 3 ); ?>px;
}


/**		FONT	**/

.logo span {
font-family: '<?php echo $font_title ; ?>', 'Open Sans';
}

h1, .componentheading, h2.contentheading, .blog-featured h2 {
font-family: '<?php echo $font ; ?>', 'Open Sans';
}

.drop-down ul li a, .drop-down ul li span.separator {
font-family: '<?php echo $font ; ?>', 'Open Sans';
}

.left_column h3, .right-module-position h3, .top-module-position h3, .bottom-module-position h3, .user1 h3, .user2 h3, .user3 h3, 
.user4 h3, .user5 h3, .user6 h3, .user_image1 h3, .user_image2 h3, .user_image3 h3 {
font-family: '<?php echo $font ; ?>', 'Open Sans';
}

body {
font-family: '<?php echo $font_content ; ?>';
}


/**			Width 		**/

body {
min-width : <?php echo ($width + 20) ; ?>px;
}

.wrapper-site {
width:<?php echo $width ; ?>px;
}

.left_column {
width:<?php echo $width_left ; ?>;
}

.right-module-position {
width:<?php echo $width_right ; ?>;
}

.logo-header-left {
width:<?php echo $width_left_side ; ?>;
}