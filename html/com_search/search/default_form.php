<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

 $lang = JFactory::getLanguage();
 $upper_limit = $lang->getUpperLimitSearchWord();
 
?>

<ul class="nav nav-tabs narrow anim">
  <li class="active"><a href="#search" data-toggle="tab"><i class="icon-search"></i> Search </a></li>
  <li><a href="#advanced" data-toggle="tab"><i class="icon-cog"></i> Advanced </a></li>
</ul>
<div class="component-content search-results folded-shadow">
  <form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search');?>" method="post">
    <div class="tab-content">
      <div class="tab-pane active" id="search">
        <fieldset class="word">
          <label for="search-searchword" class="pull-left"> <?php echo JText::_('COM_SEARCH_FOR');?> </label>
          <input type="text" name="searchword" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="inputbox pull-left" />
          <button name="Search" onclick="this.form.submit()" class="btn btn-primary pull-left" title="<?php echo JText::_('COM_SEARCH_SEARCH');?>"><i class="icon-search"></i></button>
          <input type="hidden" name="task" value="search" />
        </fieldset>
      </div>
      <div class="tab-pane" id="advanced">
        <fieldset class="phrases">
          <legend><?php echo JText::_('COM_SEARCH_FOR');?></legend>
          <div class="phrases-box"><?php echo $this->lists['searchphrase']; ?></div>
          <div class="ordering-box">
            <label for="ordering" class="ordering"><?php echo JText::_('COM_SEARCH_ORDERING');?></label>
            <?php echo $this->lists['ordering'];?></div>
        </fieldset>
        <?php if ($this->params->get('search_areas', 1)) : ?>
        <fieldset class="only">
          <legend><?php echo JText::_('COM_SEARCH_SEARCH_ONLY');?></legend>
          <?php foreach ($this->searchareas['search'] as $val => $txt) :
		    $checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : '';
	?>
          <label for="area-<?php echo $val;?>" class="checkbox">
            <input type="checkbox" name="areas[]" value="<?php echo $val;?>" id="area-<?php echo $val;?>" <?php echo $checked;?> >
            <?php echo JText::_($txt); ?> </label>
          <?php endforeach; ?>
        </fieldset>
        <?php endif; ?>
        <?php if ($this->total > 0) : ?>
        <div class="form-limit">
          <label for="limit"><?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?></label>
          <?php echo $this->pagination->getLimitBox(); ?> </div>
        <p class="counter"><?php echo $this->pagination->getPagesCounter(); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </form>
</div>