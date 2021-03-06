<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

 JHtml::_('behavior.framework');
 JHtml::_('bootstrap.framework');
 JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
  
?>
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<h1 class="page-title">
<?php if ($this->escape($this->params->get('page_heading'))) : ?>
  <?php echo $this->escape($this->params->get('page_heading')); ?>
<?php else : ?>
  <?php echo $this->escape($this->params->get('page_title')); ?>
<?php endif; ?>
</h1>
<?php endif; ?>
<?php if ($this->params->get('show_search_form', 1)) : ?>
<div id="search-form"> <?php echo $this->loadTemplate('form'); ?> </div>
<?php endif; ?>
<div class="<?php echo $this->pageclass_sfx; ?>">
<?php
    // Load the search results layout if we are performing a search.
    if ($this->query->search === true):
?>
  <div class="search-results"> <?php echo $this->loadTemplate('results'); ?> </div>
  <?php endif; ?>
</div>
