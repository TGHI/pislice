<?php defined('_JEXEC') or die;
/**
* piSlice - The simple, responsive template for Joomla! 3.0+
*
* @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
* @license     GNU General Public License version 3 or later; see LICENCE.txt
*/

$app	 	    = JFactory::getApplication();
$params 		= $displayData->params;
$canEdit		= $params->get('access-edit');
$template		= $app->getTemplate();

?>
<div class="article-header anim">
  <?php if ($params->get('show_publish_date')) : ?>
  <div class="article-date pull-left">
    <?php if ($displayData->state == 0): ?>
    <span class="bold">unpusblished</span>
    <?php else : ?>
    <i class="icon-time"></i> <span class="narrow"><?php echo JHTML::date($displayData->publish_up,'l, F jS Y',true) ?></span>
    <?php endif; ?>
  </div>
  <?php endif; ?>
  <?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
  <div class="article-actions dropdown pull-right anim"> <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> <i class="icon-cog"></i> <i class="icon-caret-down" style="font-size:8px"></i> </a>
    <ul class="dropdown-menu">
      <?php if ($params->get('show_print_icon')) : ?>
      <li> <?php echo JHtml::_('icon.print_popup', $displayData, $params); ?> </li>
      <?php endif; ?>
      <?php if ($params->get('show_email_icon')) : ?>
      <li> <?php echo JHtml::_('icon.email', $displayData, $params); ?> </li>
      <?php endif; ?>
      <?php if ($canEdit) : ?>
      <li> <?php echo JHtml::_('icon.edit', $displayData, $params); ?> </li>
      <?php endif; ?>
    </ul>
  </div>
  <?php endif; ?>
  <br style="clear:both" />
  <h2>
    <?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
    <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid)); ?>"> <?php echo $this->escape($displayData->title); ?></a>
    <?php else : ?>
    <?php echo $this->escape($displayData->title); ?>
    <?php endif; ?>
  </h2>
  <?php if ($params->get('show_author') || $params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_tags', 1)): ?>
  <?php $author = $displayData->created_by_alias ? $displayData->created_by_alias : $displayData->author; ?>
  <dl class="article-details">
    <?php if (!empty($displayData->author) && ($params->get('show_author'))) : ?>
    <dt><i class="icon-user round inset-3d"></i></dt>
    <dd>
      <?php if (!empty($displayData->contactid) && $params->get('link_author') == true) : ?>
      <?php
	  
			$needle = 'index.php?option=com_contact&view=contact&id=' . $displayData->contactid;
			$menu = JFactory::getApplication()->getMenu();
			$item = $menu->getItems('link', $needle, true);
			$cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
		?>
      <?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', JRoute::_($cntlink), $author)); ?>
      <?php else : ?>
      <?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
      <?php endif; ?>
      <?php endif; ?>
    </dd>
    <?php if ($params->get('show_hits')) : ?>
    <dt><i class="icon-eye-open round inset-3d"></i></dt>
	<dd>
	<?php echo JText::sprintf('TPL_PISLICE_ARTICLE_HITS', $displayData->hits); ?></dd>
    <?php endif; ?>
    <?php if ($params->get('show_parent_category') || ($params->get('show_category'))) : ?>
    <dt><i class="icon-folder round inset-3d"></i></dt>
    <dd>
      <?php if (!empty($displayData->parent_slug) && $params->get('show_parent_category')): ?>
      <?php $title = $this->escape($displayData->parent_title); $url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($displayData->parent_slug)).'">'.$title.'</a>';?>
      <?php if ($params->get('link_parent_category') && !empty($displayData->parent_slug)) : ?>
      <?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
      <?php else : ?>
      <?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
      <?php endif; ?>
      <?php endif; ?>
      <?php if ($params->get('show_category')) : ?>
      <?php $title = $this->escape($displayData->category_title); $url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($displayData->catslug)) . '">' . $title . '</a>';?>
      <?php if ($params->get('link_category') && $displayData->catslug) : ?>
      <?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
      <?php else : ?>
      <?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
      <?php endif; ?>
      <?php endif; ?>
    </dd>
    <?php endif; ?>
    <?php if ($params->get('show_tags', 1) && !empty($displayData->tags->itemTags)):?>
    <dt><i class="icon-tags round inset-3d"></i></dt>
    <dd>
      <?php $displayData->tagLayout = new JLayoutFile('tags', JPATH_ROOT . '/templates/' . $template .'/layouts/tags/');  ?>
      <?php echo $displayData->tagLayout->render($displayData->tags->itemTags); ?> </dd>
    <?php endif; ?>
  </dl>
  <?php endif; ?>
</div>