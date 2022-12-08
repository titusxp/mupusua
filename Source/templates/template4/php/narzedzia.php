<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

//  Script PHP - http://www.finalwebsites.com
//  Modyficate: joomla-best.com - 03.2008
//  Website: 	http://www.joomla-best.com


// ustawienia dowolnej sciezki przy zmianach (SEO)

$biez_adres = "";
$ustawienia = $_GET;

if(!empty($ustawienia)) {
	foreach($ustawienia as $col => $val) {
	if($col != "zmien_font" && $col != "zmien_width" && $col != "zmien_bg" && $col != "zmien_css") {
		$biez_adres .= $col ."=".$val . "&amp;";
		}
	}

	$sciezka = $_SERVER["PHP_SELF"]."?".substr($biez_adres, 0, -5)."&amp;";
		}
	
	else {
		$sciezka = $_SERVER["PHP_SELF"]."?";
	}
?>


<?php
session_start();

$kolory = array();
$kolory['multi']['file'] = "template_css";
$kolory['red']['file'] = "red";
$kolory['blue']['file'] = "blue";
$kolory['green']['file'] = "green";
$kolory['grey']['file'] = "grey";


if (isset($_GET['zmien_css']) && $_GET['zmien_css'] != "") {
    $_SESSION['css'] = $_GET['zmien_css'];
} else {
    $_SESSION['css'] = (!isset($_SESSION['css'])) ? $default_css : $_SESSION['css'];
}
switch ($_SESSION['css']) {
 
    case "multi":		$tpl_css = "template_css";
						break;
	default:			$tpl_css = "multi";
	case "red":			$tpl_css = "red";
						break;
	case "blue":		$tpl_css = "blue";
						break;
	case "green":		$tpl_css = "green";
						break;
	case "grey":		$tpl_css = "grey";
						break;

}

// Zmiana rozmiaru czcionki body

$rozmiary_czcionek = array();
$rozmiary_czcionek['mala']['file'] = "9px";
$rozmiary_czcionek['duza']['file'] = "13px";
$rozmiary_czcionek['standard']['file'] = "11px";


if (isset($_GET['zmien_font']) && $_GET['zmien_font'] != "") {
    $_SESSION['font'] = $_GET['zmien_font'];
} else {
    $_SESSION['font'] = (!isset($_SESSION['font'])) ? $default_font : $_SESSION['font'];
}
switch ($_SESSION['font']) {

	case "mala":		$tpl_font = "9px";
						break;
	case "duza":		$tpl_font = "13px";
						break;
    case "standard":	$tpl_font = "11px";
						break;
    default:			$tpl_font = "13px";
}


// Zmiana szerokosci strony

$szerokosci_strony = array();
$szerokosci_strony['waska']['file'] = "1020px";
$szerokosci_strony['szeroka']['file'] = "1270px";
$szerokosci_strony['standard']['file'] = "1120px";


if (isset($_GET['zmien_width']) && $_GET['zmien_width'] != "") {
    $_SESSION['width'] = $_GET['zmien_width'];
} else {
    $_SESSION['width'] = (!isset($_SESSION['width'])) ? $default_width : $_SESSION['width'];
}
switch ($_SESSION['width']) {
    
    case "szeroka":		$tpl_width = "1100px";
						$tpl_width1 = 1150;
						$tpl_width2 = "1150px";
						$tpl_width3 = "1270px";
						break;
    case "waska":   	$tpl_width = "850px";
						$tpl_width1 = 900;
						$tpl_width2 = "900px";
						$tpl_width3 = "1020px";
						break;
	case "standard":	$tpl_width = "950px";
						$tpl_width1 = 1000;
						$tpl_width2 = "1000px";
						$tpl_width3 = "1120px";
						break;
    default:			$tpl_width = "950px";
						$tpl_width1 = 1000;
						$tpl_width2 = "1000px";
						$tpl_width3 = "1120px";
}

?>