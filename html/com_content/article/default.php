<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.


$app 			= JFactory::getApplication();
$params 		= $this->item->params;
$images 		= json_decode($this->item->images);
$urls 			= json_decode($this->item->urls);
$info    		= $params->get('info_block_position', 0);
$canEdit		= $params->get('access-edit');
$user    		= JFactory::getUser();
$limitstart		= JRequest::getVar('limitstart')

?>
<section class="article-content">
  <div class="article-item<?php echo $this->pageclass_sfx?>">
    <article>
      <?php if ($this->params->get('show_page_heading', 1)) : ?>
      <!-- <div class="page-header">
    <h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
  </div>-->
      <?php endif;?>
      <div class="span2">
        <?php if ($params->get('show_publish_date')) : ?>
        <div class="article-date"> <span class="narrow pull-left" ><?php echo JHTML::date($this->item->publish_up,'M',true) ?></span> <span class="huge pull-left"><?php echo JHTML::date($this->item->publish_up,'d',true) ?></span> </div>
        <?php endif; ?>
        <?php if ($this->item->state == 0): ?>
        <span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
        <?php endif; ?>
        <?php 
        if (isset ($this->item->toc)){
         echo $this->item->toc;
		}
      ?>
      </div>
      <div class="span8">
        <?php if ($params->get('show_title') || $params->get('show_author')) : ?>
        <div class="article-header">
          <h2>
            <?php if ($params->get('show_title')) : ?>
            <?php echo $this->escape($this->item->title); ?>
            <?php endif; ?>
          </h2>
          <?php if ($params->get('show_author') || $params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category')): ?>
          <?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
          <dl class="article-details">
            <?php if (!empty($this->item->author) && ($params->get('show_author'))) : ?>
            <dd><span class="icon author"></span>
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
              <?php endif; ?>
            </dd>
            <?php if ($params->get('show_hits')) : ?>
            <dd><span class="icon hits"></span><?php echo JText::sprintf('TPL_PISLICE_ARTICLE_HITS', $this->item->hits); ?></dd>
            <?php endif; ?>
            <?php if ($params->get('show_parent_category') || ($params->get('show_category'))) : ?>
            <dd><span class="icon category"></span>
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
          <?php if (!$this->print) : ?>
          <?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
          <div class="btn-group pull-right"> <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"> <i class="icon-cog"></i> <span class="caret"></span> </a>
            <ul class="dropdown-menu actions">
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
          </div>
          <?php endif; ?>
          <?php else : ?>
          <div class="pull-right"> <?php echo JHtml::_('icon.print_screen', $this->item, $params); ?> </div>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if (!$params->get('show_intro')) : echo $this->item->event->afterDisplayTitle; endif; ?>
        <?php echo $this->item->event->beforeDisplayContent; ?>
        <?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
		|| (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
        <?php echo $this->loadTemplate('links'); ?>
        <?php endif; ?>
        <?php if ($params->get('access-view')):?>
        <?php 
		// only display introtext/image on first page of a paginated of article
		if (empty($limitstart)): ?>
        <div class="article-introtext"> <?php echo $this->item->introtext; ?> </div>
        <?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>
        <div class="article-image"> <img <?php if (($images->image_fulltext_caption) || ($images->image_fulltext_alt)): echo 'class="anim"'.' title="' .htmlspecialchars($images->image_fulltext_caption) . '"';endif; ?> src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/>
          <?php if (($images->image_fulltext_caption) || ($images->image_fulltext_alt)) : ?>
          <div class="zoom-in anim"></div>
          <div class="caption anim">
            <h4><?php echo htmlspecialchars($images->image_fulltext_alt); ?></h4>
            <p class="small"><?php echo htmlspecialchars($images->image_fulltext_caption); ?></p>
          </div>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <?php 
		// get rid of those stupid page numbers
		$this->item->text = preg_replace('/(<div class=\"pagenavcounter\">)(.*)(<\\/div>)/', '', $this->item->text);
		echo $this->item->text;		
		?>
        <?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative):
	echo $this->item->pagination;
?>
        <?php endif; ?>
        <?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))): ?>
        <?php echo $this->loadTemplate('links'); ?>
        <?php endif; ?>
        <?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
        <?php echo $this->item->introtext; ?>
        <?php //Optional link to let them register to see the whole article. ?>
        <?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JURI($link1);?>
        <p class="readmore"> <a href="<?php echo $link; ?>">
          <?php $attribs = json_decode($this->item->attribs); ?>
          <?php
		if ($attribs->alternative_readmore == null) :
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
          </a></p>
        <?php endif; ?>
        <?php endif; ?>
        <?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) {
	echo $this->item->pagination; 
	}
?>
        <?php echo $this->item->event->afterDisplayContent; ?>
        <?php if ($info == 0): ?>
        <?php if ($params->get('show_modify_date')) : ?>
        <div class="modified"> <i class="icon-calendar"></i> <?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?> </div>
        <?php endif; ?>
        <?php endif; ?>
      </div>
    </article>
  </div>
</section>