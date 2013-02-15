<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

$params =& $this->item->params;
$images = json_decode($this->item->images);
$app = JFactory::getApplication();
$canEdit = $this->item->params->get('access-edit');

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>
<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
  <?php endif; ?>
  <div class="article-header">
    <?php if ($params->get('show_title')) : ?>
    <h2>
      <?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
      <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>"> <?php echo $this->escape($this->item->title); ?></a>
      <?php else : ?>
      <?php echo $this->escape($this->item->title); ?>
      <?php endif; ?>
    </h2>
    <?php if ($params->get('show_author') || $params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category')): ?>
    <?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
    <dl class="article-details">
      <dd><span class="icon author round"></span>
        <?php if (!empty($this->item->contactid) && $params->get('link_author') == true) : ?>
        <?php
				$needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
				$menu = JFactory::getApplication()->getMenu();
				$item = $menu->getItems('link', $needle, true);
				$cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
?>
        <?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', JRoute::_($cntlink), $author)); ?>
        <?php else : ?>
        <?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
        <?php endif; ?>
      </dd>
      <?php if ($params->get('show_hits')) : ?>
      <dd><span class="icon hits round"></span><?php echo JText::sprintf('TPL_PISLICE_ARTICLE_HITS', $this->item->hits); ?></dd>
      <?php endif; ?>
      <?php if ($params->get('show_parent_category') || ($params->get('show_category'))) : ?>
            <dd><span class="icon category round"></span>
              <?php if (!empty($this->item->parent_slug)) : ?>
              <?php $title = $this->escape($this->item->parent_title); $url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
              <?php if ($params->get('link_parent_category') && !empty($this->item->parent_slug)) : ?>
              <?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
              <?php else : ?>
              <?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
              <?php endif; ?>
              <?php endif; ?>
              <?php if ($params->get('show_category')) : ?>
              <?php $title = $this->escape($this->item->category_title); $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)) . '">' . $title . '</a>';?>
              <?php if ($params->get('link_category') && $this->item->catslug) : ?>
              <?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
              <?php else : ?>
              <?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
              <?php endif; ?>
              <?php endif; ?>
            </dd>
            <?php endif; ?>
    </dl>
    <?php endif; ?>
    <?php endif; ?>
    <?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
    <ul class="article-actions">
      <?php if ($params->get('show_print_icon')) : ?>
      <li class="print-icon"> <?php echo JHtml::_('icon.print_popup', $this->item, $params); ?> </li>
      <?php endif; ?>
      <?php if ($params->get('show_email_icon')) : ?>
      <li class="email-icon"> <?php echo JHtml::_('icon.email', $this->item, $params); ?> </li>
      <?php endif; ?>
      <?php if ($canEdit) : ?>
      <li class="edit-icon"> <?php echo JHtml::_('icon.edit', $this->item, $params); ?> </li>
      <?php endif; ?>
    </ul>
    <?php endif; ?>
    <?php if (!$params->get('show_intro')) : ?>
    <?php echo $this->item->event->afterDisplayTitle; ?>
    <?php endif; ?>
    <?php echo $this->item->event->beforeDisplayContent; ?>
  </div>
  <?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
  <?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
  <div class="item-image<?php echo htmlspecialchars($imgfloat); ?>"> <img
		<?php if ($images->image_intro_caption):
			echo 'class=""'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
		endif; ?>
		src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/> </div>
  <?php endif; ?>
  <div class="article-introtext"> <?php echo $this->item->introtext; ?> </div>
  <?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?>
  <p class="readmore"> <a href="<?php echo $link; ?>">
    <?php if (!$params->get('access-view')) :
						echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
					elseif ($readmore = $this->item->alternative_readmore) :
						echo $readmore;
						if ($params->get('show_readmore_title', 0) != 0) :
							echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
						endif;
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
					else :
						echo JText::_('COM_CONTENT_READ_MORE');
						echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif; ?>
    </a> </p>
  <?php endif; ?>
  <?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>
<?php echo $this->item->event->afterDisplayContent; ?>