<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

?>
<?php if ($list): ?>
<ul>
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