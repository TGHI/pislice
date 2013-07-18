<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */
 
 $doc = JFactory::getDocument();
 JHtml::_('behavior.framework', true);
 
?>
<script type="text/javascript">
	window.addEvent('domready', function() {
		var advSearch = document.id('advancedSearch'),
			finderSearch = document.id('advancedSearch');

<?php if ($this->params->get('show_autosuggest', 1)) : ?>
	<?php JHtml::script('/templates/' . $doc->template . '/js/autocompleter.js'); ?>
	var url = '<?php echo JRoute::_('index.php?option=com_finder&task=suggestions.display&format=json&tmpl=component', false); ?>';
	var completer = new Autocompleter.Request.JSON(document.id('q'), url, {'postVar': 'q'});
<?php endif; ?>
	});
</script>
<ul class="nav nav-tabs narrow anim">
  <li class="active"><a href="#search" data-toggle="tab"><i class="icon-search"></i> Search </a></li>
<?php if ($this->params->get('show_advanced', 1)) : ?>
  <li><a href="#advanced" data-toggle="tab"><i class="icon-cog"></i> Advanced </a></li>
<?php endif; ?>
</ul>
<div class="component-content search-results-form folded-shadow">
  <form id="finder-search" action="<?php echo JRoute::_($this->query->toURI()); ?>" method="get" class="form-inline">
    <?php echo $this->getFields(); ?>
    <?php
	/*
	 * DISABLED UNTIL WEIRD VALUES CAN BE TRACKED DOWN.
	 */
	if (false && $this->state->get('list.ordering') !== 'relevance_dsc') : ?>
    <input type="hidden" name="o" value="<?php echo $this->escape($this->state->get('list.ordering')); ?>" />
    <?php endif; ?>
    <div class="tab-content">
      <div class="tab-pane active" id="search">
        <fieldset class="word">
          <label for="q" class="pull-left"> <?php echo JText::_('COM_FINDER_SEARCH_TERMS'); ?> </label>
          <input type="text" name="q" id="q" size="30" value="<?php echo $this->escape($this->query->input); ?>" class="inputbox pull-left" />
          <button name="Search" type="submit" class="btn btn-primary pull-left"><i class="icon-search"></i></button>
        </fieldset>
      </div>
      <?php if ($this->params->get('show_advanced', 1)) : ?>
      <div class="tab-pane" id="advanced">
        <div id="advancedSearch">
          <?php if ($this->params->get('show_advanced_tips', 1)) : ?>
          <div class="advanced-search-tip"> <?php echo JText::_('COM_FINDER_ADVANCED_TIPS'); ?> </div>
          <hr />
          <?php endif; ?>
          <div id="finder-filter-window"> <?php echo JHtml::_('filter.select', $this->query, $this->params); ?> </div>
        </div>
      </div>
      <?php endif; ?>   
    </div>
  </form>
</div>