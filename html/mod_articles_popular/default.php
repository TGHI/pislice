<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_popular
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<ul class="mostread<?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $item) : ?>
<?php 
  
  $images = json_decode($item->images);

  if (!empty($item->contactid)){

    $needle = 'index.php?option=com_contact&view=contact&id=' . $item->contactid;
    $menu = JFactory::getApplication()->getMenu();
    $itemLink = $menu->getItems('link', $needle, true);
    $cntlink = !empty($itemLink) ? $needle . '&Itemid=' . $itemLink->id : $needle;
	
  }

?>
  <li>
    <h4><a class="serif" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a></h4>
    <div class="small"><?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', JRoute::_($cntlink), $item->author)); ?></div>
    <a href="<?php echo $item->link; ?>"><img src="<?php echo $images->image_intro; ?>" alt="" /></a>
    <div><?php echo $item->introtext; ?></div>
  <?php endforeach; ?>
</ul>
