<?php defined('_JEXEC') or die;
/**
* piSlice - The simple, responsive template for Joomla! 3.0+
*
* @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
* @license     GNU General Public License version 3 or later; see LICENCE.txt
*/

class piStyle{
    
    private $parent;
    public $API;
    
    function __construct($parent)
    {
        $this->parent = $parent;
        $this->API = $parent->API;
        $this->styles = $this->setStyles();
        $this->fonts = $this->setFonts();
    }
    
    public function setStyles($style=null){
        
		$bodyBackground = $this->API->params->get('BODY_BACKGROUND_COLOUR');
		$bodyFontColour = $this->API->params->get('BODY_FONT_COLOUR');
		$navbarBackgroundColour = $this->API->params->get('NAVBAR_BACKGROUND_COLOUR');
		$navbarLinkColour = $this->API->params->get('NAVBAR_LINK_COLOUR');
        $linkColour = $this->API->params->get('LINK_COLOUR');
        $linkHover = $this->API->params->get('LINK_HOVER');
        $light3dColour = $this->API->params->get('3D_LIGHT_COLOUR');
		$light3dIconColour = $this->API->params->get('3D_LIGHT_ICON_COLOUR');
		$light3dFontColour = $this->API->params->get('3D_LIGHT_FONT_COLOUR');
        $componentBackgroundColor = $this->API->params->get('COMPONENT_BACKGROUND_COLOUR');
		$detaiIiconsColour = $this->API->params->get('ICON_COLOUR');
		$articleTitleColour = $this->API->params->get('ARTICLE_TITLE_COLOUR');
		$highlight3d = $this->API->params->get('3D_LIGHT_HIGHLIGHT_OPACITY');
		$lowlight3d = $this->API->params->get('3D_LIGHT_LOWLIGHT_OPACITY');
		
        $complementcolour = $this->API->params->get('COMPLEMENT_COLOUR');
        
        $icons =		$this->API->params->get('ICONS');
        $animations =	$this->API->params->get('CSS3_ANIMATIONS');
        $navbarfixed =  $this->API->params->get('NAVBAR_POSITION');
        
		$style .= "    body{background:" . $bodyBackground . "}\n";
		$style .= "    body,input,select{color:" . $bodyFontColour . "}\n";
		$style .= "    .article-contents,.search-results,.nav-tabs > li.active a,.nav-tabs > li > a:hover,.related-items-list li{background:" . $componentBackgroundColor . "}\n";
        $style .= "    a,.autocompleter-selected span.autocompleter-queried,.nav-tabs > .active > a,.term,span.highlight{color:" . $linkColour . "}\n";
        $style .= "    .pagination-list li .filled,.pagination-list li .round:hover div, #system-message .close{background:" . $linkColour . "}\n";
        $style .= "    a:hover{" . $linkHover . "}\n";
        $style .= "    .btn,.btn:hover{background:" . $light3dColour . " !important;border:1px solid rgba(0,0,0," . $lowlight3d . ");box-shadow:inset 1px 1px 0 rgba(255,255,255," . $highlight3d . "),1px 1px 0px rgba(0,0,0," . $lowlight3d . ");color:" . $light3dFontColour . "}\n";
		$style .= "    .btn i[class*=\"icon-\"]{color:" . $light3dIconColour . "}\n";
		$style .= "    .dropdown-menu li:hover{background:" . $light3dColour . "}". "\n";
        $style .= "    i[class*=\"icon-\"],.nav-tabs > li > a{color:" . $detaiIiconsColour . "}\n";
		$style .= "    .article-header h2 a,.article-header h2{color:" . $articleTitleColour . "}\n";
		$style .= "    .article-header h2{border-bottom:1px solid " . $light3dColour . " }". "\n";
        $style .= "    .article-date{color:" . $complementcolour . "}\n";
        $style .= "    .article-index ul a:hover:before,.article-index ul a.active:before{background:" . $complementcolour . "}". "\n";
        $style .= "    blockquote,.blog-item .article-header h2:hover,.categories-module li:hover > h4{border-color:" . $complementcolour . "}". "\n";
		$style .= "    .moduletitle,.breadcrumbs,.separator{box-shadow:0 1px 0 rgba(255,255,255," . $highlight3d . ");border-color:rgba(0,0,0," . $lowlight3d . ")}". "\n";
		$style .= "    .navbar{box-shadow:0 6px 6px rgba(0,0,0," . $lowlight3d . ") !important;background:" . $navbarBackgroundColour . "}". "\n";
		$style .= "    .navbar a{color:" . $navbarLinkColour . "}". "\n";
		$style .= "    .navbar-inner .nav{box-shadow:-1px 0 0 rgba(255,255,255," . $highlight3d . ");border-left:1px solid rgba(0,0,0," . $lowlight3d . ")}". "\n";
		$style .= "    .navbar-inner .nav li{box-shadow:1px 0 0 rgba(255,255,255," . $highlight3d . ");border-color:rgba(0,0,0," . $lowlight3d . ")}". "\n";
		$style .= "    .inset-3d,.btn:active,.open .btn{box-shadow:inset -1px -1px 0 rgba(255,255,255," . $highlight3d . "),inset 1px 1px 0 rgba(0,0,0," . $lowlight3d . ")}". "\n";
        
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
        
        $this->API->addStyleSheet($this->parent->templateURL() . '/css/bootstrap-responsive.min.css');
        $this->API->addStyleSheet($this->parent->templateURL() . '/css/elusive-webfont.css');
        $this->API->addStyleSheet($this->parent->templateURL() . '/css/template.css');
        
    }
    
    public function setFonts($font=null){
        
        $fonts = array(
			$this->API->params->get('MAIN_FONT'),
			$this->API->params->get('SUB_FONT')
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
