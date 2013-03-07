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
<<?php echo $module_tag; ?> class="<?php echo $moduleclass_sfx; ?>">
<?php if($module->showtitle == 1): ?>
<?php if(isset($header_tag)):?>
<<?php echo $header_tag; ?>><?php echo $module->title; ?></<?php echo $header_tag; ?>>
<?php endif; ?>
<?php endif; ?>
  <ul class="relateditems">
<?php foreach ($list as $item) : ?>
    <li>
      <a href="<?php echo $item->route; ?>"><?php echo $item->title; ?></a>
	  <?php if ($showDate): ?><span class="italic grey small serif"><?php echo JText::sprintf('TPL_PISLICE_PUBLISHED_ON', JHTML::_('date', $item->created, JText::_('DATE_FORMAT_LC4'))); ?></span><?php endif; ?>
    </li>
<?php endforeach; ?>
  </ul>
</<?php echo $module_tag; ?>>