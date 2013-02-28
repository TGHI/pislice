<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

$db					= JFactory::getDBO();
$query				= $db->getQuery(true);
$template_params 	= json_decode($this->params);
$templateStyles		= "";

if(count($this->params)){
  jimport('joomla.filesystem.file');

  $config = file_get_contents('templates/' . $template . '/config/default.config.json');
  
  $db->setQuery("UPDATE #__template_styles SET params = '$config' WHERE template = '$template' LIMIT 1");
  $result = $db->query();

  $template_params = json_decode($config);
}

// Google Fonts

$fonts = array($template_params->titleFont,$template_params->bodyFont,$template_params->navFont);
$googleFonts = implode("|",$fonts);

for($i = 0; $i < count($fonts);$i++){
  if(strpos($fonts[$i],':')){
    $fonts[$i] = substr($fonts[$i], 0, strpos($fonts[$i],':'));
  }
  $fonts[$i] = str_replace('+', ' ',$fonts[$i]);
}

$templateStyles .= "    h1,h2,h3,.article-introtext,blockquote{font-family:\"" . $fonts[0] . "\",serif}\n";
$templateStyles .= "    select,input,body{font-family:\"" . $fonts[1] . "\",sans-serif}\n";
$templateStyles .= "    .narrow{font-family:\"" . $fonts[2] . "\",sans-serif}\n";

// Theme Colours

$templateStyles .= "    a{color:" . $template_params->linkColour . "}\n";
$templateStyles .= "    a:hover{" . $template_params->linkHover . "}\n";
$templateStyles .= "    .article-details dd span,.article-index ul a:before{background:" . $template_params->detailIconsColour . "}\n";
$templateStyles .= "    .blog-item-separator{border-bottom:5px dotted " . $template_params->complementColour . "}\n";
$templateStyles .= "    .article-date{color:" . $template_params->complementColour . "}\n";
$templateStyles .= "    .article-index ul a:hover:before,.article-index ul a.active:before{background:" . $template_params->complementColour . "}";

// Theme Misc

if ($template_params->animations == 0){
  $templateStyles .= "\n    .anim,.span2{transition:none;-webkit-transition:none;-moz-transition:none;-o-transition:all 0;transform:none !important}";
}

// Misc Params

if ($template_params->generator == 0) {
  $doc->_generator = "";
}

?>