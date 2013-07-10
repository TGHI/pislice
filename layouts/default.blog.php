<?php defined('_JEXEC') or die;
/**
* piSlice - The simple, responsive template for Joomla! 3.0+
*
* @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
* @license     GNU General Public License version 3 or later; see LICENCE.txt
*/

$app = JFactory::getApplication();

?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->API->language; ?>" lang="<?php echo $this->API->language; ?>" dir="<?php echo $this->API->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<jdoc:include type="head" />
<script src="<?php echo $this->templateURL()  . '/js/template.js'; ?>" type="text/javascript"></script>
</head>
<body>
<jdoc:include type="message" />
<div class="navbar navbar-fixed-top container-fluid">
  <div class="navbar-inner row-fluid">
    <div class="span2">
    <?php if($this->API->params->get('LOGO')) : ?>
      <a href="<?php echo $this->basePath(); ?>"><img src="<?php echo $this->API->params->get('LOGO'); ?>" alt="<?php echo $app->getCfg('sitename'); ?>" /></a>
	 <?php endif; ?>
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
    <div class="sidebar-left span2 anim">
      <jdoc:include type="modules" name="sidebar-left" style="pi_default" />
    </div>
    <div class="span7 main-content">
      <jdoc:include type="modules" name="article-top" style="none" />
      <jdoc:include type="component" />
      <div class="article-bottom">
        <div class="row-fluid">
          <jdoc:include type="modules" name="article-bottom" style="pi_default" />
        </div>
        <div class="row-fluid">
          <jdoc:include type="modules" name="article-bottom2" style="pi_default" />
        </div>
      </div>
      <jdoc:include type="modules" name="debug" style="none" />
    </div>
    <div class="sidebar-right span3">
      <jdoc:include type="modules" name="sidebar-right" style="pi_default" />
    </div>
  </div>
</div>
<div class="footer inset-3d container-fluid">
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