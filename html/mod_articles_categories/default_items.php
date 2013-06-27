<?php defined('_JEXEC') or die;
/**
* piSlice - The simple, responsive template for Joomla! 3.0+
*
* @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
* @license     GNU General Public License version 3 or later; see LICENCE.txt
*/
foreach ($list as $item) :

?>
<li <?php if ($_SERVER['PHP_SELF'] == JRoute::_(ContentHelperRoute::getCategoryRoute($item->id))) echo ' class="active"';?>> <?php $levelup = $item->level - $startLevel - 1; ?>
<h<?php echo $params->get('item_heading') + $levelup; ?>>
  <a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id)); ?>"><?php echo $item->title;?></a>
</h<?php echo $params->get('item_heading') + $levelup; ?>>
<?php

	if ($params->get('show_description', 0))
	{
		echo JHtml::_('content.prepare', $item->description, $item->getParams(), 'mod_articles_categories.content');
	}
	if ($params->get('show_children', 0) && (($params->get('maxlevel', 0) == 0) || ($params->get('maxlevel') >= ($item->level - $startLevel))) && count($item->getChildren()))
	{
		echo '<ul>';
		$temp = $list;
		$list = $item->getChildren();
		require JModuleHelper::getLayoutPath('mod_articles_categories', $params->get('layout', 'default').'_items');
		$list = $temp;
		echo '</ul>';
	}
?>
 </li>
<?php endforeach; ?>