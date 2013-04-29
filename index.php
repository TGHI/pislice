<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

define('DS', DIRECTORY_SEPARATOR);
$base_url = JURI::base();

$app				= JFactory::getApplication();
$doc				= JFactory::getDocument();
$this->language		= $doc->language;
$this->direction	= $doc->direction;
$template			= $this->template;
$user				= JFactory::getUser();
$option				= $app->input->getCmd('option', '');
$view				= $app->input->getCmd('view', '');
$layout				= $app->input->getCmd('layout', '');
$task				= $app->input->getCmd('task', '');
$itemid				= $app->input->getCmd('Itemid', '');
$sitename			= $app->getCfg('sitename');

require_once('lib/opengraph.php');
require_once('lib/params.php');

?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php
echo $opengraph_meta_tags;
$doc->addStyleSheet($base_url . 'templates/' . $template . '/css/template.css');
$doc->addStyleSheet($base_url . 'templates/' . $template . '/css/bootstrap-responsive.min.css');
$doc->addStyleSheet($base_url . 'templates/' . $template . '/css/elusive-webfont.css');
$doc->addStyleSheet('http://fonts.googleapis.com/css?family=' . $googleFonts);
$doc->addStyleDeclaration($templateStyles);
?>
<jdoc:include type="head" />
</head>
<body class="anim">
<div class="navbar light-3d navbar-fixed-top container-fluid">
  <div class="navbar-inner row-fluid">
    <div class="span2"></div>
    <div class="span7">
     <a href="<?php echo $base_url; ?>" class="brand pull-left"><img src="<?php echo $this->params->get('logo'); ?>" alt="<?php echo $sitename; ?>" /></a> 
      <jdoc:include type="modules" name="navigation" style="none" />
    </div>
    <div class="span3">
      <jdoc:include type="modules" name="search" style="none" />
    </div>
  </div>
</div>
<div class="main container-fluid">
  <div class="row-fluid">
    <div class="span2">
      <jdoc:include type="modules" name="sidebar-left" style="none" />
    </div>
    <div class="span7 main-content">
      <jdoc:include type="modules" name="article-top" style="none" />
      <jdoc:include type="message" />
      <jdoc:include type="component" />
      <div class="row-fluid">
        <jdoc:include type="modules" name="article-bottom" style="pi_default" />
      </div>
      <jdoc:include type="modules" name="debug" style="none" />
    </div>
    <div class="span3">
      <jdoc:include type="modules" name="sidebar-right" style="none" />
    </div>
  </div>
</div>
<div class="footer container-fluid">
  <footer>
    <div class="row-fluid">
      <div class="span2"></div>
      <div class="footer-inner span7 small">
        <jdoc:include type="modules" name="footer" style="pi_default" />
      </div>
    </div>
  </footer>
</div>
</body>
</html>