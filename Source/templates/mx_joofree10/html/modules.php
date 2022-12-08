<?php
 
//No direct access!
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<?php

function modChrome_color($module, &$params, &$attribs)
{
$pos   = JString::strpos($module->title, ' ');
$title = ($pos !== false) ? JString::substr($module->title, 0, $pos).'<span class="dcolor">'.JString::substr($module->title, $pos).'</span>' : $module->title;

if (!empty ($module->content)) : ?>
<div class="mcolor">
<?php if ($module->showtitle != 0) : ?>
<h3 class="title"><?php echo $title; ?></h3> 
<?php endif; ?>
<?php echo $module->content; ?>
<div style="clear:both;"></div>
</div>

<?php endif;
}


function modChrome_grey($module, &$params, &$attribs)
{
$pos   = JString::strpos($module->title, ' ');
$title = ($pos !== false) ? JString::substr($module->title, 0, $pos).'<span class="color">'.JString::substr($module->title, $pos).'</span>' : $module->title;

if (!empty ($module->content)) : ?>
<div class="greys">
<?php if ($module->showtitle != 0) : ?>
<h3 class="title"><?php echo $title; ?></h3> 
<?php endif; ?>
<?php echo $module->content; ?>
<div style="clear:both;"></div>
</div>

<?php endif;
}

function modChrome_light($module, &$params, &$attribs)
{
$pos   = JString::strpos($module->title, ' ');
$title = ($pos !== false) ? JString::substr($module->title, 0, $pos).'<span class="color">'.JString::substr($module->title, $pos).'</span>' : $module->title;

if (!empty ($module->content)) : ?>
<div class="white">
<?php if ($module->showtitle != 0) : ?>
<h3 class="title"><?php echo $title; ?></h3> 
<?php endif; ?>
<?php echo $module->content; ?>
<div style="clear:both;"></div>
</div>

<?php endif;
}

function modChrome_reds($module, &$params, &$attribs)
{
$pos   = JString::strpos($module->title, ' ');
$title = ($pos !== false) ? JString::substr($module->title, 0, $pos).'<span class="dcolor">'.JString::substr($module->title, $pos).'</span>' : $module->title;

if (!empty ($module->content)) : ?>

<div class="reds">
<?php if ($module->showtitle != 0) : ?>
<h3 class="title"><?php echo $title; ?></h3> 
<?php endif; ?>
<?php echo $module->content; ?>
<div style="clear:both;"></div>
</div>

<?php endif;
}

function modChrome_greens($module, &$params, &$attribs)
{
$pos   = JString::strpos($module->title, ' ');
$title = ($pos !== false) ? JString::substr($module->title, 0, $pos).'<span class="dcolor">'.JString::substr($module->title, $pos).'</span>' : $module->title;

if (!empty ($module->content)) : ?>

<div class="greens">
<?php if ($module->showtitle != 0) : ?>
<h3 class="title"><?php echo $title; ?></h3> 
<?php endif; ?>
<?php echo $module->content; ?>
<div style="clear:both;"></div>
</div>

<?php endif;
}

function modChrome_blue($module, &$params, &$attribs)
{
$pos   = JString::strpos($module->title, ' ');
$title = ($pos !== false) ? JString::substr($module->title, 0, $pos).'<span class="dcolor">'.JString::substr($module->title, $pos).'</span>' : $module->title;

if (!empty ($module->content)) : ?>

<div class="blues">
<?php if ($module->showtitle != 0) : ?>
<h3 class="title"><?php echo $title; ?></h3> 
<?php endif; ?>
<?php echo $module->content; ?>
<div style="clear:both;"></div>
</div>

<?php endif;
}
function modChrome_oranges($module, &$params, &$attribs)
{
$pos   = JString::strpos($module->title, ' ');
$title = ($pos !== false) ? JString::substr($module->title, 0, $pos).'<span class="dcolor">'.JString::substr($module->title, $pos).'</span>' : $module->title;

if (!empty ($module->content)) : ?>

<div class="oranges">
<?php if ($module->showtitle != 0) : ?>
<h3 class="title"><?php echo $title; ?></h3> 
<?php endif; ?>
<?php echo $module->content; ?>
<div style="clear:both;"></div>
</div>

<?php endif;
}

function modChrome_dark($module, &$params, &$attribs)
{
$pos   = JString::strpos($module->title, ' ');
$title = ($pos !== false) ? JString::substr($module->title, 0, $pos).'<span class="dcolor">'.JString::substr($module->title, $pos).'</span>' : $module->title;

if (!empty ($module->content)) : ?>

<div class="dark">
<?php if ($module->showtitle != 0) : ?>
<h3 class="title"><?php echo $title; ?></h3> 
<?php endif; ?>
<?php echo $module->content; ?>
<div style="clear:both;"></div>
</div>

<?php endif;
}

function modChrome_beige($module, &$params, &$attribs)
{
$pos   = JString::strpos($module->title, ' ');
$title = ($pos !== false) ? JString::substr($module->title, 0, $pos).'<span class="color">'.JString::substr($module->title, $pos).'</span>' : $module->title;

if (!empty ($module->content)) : ?>

<div class="beige">
<?php if ($module->showtitle != 0) : ?>
<h3 class="title"><?php echo $title; ?></h3> 
<?php endif; ?>
<?php echo $module->content; ?>
<div style="clear:both;"></div>
</div>

<?php endif;
}

function modChrome_noshadow($module, &$params, &$attribs)
{
$pos   = JString::strpos($module->title, ' ');
$title = ($pos !== false) ? JString::substr($module->title, 0, $pos).'<span class="color">'.JString::substr($module->title, $pos).'</span>' : $module->title;

if (!empty ($module->content)) : ?>

<div class="noshadow">
<?php if ($module->showtitle != 0) : ?>
<h3 class="title"><?php echo $title; ?></h3> 
<?php endif; ?>
<?php echo $module->content; ?>
<div style="clear:both;"></div>
</div>

<?php endif;
}

?>