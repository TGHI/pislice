<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

$template_params	= (array)json_decode($this->params);
$templateStyles		= "";
$opengraph_meta_tags= "";

if (empty($template_params)){

  $db     = JFactory::getDBO();
  $query  = $db->getQuery(true);

  jimport('joomla.filesystem.file');

  $config = file_get_contents('templates/' . $template . '/config/default.config.json');
  
  $db->setQuery("UPDATE #__template_styles SET params = '$config' WHERE template = '$template' LIMIT 1");
  $result = $db->query();
  
  foreach(json_decode($config) as $param=>$value){
	$this->params->set($param,$value);
  }
}

// Google Fonts

$fonts = array($this->params->get('titleFont'),$this->params->get('bodyFont'),$this->params->get('navFont'));
$googleFonts = implode("|",$fonts);

for($i = 0; $i < count($fonts);$i++){
  if(strpos($fonts[$i],':')){
    $fonts[$i] = substr($fonts[$i], 0, strpos($fonts[$i],':'));
  }
  $fonts[$i] = str_replace('+', ' ',$fonts[$i]);
}

$templateStyles .= "    h1,h2,h3,.article-introtext,blockquote,.serif{font-family:\"" . $fonts[0] . "\",serif}\n";
$templateStyles .= "    select,input,body{font-family:\"" . $fonts[1] . "\",sans-serif}\n";
$templateStyles .= "    .narrow,.moduletitle{font-family:\"" . $fonts[2] . "\",sans-serif;font-weight:500}\n";

// Theme Colours

$templateStyles .= "    a,.autocompleter-selected span.autocompleter-queried{color:" . $this->params->get('linkColour') . "}\n";
$templateStyles .= "    .tags a,.tags a:before{background:" . $this->params->get('linkColour') . "}\n";
$templateStyles .= "    a:hover{" . $this->params->get('linkHover') . "}\n";
$templateStyles .= "    .article-details dd > span,.article-index ul a:before,.tags a:hover,.tags a:hover:before{background:" . $this->params->get('detailIconsColour') . "}\n";
$templateStyles .= "    .article-date{color:" . $this->params->get('complementColour') . "}\n";
$templateStyles .= "    .article-index ul a:hover:before,.article-index ul a.active:before{background:" . $this->params->get('complementColour') . "}". "\n";
$templateStyles .= "    blockquote{border-color:" . $this->params->get('complementColour') . "}". "\n";

// Theme Misc

if (! $this->params->get('animations')){
  $templateStyles .= "\n    .anim,.anim *:before,body{transition:none;-webkit-transition:none;-moz-transition:none;-o-transition:all 0;transform:none !important}". "\n";
}

if (! $this->params->get('detailIcons')){
  $templateStyles .= "\n    .article-details dd > span{display:none}";
}

if ($this->params->get('navbarfixed')){
  $templateStyles .= "    .navbar-fixed-top{position:fixed;top:0;right: 0;left: 0;z-index: 1030}" . "\n";
  $templateStyles .= "    body{padding: 70px 0 0;margin:0}";
}

// Misc Params

if ($this->params->get('opengraph') == 1){
  foreach($meta as $metaName=>$metaValue){
    $opengraph_meta_tags .= '  <meta property="' . $metaName . '" content="' . $metaValue . '" />'."\n";  
  }	
}

if (! $this->params->get('generator')) {
  $doc->_generator = "";
}

?>