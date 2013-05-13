<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

$base_url = JURI::base();

$app				= JFactory::getApplication();
$doc				= JFactory::getDocument();
$this->language		= $doc->language;
$this->direction	= $doc->direction;
$option				= $app->input->getCmd('option', '');
$view				= $app->input->getCmd('view', '');
$layout				= $app->input->getCmd('layout', '');
$task				= $app->input->getCmd('task', '');
$itemid				= $app->input->getCmd('Itemid', '');
$print				= $app->input->getCmd('print', '');
$sitename			= $app->getCfg('sitename');

require_once('lib/opengraph.php');
require_once('lib/params.php');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<jdoc:include type="head" />
<?php 
$doc->addStyleSheet('http://fonts.googleapis.com/css?family=' . $googleFonts);
$doc->addStyleDeclaration(
   $templateStyles . 
'  body{font-size:1em;padding:0}
    .article-item img{width:100%}
    .article-item,.navbar{padding:1em}
    .article-introtext{display:none}
	.article-header{padding-bottom:1em}
    .article-header h2{font-size:2em}
    .article-details{margin:0;padding:0}
    .article-details dd{float:left;margin:0 1em 0 0 }
    .modified{color:#999;font-size:0.8em}');

?>
</head>
<body class="contentpane modal">
<?php if ($print == 1) : ?>
<div class="navbar light-3d">
  <img src="<?php echo $this->params->get('logo'); ?>" alt="<?php echo $sitename; ?>" />
</div>
<?php endif; ?>
<jdoc:include type="message" />
<jdoc:include type="component" />
</body>
</html>