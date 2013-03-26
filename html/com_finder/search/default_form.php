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
<?php if ($this->params->get('show_advanced', 1)) : ?>
		if (advSearch != null){
			var searchSlider = new Fx.Slide(advSearch);
			<?php if (!$this->params->get('expand_advanced', 0)) : ?>
			searchSlider.hide();
			<?php endif; ?>
			document.id('advanced-search-toggle').addEvent('click', function(e){
				e = new Event(e);	
				searchSlider.toggle();
			});
		}
<?php endif; ?>
<?php if ($this->params->get('show_autosuggest', 1)) : ?>
	<?php JHtml::script('/templates/' . $doc->template . '/js/autocompleter.js'); ?>
	var url = '<?php echo JRoute::_('index.php?option=com_finder&task=suggestions.display&format=json&tmpl=component', false); ?>';
	var completer = new Autocompleter.Request.JSON(document.id('q'), url, {'postVar': 'q'});
<?php endif; ?>
	});
</script>
<div class="component-content folded-shadow">
<form id="finder-search" action="<?php echo JRoute::_($this->query->toURI()); ?>" method="get" class="form-inline">
  <?php echo $this->getFields(); ?>
  <?php
	/*
	 * DISABLED UNTIL WEIRD VALUES CAN BE TRACKED DOWN.
	 */
	if (false && $this->state->get('list.ordering') !== 'relevance_dsc') : ?>
  <input type="hidden" name="o" value="<?php echo $this->escape($this->state->get('list.ordering')); ?>" />
  <?php endif; ?>
  <fieldset class="word">
    <label for="q"> <?php echo JText::_('COM_FINDER_SEARCH_TERMS'); ?> </label>
    <input type="text" name="q" id="q" size="30" value="<?php echo $this->escape($this->query->input); ?>" class="inputbox" />
    <?php if ($this->escape($this->query->input) != '' || $this->params->get('allow_empty_search')):?>
    <button name="Search" type="submit" class="btn btn-primary"><span class="icon-search icon-white"></span> <?php echo JText::_('JSEARCH_FILTER_SUBMIT');?></button>
    <?php else: ?>
    <button name="Search" type="submit" class="btn btn-primary disabled"><span class="icon-search icon-white"></span> <?php echo JText::_('JSEARCH_FILTER_SUBMIT');?></button>
    <?php endif; ?>
    <?php if ($this->params->get('show_advanced', 1)) : ?>
    <a href="#" id="advanced-search-toggle" class="btn"><span class="icon-list"></span> <?php echo JText::_('COM_FINDER_ADVANCED_SEARCH_TOGGLE'); ?></a>
    <?php endif; ?>
  </fieldset>
  <?php if ($this->params->get('show_advanced', 1)) : ?>
  <div id="advancedSearch" class="collapse">
    <?php if ($this->params->get('show_advanced_tips', 1)) : ?>
    <div class="advanced-search-tip"> <?php echo JText::_('COM_FINDER_ADVANCED_TIPS'); ?> </div>
    <hr />
    <?php endif; ?>
    <div id="finder-filter-window"> <?php echo JHtml::_('filter.select', $this->query, $this->params); ?> </div>
  </div>
  <?php endif; ?>
</form>
</div>