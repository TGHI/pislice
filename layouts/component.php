<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

 $app				= JFactory::getApplication();
 $sitename			= $app->getCfg('sitename');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->API->language; ?>" lang="<?php echo $this->API->language; ?>" dir="<?php echo $this->API->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<jdoc:include type="head" />
<?php $this->render('document/head'); ?>
</head>
<body class="contentpane">
<div class="top">
  <h2><?php echo $sitename; ?></h2>
</div>
<jdoc:include type="message" />
<jdoc:include type="component" />
</body>
</html>