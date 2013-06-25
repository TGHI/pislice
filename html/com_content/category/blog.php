<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

$app = JFactory::getApplication();
$templateparams = $app->getTemplate(true)->params;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$cparams = JComponentHelper::getParams('com_media');

JHtml::_('bootstrap.framework');

?>
<section class="blog-roll<?php echo $this->pageclass_sfx;?>">
  <?php if ($this->params->get('show_page_heading', 1) || $this->params->get('show_category_title')): ?>
  <h1>
    <?php 
  if($this->params->get('show_page_heading', 1)){
    echo $this->escape($this->params->get('page_heading')); 
  }
  ?>
    <?php if ($this->params->get('show_category_title'))
	{
		echo '<span class="subheading-category">'.$this->category->title.'</span>';
	}
	?>
  </h1>
  <?php endif; ?>
  <?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
  <?php if (!empty($this->category->description) || !empty($this->category->image)) : ?>
  <div class="category-desc">
    <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
    <img src="<?php echo $this->category->getParams()->get('image'); ?>"/>
    <?php endif; ?>
    <?php if ($this->params->get('show_description') && $this->category->description) : ?>
    <?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
    <?php endif; ?>
  </div>
  <?php endif; ?>
  <?php endif; ?>
  <?php $leadingcount = 0; ?>
  <?php if (!empty($this->lead_items)) : ?>
  <div class="blog-item leading clearfix">
    <?php foreach ($this->lead_items as &$item) : ?>
    <article class="<?php echo $item->state == 0 ? 'system-unpublished' : null; ?>">
      <?php $this->item = &$item; echo $this->loadTemplate('item'); ?>
    </article>
    <?php $leadingcount++; ?>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
  <?php
	$introcount = (count($this->intro_items));
	$counter = 0;
?>
  <?php if (!empty($this->intro_items)) : ?>
  <?php foreach ($this->intro_items as $key => &$item) : ?>
  <div class="blog-item">
    <article class="item <?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
      <?php $this->item = &$item; ?>
      <?php echo $this->loadTemplate('item'); ?> </article>
  </div>
  <?php $counter++; ?>
  <?php endforeach; ?>
  <?php endif; ?>
  <?php if (!empty($this->link_items)) : ?>
  <?php echo $this->loadTemplate('links'); ?>
  <?php endif; ?>
  <?php if (is_array($this->children[$this->category->id]) && count($this->children[$this->category->id]) > 0 && $this->params->get('maxLevel') != 0) : ?>
  <div class="cat-children">
  <?php if($this->params->get('show_category_heading_title_text')): ?>
    <h3><?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?></h3>
  <?php endif; ?>
    <?php echo $this->loadTemplate('children'); ?> </div>
  <?php endif; ?>
  <?php if (($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
  <div class="pagination">
    <?php  if ($this->params->def('show_pagination_results', 1)) : ?>
    <p class="counter"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
    <?php endif; ?>
    <?php echo $this->pagination->getPagesLinks(); ?> </div>
  <?php  endif; ?>
</section>