<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

$header_tag = $params->get('header_tag');
$module_tag = $params->get('module_tag');

?>
<?php if($module->showtitle == 1): ?>
<<?php echo $header_tag;?> class="moduletitle"><?php echo $module->title; ?></<?php echo $header_tag;?>>
<?php endif; ?>
<<?php echo $module_tag; ?> class="mod-footer<?php echo $moduleclass_sfx; ?>">
  <div class="footer1<?php echo $moduleclass_sfx ?>"><?php echo $lineone; ?></div>
  <div class="footer2<?php echo $moduleclass_sfx ?>"><?php echo JText::_('MOD_FOOTER_LINE2'); ?></div>
</<?php echo $module_tag; ?>>