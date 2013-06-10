<?php defined('_JEXEC') or die;
/**
* piSlice - The simple, responsive template for Joomla! 3.0+
*
* @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
* @license     GNU General Public License version 3 or later; see LICENCE.txt
*/

class piStyle{
    
    public $API;
    
    function __construct($parent)
    {
        $this->parent = $parent;
        $this->API = $parent->API;
        $this->styles = $this->setStyles();
        $this->fonts = $this->setFonts();
    }
    
    public function setStyles($style=null){
        
        $linkcolor = $this->API->params->get('linkColour');
        $linkhover = $this->API->params->get('linkHover');
        $light3dcolour = $this->API->params->get('light3dColour');
        $detailiconscolour = $this->API->params->get('detailIconsColour');
        $complementcolour = $this->API->params->get('complementColour');
        
        $icons =		$this->API->params->get('detailIcons');
        $animations =	$this->API->params->get('animations');
        $navbarfixed =  $this->API->params->get('navbarfixed');
        
        $style .= "    a,.autocompleter-selected span.autocompleter-queried,.nav-tabs > .active > a{color:" . $linkcolor . "}\n";
        $style .= "    .pagination-list li .filled,.pagination-list li .round:hover div, #system-message .close{background:" . $linkcolor . "}\n";
        $style .= "    a:hover{" . $linkhover . "}\n";
        $style .= "    .btn,.light-3d{background:" . $light3dcolour . "}\n";
        $style .= "    .article-details [class*=\"icon-\"],.nav-tabs > li > a,.btn > [class*=\"icon-\"] {color:" . $detailiconscolour . "}\n";
        $style .= "    .article-date{color:" . $complementcolour . "}\n";
        $style .= "    .article-index ul a:hover:before,.article-index ul a.active:before{background:" . $complementcolour . "}". "\n";
        $style .= "    blockquote,.blog-item .article-header h2:hover,.categories-module li:hover > h4{border-color:" . $complementcolour . "}". "\n";
        
        if (! $animations) {
            $style .= "\n    .anim *, .anim:before{transition:none;-webkit-transition:none;-moz-transition:none;-o-transition:all 0}". "\n";
        }
        
        if (!$icons) {
            $style .= "\n    .article-details dd > span{display:none}";
        }
        
        if ($navbarfixed) {
            $style .= "    .navbar-fixed-top{position:fixed;top:0;right: 0;left: 0;z-index: 1030}" . "\n";
            $style .= "    body{padding: 70px 0 0;margin:0}";
        }
        
        $this->API->addStyleDeclaration($style);
        
        $this->API->addStyleSheet($this->parent->templateURL() . '/css/template.css');
        $this->API->addStyleSheet($this->parent->templateURL() . '/css/bootstrap-responsive.min.css');
        $this->API->addStyleSheet($this->parent->templateURL() . '/css/elusive-webfont.css');
        
    }
    
    public function setFonts($font=null){
        
        $fonts = array($this->API->params->get('bodyFont'),
        $this->API->params->get('navFont')
        );
        
        if (!empty($fonts)) {
            
            $this->API->addStyleSheet('http://fonts.googleapis.com/css?family=' . implode("|", $fonts));
            
            for ($i = 0; $i < count($fonts); $i++) {
                if (strpos($fonts[$i],':')) {
                    $fonts[$i] = substr($fonts[$i], 0, strpos($fonts[$i],':'));
                }
                $fonts[$i] = str_replace('+', ' ',$fonts[$i]);
            }
            
            $font .= "    select,input,body{font-family:\"" . $fonts[0] . "\",sans-serif}\n";
            $font .= "    .narrow,.moduletitle{font-family:\"" . $fonts[1] . "\",sans-serif;font-weight:500}\n";
            
            $this->API->addStyleDeclaration($font);
            
        }
    }
}
