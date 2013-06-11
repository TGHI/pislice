<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

$app				= JFactory::getApplication();
$doc				= JFactory::getDocument();
$this->language		= $doc->language;
$this->direction	= $doc->direction;
$template			= $this->template;
$sitename			= $app->getCfg('sitename');

require_once('lib/framework.php');

$piSlice = new piSlice($this);

JHtml::_('bootstrap.framework');

?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<jdoc:include type="head" />
<script src="<?php echo $piSlice->templateURL()  . '/js/template.js'; ?>" type="text/javascript"></script>
</head>
<body>
<jdoc:include type="message" />
<div class="navbar light-3d navbar-fixed-top container-fluid">
  <div class="navbar-inner row-fluid">
    <div class="span2" style="text-align:right">
      <a href="<?php echo $base_url; ?>"><img src="<?php echo $this->params->get('LOGO'); ?>" alt="<?php echo $sitename; ?>" /></a>
    </div>
    <div class="span7">
      <jdoc:include type="modules" name="navigation" style="none" />
    </div>
    <div class="span3">
      <jdoc:include type="modules" name="search" style="none" />
    </div>
  </div>
</div>
<div class="main container-fluid">
  <div class="row-fluid">
  <div class="span1"></div>
    <div class="sidebar-left span1 anim">
      <jdoc:include type="modules" name="sidebar-left" style="pi_plain" />
    </div>
    <div class="span7 main-content">
      <jdoc:include type="modules" name="article-top" style="none" />
      <jdoc:include type="component" />
      <div class="row-fluid">
        <jdoc:include type="modules" name="article-bottom" style="pi_default" />
      </div>
      <jdoc:include type="modules" name="debug" style="none" />
    </div>
    <div class="sidebar-right span3">
      <jdoc:include type="modules" name="sidebar-right" style="pi_plain" />
    </div>
  </div>
</div>
<div class="footer container-fluid">
  <footer>
    <div class="row-fluid">
      <div class="span2"></div>
      <div class="footer-inner span7 small">
        <jdoc:include type="modules" name="footer" style="pi_plain" />
      </div>
    </div>
  </footer>
</div>
</body>
</html>