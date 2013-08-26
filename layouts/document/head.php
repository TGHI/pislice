<?php defined('_JEXEC') or die;
/**
* piSlice - The simple, responsive template for Joomla! 3.0+
*
* @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
* @license     GNU General Public License version 3 or later; see LICENCE.txt
*/

$this->API->addStyleSheet('http://fonts.googleapis.com/css?family=' . implode("|", $this->fonts->font));
$this->API->addStyleSheet($this->templateURL() . '/css/bootstrap-responsive.min.css');
$this->API->addStyleSheet($this->templateURL() . '/css/elusive-webfont.css');
$this->API->addStyleSheet($this->templateURL() . '/css/template.css');

$this->API->addStyleDeclaration($this->styles->css);

for ($i = 0; $i < count($this->fonts->font); $i++)
{
	if (strpos($this->fonts->font[$i],':'))
	{
		$this->fonts->font[$i] = substr($this->fonts->font[$i], 0, strpos($this->fonts->font[$i],':'));
	}

	$this->fonts->font[$i] = str_replace('+', ' ',$this->fonts->font[$i]);
}

$font  = "    select,input,body,.deeper li{font-family:\"" . $this->fonts->font[0] . "\",sans-serif}\n";
$font .= "    .narrow,.moduletitle,.btn{font-family:\"" . $this->fonts->font[1] . "\",sans-serif;font-weight:500}\n";

$this->API->addStyleDeclaration($font);

$this->API->addScript($this->templateURL()  . '/js/template.js');