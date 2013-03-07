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
$script				= $this->_script;
$user				= JFactory::getUser();
$option				= $app->input->getCmd('option', '');
$view				= $app->input->getCmd('view', '');
$layout				= $app->input->getCmd('layout', '');
$task				= $app->input->getCmd('task', '');
$itemid				= $app->input->getCmd('Itemid', '');
$sitename			= $app->getCfg('sitename');

require_once('lib/params.php');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php 
$doc->addStyleSheet('templates/' . $template . '/css/template.css');
$doc->addStyleSheet('templates/' . $template . '/css/bootstrap-responsive.min.css');
$doc->addStyleSheet('templates/' . $template . '/css/elusive-webfont.css');
$doc->addStyleSheet('http://fonts.googleapis.com/css?family=' . $googleFonts);
$doc->addStyleDeclaration($templateStyles);
?>
<jdoc:include type="head" />
</head>
<body class="anim">
<div class="navbar navbar-fixed-top container-fluid">
  <div class="navbar-inner row-fluid">
    <div class="span2">
    </div>
    <div class="span7">
      <a href="<?php echo $this->baseurl; ?>/" class="brand span2"><img src="templates/<?php echo $template; ?>/img/pislice-logo.png" alt="" /></a>
      <jdoc:include type="modules" name="navigation" style="none" />
    </div>
    <div class="span3">
      <jdoc:include type="modules" name="search" style="none" />
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row-fluid clearfix">
    <div class="span2">
      <jdoc:include type="modules" name="sidebar-left" style="none" />
    </div>
    <div class="span7">
      <jdoc:include type="message" />
      <jdoc:include type="modules" name="article-top" style="none" />
      <jdoc:include type="component" />
      <jdoc:include type="modules" name="article-bottom" style="none" />
      <jdoc:include type="modules" name="debug" style="none" />
    </div>
    <div class="span3">
      <jdoc:include type="modules" name="sidebar-right" style="none" />
    </div>
  </div>
</div>
<div class="footer container-fluid" style="">
  <footer>
    <div class="row-fluid clearfix">
      <div class="span2"></div>
      <div class="footer-inner span7 small">
        <div class="span4">
          <h2 style="margin:0 0 10px 0;padding:0 0 5px 0;border-bottom:1px solid #dedfe3;box-shadow:0 1px 0 #fff">piSlice Footer</h2>
          Copyright &copy; 2013 <a href="#">TGHI</a>. All Rights Reserved.<br/>
          piSlice is released under the <a href="http://www.gnu.org/licenses/gpl-3.0.html">GNU General Public License Version 3</a> or later. <br />
          Fork this project over at <a href="https://github.com/TGHI/pislice">Github</a>.
        </div>
        <div class="span4">
          <h2 style="margin:0 0 10px 0;padding:0 0 5px 0;border-bottom:1px solid #dedfe3;box-shadow:0 1px 0 #fff">Joomla Footer Module</h2>
          <jdoc:include type="modules" name="footer" style="none" />
        </div>
        <div class="span4">
        <h2 style="margin:0;padding:0 0 5px 0;margin:0 0 10px 0;border-bottom:1px solid #dedfe3;box-shadow:0 1px 0 #fff">Search</h2>
          <jdoc:include type="modules" name="footer-search" style="none" />
          <h2 style="margin:0;padding:0 0 5px 0;margin:10px 0;border-bottom:1px solid #dedfe3;box-shadow:0 1px 0 #fff">Social</h2>
          <span class="social icon-github"></span>
          <span class="social icon-facebook"></span>
          <span class="social icon-twitter"></span>
          <span class="social icon-googleplus"></span>
        </div>
      </div>
    </div>
  </footer>
</div>
</body>
</html>