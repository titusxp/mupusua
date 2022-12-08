<?php
/**
* @package   yoo_master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// get template configuration
include($this['path']->path('layouts:template.config.php'));
	
?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>">

<head>
<?php echo $this['template']->render('head'); ?>
</head>

<body id="page" class="page <?php echo $this['config']->get('body_classes'); ?>" data-config='<?php echo $this['config']->get('body_config','{}'); ?>'>

	<?php if ($this['modules']->count('absolute')) : ?>
	<div id="absolute">
		<?php echo $this['modules']->render('absolute'); ?>
	</div>
	<?php endif; ?>
	
	
<!--begin block header-->			
	<div id="block-header">
		
		<div class="wrapper clearfix">
		
			<header id="header">
			
				<div id="toolbar" class="clearfix">
	
				<?php if ($this['modules']->count('toolbar-l') || $this['config']->get('date')) : ?>
				<div class="float-left">
				
					<?php if ($this['config']->get('date')) : ?>
					<time datetime="<?php echo $this['config']->get('datetime'); ?>"><?php echo $this['config']->get('actual_date'); ?></time>
					<?php endif; ?>
				
					<?php echo $this['modules']->render('toolbar-l'); ?>
					
				</div>
				<?php endif; ?>
					
				<?php if ($this['modules']->count('toolbar-r')) : ?>
				<div class="float-right"><?php echo $this['modules']->render('toolbar-r'); ?></div>
				<?php endif; ?>
				
				</div>
	
				<div id="headerbar" class="clearfix">
				
					<?php if ($this['modules']->count('logo')) : ?>	
					<a id="logo" href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['modules']->render('logo'); ?></a>
					<?php endif; ?>
					
					<?php if($this['modules']->count('headerbar')) : ?>
					<div class="left"><?php echo $this['modules']->render('headerbar'); ?></div>
					<?php endif; ?>
					
				</div>
				
				<div id="menubar"><div><div class="clearfix">
					
					<?php  if ($this['modules']->count('menu')) : ?>
					<nav id="menu"><?php echo $this['modules']->render('menu'); ?></nav>
					<?php endif; ?>
	
					<?php if ($this['modules']->count('search')) : ?>
					<div id="search"><?php echo $this['modules']->render('search'); ?></div>
					<?php endif; ?>
					
				</div></div></div>
			
				<?php if ($this['modules']->count('banner')) : ?>
				<div id="banner"><?php echo $this['modules']->render('banner'); ?></div>
				<?php endif;  ?>
			
			</header>
			
		</div>
		
	</div>
<!--end block header-->
		
	
	
	
<!--begin block top a-->		
	<?php if ($this['modules']->count('top-a')) : ?>
	<div id="block-top-a"><div><div>
		
		<section id="top-a" class="wrapper grid-block"><?php echo $this['modules']->render('top-a', array('layout'=>$this['config']->get('top-a'))); ?></section>
			
	</div></div></div>
	<?php endif; ?>
<!--end block top a-->
	
		
	
<!--begin block top b-->		
	<?php if ($this['modules']->count('top-b')) : ?>
	<div id="block-top-b"><div><div>
		
		<section id="top-b" class="wrapper grid-block"><?php echo $this['modules']->render('top-b', array('layout'=>$this['config']->get('top-b'))); ?></section>
		
	</div></div></div>
	<?php endif; ?>
<!--end block top b-->
	
	
	
	
<!--begin block main-->		
	<?php if ($this['modules']->count('innertop + innerbottom + sidebar-a + sidebar-b') || $this['config']->get('system_output')) : ?>
	<div id="block-main">
		
		<div id="main" class="wrapper grid-block">
		
			<div id="maininner" class="grid-box">
			
				<?php if ($this['modules']->count('innertop')) : ?>
				<section id="innertop" class="grid-block"><?php echo $this['modules']->render('innertop', array('layout'=>$this['config']->get('innertop'))); ?></section>
				<?php endif; ?>
				
				<?php if ($this['config']->get('system_output')) : ?>
				
				<?php if ($this['modules']->count('breadcrumbs')) : ?>
				<section id="breadcrumbs"><?php echo $this['modules']->render('breadcrumbs'); ?></section>
				<?php endif; ?>
				
				<section id="content" class="grid-block"><?php echo $this['template']->render('content'); ?></section>
				
				<?php endif; ?>

				<?php if ($this['modules']->count('innerbottom')) : ?>
				<section id="innerbottom" class="grid-block"><?php echo $this['modules']->render('innerbottom', array('layout'=>$this['config']->get('innerbottom'))); ?></section>
				<?php endif; ?>

			</div>
			
			<?php if ($this['modules']->count('sidebar-a')) : ?>
			<aside id="sidebar-a" class="grid-box"><?php echo $this['modules']->render('sidebar-a', array('layout'=>'stack')); ?></aside>
			<?php endif; ?>
			
			<?php if ($this['modules']->count('sidebar-b')) : ?>
			<aside id="sidebar-b" class="grid-box"><?php echo $this['modules']->render('sidebar-b', array('layout'=>'stack')); ?></aside>
			<?php endif; ?>

		</div>
		
	</div>
	<?php endif; ?>
<!--end block main-->
	
	
		
<!--begin block bottom -->		
	<?php if ($this['modules']->count('bottom-a + bottom-b')) : ?>
	<div id="block-bottom"><div>
			
		<?php if ($this['modules']->count('bottom-a')) : ?>
		<section id="bottom-a" class="wrapper grid-block"><?php echo $this['modules']->render('bottom-a', array('layout'=>$this['config']->get('bottom-a'))); ?></section>
		<?php endif; ?>
		
		<?php if ($this['modules']->count('bottom-b')) : ?>
		<section id="bottom-b" class="wrapper grid-block"><?php echo $this['modules']->render('bottom-b', array('layout'=>$this['config']->get('bottom-b'))); ?></section>
		<?php endif; ?>

	</div></div>
	<?php endif; ?>
<!--end block bottom -->		
	

	
<!--begin block footer-->		
	<?php if ($this['modules']->count('footer + debug') || $this['config']->get('warp_branding')) : ?>
	<div id="block-footer">
	
		<div class="wrapper">
			
			<footer id="footer" class="grid-block">
	
				<?php if ($this['config']->get('totop_scroller')) : ?>
				<a id="totop-scroller" href="#page"></a>
				<?php endif; ?>
				
				<?php
					echo $this['modules']->render('footer');
					$this->output('warp_branding');
					echo $this['modules']->render('debug');
				?>
	
			</footer>
		
		</div>
		
	</div>
	<?php endif; ?>
<!--end block footer-->
	
		
	<?php echo $this->render('footer'); ?>
	
</body>
</html>