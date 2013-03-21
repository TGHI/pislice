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
<<?php echo $header_tag; ?> class="moduletitle"><?php echo $module->title; ?></<?php echo $header_tag; ?>>
<?php endif; ?>
<<?php echo $module_tag; ?> class="similar-tags<?php echo $moduleclass_sfx; ?>">
<?php if ($list): ?>
<ul >
  <?php foreach ($list as $i => $item) : ?>
  <li> <a href="<?php echo JRoute::_($item->url); ?>">
    <?php
				if (!empty($item->core_title))
				{
					echo htmlspecialchars($item->core_title);
				}
				?>
    </a> <?php print_r($list); ?> <img src="" alt="" /> </li>
  <?php endforeach; ?>
</ul>
<?php else : ?>
<span> <?php echo JText::_('MOD_TAGS_SIMILAR_NO_MATCHING_TAGS'); ?></span>
<?php endif; ?>
</<?php echo $module_tag; ?>>