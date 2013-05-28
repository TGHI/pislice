<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

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
    <div class="small"><?php echo JText::sprintf('TPL_PISLICE_WRITTEN_BY') . ' ' . JHtml::_('link', JRoute::_($cntlink), $item->author); ?></div>
    <a href="<?php echo $item->link; ?>"><img src="<?php echo $images->image_intro; ?>" alt="" /></a>
    <div><?php echo $item->introtext; ?></div>
  <?php endforeach; ?>
</ul>
