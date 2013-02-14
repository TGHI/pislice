<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

$templateStyles = "";

// Get template params

$tpl_param_titleFont = 			$this->params->get('titleFont');
$tpl_param_bodyFont = 			$this->params->get('bodyFont');
$tpl_param_navFont = 			$this->params->get('navFont');
$tpl_param_linkColour = 		$this->params->get('linkColour');
$tpl_param_linkHover = 			$this->params->get('linkHover');
$tpl_param_detailIconsColour = 	$this->params->get('detailIconsColour');
$tpl_param_animations = 		$this->params->get('animations');
$tpl_param_generator = 			$this->params->get('generator');

// Google Fonts

if($tpl_param_titleFont || $tpl_param_bodyFont || $tpl_param_navFont){

  $fonts = array($tpl_param_titleFont,$tpl_param_bodyFont,$tpl_param_navFont);
  $googleFonts = implode("|",$fonts);

  for($i = 0; $i < count($fonts);$i++){
    if(strpos($fonts[$i],':')){
      $fonts[$i] = substr($fonts[$i], 0, strpos($fonts[$i],':'));
    }
  }

  $templateStyles .= "    h1,h2,h3,.article-introtext,blockquote{font-family:\"" . str_replace('+', ' ',$fonts[0]) . "\",serif}\n";
  $templateStyles .= "    select,input,body{font-family:\"" . str_replace('+',' ',$fonts[1]) . "\",sans-serif}\n";
  $templateStyles .= "    .narrow{font-family:\"" . str_replace('+', ' ',$fonts[2]) . "\",sans-serif}\n";

}

// Theme Colours

$templateStyles .= "    a{color:" . $tpl_param_linkColour . "}\n";
$templateStyles .= "    a:hover{" . $tpl_param_linkHover . "}\n";
$templateStyles .= "    .article-details dd span,.article-index ul a:before{background:" . $tpl_param_detailIconsColour . "}";

// Theme Misc

if ($tpl_param_animations == 0){
  $templateStyles .= "\n    .anim,.span2{transition:none;-webkit-transition:none;-moz-transition:none;-o-transition:all 0;transform:none !important}";
}

// Misc Params

if ($tpl_param_generator == 0) {
  $doc->_generator = "";
}

?>