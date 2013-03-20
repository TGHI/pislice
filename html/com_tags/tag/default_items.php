<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');
require_once (JPATH_SITE . '/components/com_content/helpers/route.php');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');

// Get the user object.
$user = JFactory::getUser();

// Check if user is allowed to add/edit based on tags permissions.
// Do we really have to make it so people can see unpublished tags???
$canEdit = $user->authorise('core.edit', 'com_tags');
$canCreate = $user->authorise('core.create', 'com_tags');
$canEditState = $user->authorise('core.edit.state', 'com_tags');
$items = $this->items;
$n = count($this->items);
?>
<?php if ($this->items == false || $n == 0) : ?>

<p> <?php echo JText::_('COM_TAGS_NO_ITEMS'); ?></p>
<?php else : ?>
<section class="tag-list">
  <?php foreach ($items as $i=>$item) : ?>
  <?php if ((!empty($item->core_access)) && in_array($item->core_access, $this->user->getAuthorisedViewLevels())) : ?>
  <article>
    <?php if ($item->core_state == 0) : ?>
    <div class="tagged-item system-unpublished cat-list-row<?php echo $i % 2; ?>">
      <?php else: ?>
      <?php $r = $item->router;?>
      <div class="tagged-item <?php echo $i % 2; ?>" >
        <div class="article-header">
          <?php if ($this->params->get('tag_list_show_date', 1)== "publish_up"): ?>
          <div class="article-date"> <span class="icon-time"></span> <span class="narrow"><?php echo JHTML::date($item->displayDate,'l, F jS Y',true) ?></span> </div>
          <?php endif; ?>
          <?php  echo '<h2> <a href="' . JRoute::_($item->link) .'">'
						 . $this->escape($item->core_title) . '</a> </h2>';  ?>
          <?php endif; ?>
          </div>
          <?php  $images  = json_decode($item->core_images);?>
          <?php  if ($this->params->get('tag_list_show_item_image', 1)== 1 && !empty($images->image_intro)) :?>
          <img src="<?php echo htmlspecialchars($images->image_intro);?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>">
          <?php endif; ?>
        <?php  if ($this->params->get('tag_list_show_item_description', 1)) : ?>
        <div class="tag-body"> <?php echo JHtmlString::truncate($item->core_body, $this->params->get('tag_list_item_maximum_characters')); ?> </div>
        <?php endif; ?>
      </div>
      <?php  endif;?>
      <div class="clearfix"></div>
  </article>
  <?php endforeach; ?>
</section>
<?php if ($this->state->get('show_pagination')) : ?>
<div class="pagination">
  <?php if ($this->params->def('show_pagination_results', 1)) : ?>
  <p class="counter"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
  <?php endif; ?>
  <?php echo $this->pagination->getPagesLinks(); ?> </div>
<?php endif; ?>
<?php endif; ?>
