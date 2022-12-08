<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

//  Copyright:  (C) 10.2008 joomla-best.com. All Rights Reserved.
//  License:	Copyrighted Commercial Software 
//  Website: 	http://www.joomla-best.com

?>

<?php
$lewyjest = $this->countModules('left') || $this->countModules('ad');
$prawyjest = $this->countModules('right') || $this->countModules('ad1');
$reklamajest = $this->countModules('gallery') || $this->countModules('advert');

$cpaneljest = $this->countModules('cpanel');
$bannerjest = $this->countModules('banner');
$brakmain = $this->countModules('main');

//$slwidth = 450;//


if ($bannerjest && $cpaneljest) {
$bannerjest = 0;
} 

$slajdjest = $this->countModules('slide1') || $this->countModules('slide2') || $this->countModules('slide3') || $this->countModules('slide4') || $this->countModules('slide5');
$m8jest = $this->countModules('slide1');
$m9jest = $this->countModules('slide2');
$m10jest = $this->countModules('slide3');
$m11jest = $this->countModules('slide4');
$m12jest = $this->countModules('slide5');

$liczba = 0;
if ($m8jest) $liczba++;
if ($m9jest) $liczba++;
if ($m10jest) $liczba++;
if ($m11jest) $liczba++;
if ($m12jest) $liczba++;

/**/

$top1module = 0;

if ($this->countModules('header')) $top1module++;
if ($slajdjest) $top1module++;
if ($this->countModules('header1')) $top1module++;


if ( $slwidth == 0 ) {

	if ( $tpl_width1 == 1150 ) {
		if ( $top1module == 3 ) {
			$top1width = '248px';
			$top11width = '650px';
		} 
		else if ($top1module == 2) {
			$top1width = '246px';
			$top11width = '900px';
		} 
		else if ($top1module == 1) {
			$top1width = '1150px';
			$top11width = '1150px';
		} 
	}
	
	if ( $tpl_width1 == 1000 ) {
		if ( $top1module == 3 ) {
			$top1width = '248px';
			$top11width = '500px';
		} 
		else if ($top1module == 2) {
			$top1width = '246px';
			$top11width = '750px';
		} 
		else if ($top1module == 1) {
			$top1width = '1000px';
			$top11width = '1000px';
		} 
	}
	
	if ( $tpl_width1 == 900 ) {
		if ( $top1module == 3 ) {
			$top1width = '248px';
			$top11width = '400px';
		} 
		else if ($top1module == 2) {
			$top1width = '246px';
			$top11width = '650px';
		} 
		else if ($top1module == 1) {
			$top1width = '900px';
			$top11width = '900px';
		} 
	}
}

else {

	if 	($tpl_width1 == 1150) {
		//$top11 = 480 - $slwidth;
			$slpwidth = $slwidth +4;
			$sldwidth = $slwidth +2;
		if ( $top1module == 3 ) {
			$top1 = (1150-4-$slpwidth)/2;
			$top1width = "$top1".px;
			$top11width = "$sldwidth".px;
		} 
		else if ($top1module == 2) {
			$top1 = 1150-4-$slpwidth;
			$top1width = "$top1".px;
			$top11width = "$sldwidth".px;
		} 
		else if ($top1module == 1) {
			$top1width = "$slpwidth".px;
			$top11width = "$sldwidth".px;
		} 
	}
	
	if 	($tpl_width1 == 1000) {
			$slpwidth = $slwidth +4;
			$sldwidth = $slwidth +2;
		if ( $top1module == 3 ) {
			$top1 = (1000-4-$slpwidth)/2;
			$top1width = "$top1".px;
			$top11width = "$sldwidth".px;
		} 
		else if ($top1module == 2) {
			$top1 = 1000-4-$slpwidth;
			$top1width = "$top1".px;
			$top11width = "$sldwidth".px;
		} 
		else if ($top1module == 1) {
			$top1width = "$slpwidth".px;
			$top11width = "$sldwidth".px;
		} 
	}
	
	if 	($tpl_width1 == 900) {
		$slpwidth = $slwidth +4;
		$sldwidth = $slwidth +2;
		if ( $top1module == 3 ) {
			$top1 = (900-4-$slpwidth)/2;
			$top1width = "$top1".px;
			$top11width = "$sldwidth".px;
		} 
		else if ($top1module == 2) {
			$top1 = 900-4-$slpwidth;
			$top1width = "$top1".px;
			$top11width = "$sldwidth".px;
		} 
		else if ($top1module == 1) {
			$top1width = "$slpwidth".px;
			$top11width = "$sldwidth".px;
		} 
	}
}

/**/

$headerjest = $this->countModules('header') || $slajdjest || $this->countModules('header1');

$mainmodule = 1;
if ($brakmain) {
$mainmodule = 0;
} 

$centrummodule = 1;
$bottom1module = 1;
$top3module = 1;

if ($reklamajest) {
$top1_width = '75%';
$top2_width = '24.9%';
} 
else {
$top1_width = '100%';
$top2_width = '0%';
}

$top12width = '20%'; // 5 slajdow
$top3_width = '80%';
$top4_width = '95%';
$top5_width = '100%';
$top6_width = '98%';

if ($lewyjest && $prawyjest) {
$moduly = 3;
} 
elseif ($lewyjest) {
$moduly = 2;
}
elseif ($prawyjest) {
$moduly = 1;
}
else {
$moduly = 0;
}


if ( $moduly == 3 ) {
	$leftwidth = '24.7%';
	$rightwidth = '24.7%';
	$mainwidth = '50%';	
} 

if ( $moduly == 2 ) {
	$leftwidth = '24.7%';
	$mainwidth = '75%';	
} 

if ( $moduly == 1 ) {
	$rightwidth = '25%';
	$mainwidth = '74.7%';
} 

if ( $moduly == 0 ) {
	$mainwidth = '100%';	
} 

// ok


$top5module = 0;
if ($this->countModules('content1')) $top5module++;
if ($this->countModules('content2')) $top5module++;
if ($this->countModules('content3')) $top5module++;
if ($this->countModules('content4')) $top5module++;
if ($this->countModules('content5')) $top5module++;

if ( $top5module == 5 ) {
	$top5width = '19.9%';
} else if ($top5module == 4) {
	$top5width = '24.9%';
} else if ($top5module == 3) {
	$top5width = '33.2%';
} else if ($top5module == 2) {
	$top5width = '49.8%';
} else if ($top5module == 1) {
	$top5width = '100%';
} 

$bottom2module = 0;

if ($this->countModules('advert1')) $bottom2module++;
if ($this->countModules('advert2')) $bottom2module++;
if ($this->countModules('advert3')) $bottom2module++;
if ($this->countModules('advert4')) $bottom2module++;

if ( $bottom2module == 4 ) {
	$bottom2width = '24.9%';
} else if ($bottom2module == 3) {
	$bottom2width = '33.2%';
} else if ($bottom2module == 2) {
	$bottom2width = '49.8%';
} else if ($bottom2module == 1) {
	$bottom2width = '100%';
} 


$bottom3module = 0;

if ($this->countModules('user1')) $bottom3module++;
if ($this->countModules('user2')) $bottom3module++;
if ($this->countModules('user3')) $bottom3module++;
if ($this->countModules('user4')) $bottom3module++;
if ($this->countModules('user5')) $bottom3module++;

if ( $bottom3module == 5 ) {
	$bottom3width = '19.9%';
} else if ($bottom3module == 4) {
	$bottom3width = '24.9%';
} else if ($bottom3module == 3) {
	$bottom3width = '33.2%';
} else if ($bottom3module == 2) {
	$bottom3width = '49.8%';
} else if ($bottom3module == 1) {
	$bottom3width = '100%';
} 

?>

<?php $divstyle = ""; ?>
