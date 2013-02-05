<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

// Get template params

$tpl_param_linkColour = 		$this->params->get('linkColour');
$tpl_param_linkHover = 			$this->params->get('linkHover');
$tpl_param_detailIconsColour = 	$this->params->get('detailIconsColour');
$tpl_param_animations = 		$this->params->get('animations');
$tpl_param_generator = 			$this->params->get('generator');

// Add styles

$templateStyles =  "    a{color:" . $tpl_param_linkColour . "}\n";
$templateStyles .= "    a:hover{" . $tpl_param_linkHover . "}\n";
$templateStyles .= "    .article-details dd span{background:" . $tpl_param_detailIconsColour . "}";
  
if ($tpl_param_animations == 0){
  $templateStyles .= "\n    .anim,.span2{transition:none;-webkit-transition:none;-moz-transition:none;-o-transition:all 0;transform:none !important}";
}
  
$doc->addStyleDeclaration($templateStyles);

// Misc Params

if ($tpl_param_generator == 0) {
  $doc->_generator = "";
}

?>