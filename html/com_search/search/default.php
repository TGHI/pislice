<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

JHtml::_('behavior.highlighter', (array)($this->origkeyword));

?>
<?php if ($this->params->get('show_page_heading', 1)) : ?>
<h1 class="page-title">
<?php if ($this->escape($this->params->get('page_heading'))) :?>
  <?php echo $this->escape($this->params->get('page_heading')); ?>
<?php else : ?>
  <?php echo $this->escape($this->params->get('page_title')); ?>
<?php endif; ?>
</h1>
<?php endif; ?>
<div id="search-form"> 
  <?php echo $this->loadTemplate('form'); ?>
</div>
<div class="folded-shadow finder<?php echo $this->pageclass_sfx; ?>">
<br id="highlighter-start" />
  <div class="search-results">
  <?php if ($this->error == null) :
	echo $this->loadTemplate('results');
else :
	echo $this->loadTemplate('error');
endif; ?>
  <br id="highlighter-end" />
  </div>
</div>
