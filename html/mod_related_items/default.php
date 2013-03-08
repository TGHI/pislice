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
<<?php echo $module_tag; ?> class="related-items<?php echo $moduleclass_sfx; ?>">
<?php if($module->showtitle == 1): ?>
<<?php echo $header_tag; ?> class="moduletitle"><?php echo $module->title; ?></<?php echo $header_tag; ?>>
<?php endif; ?>
  <ul class="related-items-list">
<?php foreach ($list as $item) : ?>
<?php $cat = $item->catslug; ?>
    <li class="span4">
      <a class="serif bold" href="<?php echo $item->route; ?>"><?php echo $item->title; ?></a><br />
      <span class="small grey">
       Posted in <a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($cat)); ?>"><?php echo ucfirst(substr($cat,strpos($cat,':') + 1, strlen($cat))); ?></a> 
	  <?php if ($showDate): ?><span class=""><?php echo JText::sprintf('TPL_PISLICE_PUBLISHED_ON', JHTML::_('date', $item->created, JText::_('DATE_FORMAT_LC4'))); ?></span><?php endif; ?>
      </span>
    </li>
<?php endforeach; ?>
  </ul>
</<?php echo $module_tag; ?>>