<?php
/**
 * @package		Vinaora Cu3ox Slideshow
 * @subpackage	mod_vt_cu3ox_slideshow
 * @copyright	Copyright (C) 2012-2013 VINAORA. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @website		http://vinaora.com
 * @twitter		https://twitter.com/vinaora
 * @facebook	https://www.facebook.com/pages/Vinaora/290796031029819
 * @google+		https://plus.google.com/111142324019789502653/
 */

// no direct access
defined('_JEXEC') or die;
?>

<!-- BEGIN: Vinaora Cu3ox Slideshow >> http://vinaora.com/ -->
<div id="cu3ox<?php echo $module_id; ?>" style="width:<?php echo $PanelWidth; ?>px;height:<?php echo $PanelHeight; ?>px;margin:0 auto;text-align:center;z-index:<?php echo $zindex; ?>">
	<script language="JavaScript" type="text/javascript">
		var cu3oxId = ("cu3ox" + Math.random()).replace(".","");
		document.write('<div id="' + cu3oxId + '" style="text-align:center;"><?php echo $FirstImage; ?></div>');
		if (swfobject.getFlashPlayerVersion().major)
			swfobject.createSWF(
			  {data:"<?php echo $swf; ?>", width:"100%", height:"100%" },
			  {FlashVars:"images=<?php echo JURI::base(); ?>",menu:true, allowFullScreen:false, allowScriptAccess:'sameDomain', wmode:"<?php echo $flash_wmode; ?>", bgcolor:'#FFFFFF', 
			   devicefont:false, scale:'noscale', loop:true, play:true, quality:'high'}, cu3oxId);
	</script>
	<noscript>
		<!--[if !IE]> -->
		<object type="application/x-shockwave-flash" data="<?php echo $swf; ?>" width="100%" height="100%"  align="middle">
		<!-- <![endif]-->
		<!--[if IE]>
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0"
			width="100%" height="100%"  align="middle">
			<param name="movie" value="<?php echo $swf; ?>" />
		<!-->
			<param name="FlashVars" value="images=<?php echo JURI::base(); ?>" />
			<param name="allowScriptAccess" value="always" />
			<param name="allowFullScreen" value="false" />
			<param name="quality" value="high"/>
			<param name="scale" value="noscale"/>
			<param name="wmode" value="<?php echo $flash_wmode; ?>" />
			<param name="bgcolor" value="#ffffff" />
			<?php echo $FirstImage; ?>
		</object>
		<!-- <![endif]-->
	</noscript>
</div>
<!-- END: Vinaora Cu3ox Slideshow >> http://vinaora.com/ -->
