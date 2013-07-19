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
 $this->language	= $doc->language;
 $this->direction	= $doc->direction;
 $sitename			= $app->getCfg('sitename');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<jdoc:include type="head" />
</head>
<body class="contentpane">
<div class="top">
  <h2><?php echo $sitename; ?></h2>
</div>
<jdoc:include type="message" />
<jdoc:include type="component" />
</body>
</html>