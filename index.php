<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

//Some handy variables
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
$doc->addStyleSheet('http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic|Open+Sans:400,300,700,300italic,400italic');
?>
<jdoc:include type="head" />
</head>
<body>
<div class="container-fluid center">
  <jdoc:include type="modules" name="article-top" style="none" />
  <jdoc:include type="modules" name="article-top2" style="none" />
</div>
<div class="container-fluid center">
  <jdoc:include type="message" />
  <jdoc:include type="component" />
  <div class="span2"> test? </div>
</div>
<div class="container-fluid center">
  <jdoc:include type="modules" name="article-bottom" style="none" />
  <jdoc:include type="modules" name="debug" style="none" />
</div>
</body>
</html>