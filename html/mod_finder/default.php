<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

JHtml::_('behavior.framework');
JHtml::addIncludePath(JPATH_SITE . '/components/com_finder/helpers/html');

// Load the smart search component language file.
$doc = JFactory::getDocument();
$lang = JFactory::getLanguage();
$lang->load('com_finder', JPATH_SITE);
$suffix = $params->get('moduleclass_sfx');

$finderJs  = "window.addEvent('domready', function(){". "\n";
$finderJs .= '  var value,'. "\n";
$finderJs .= "      searchField = document.id('mod-finder-searchword'),". "\n";
$finderJs .= "      advancedField = document.id('mod-finder-advanced');". "\n";
$finderJs .= "  if (!searchField.getProperty('value')){". "\n";
$finderJs .= "    searchField.setProperty('value', '" . JText::_('MOD_FINDER_SEARCH_VALUE', true) . "');". "\n";
$finderJs .= "  }". "\n";
$finderJs .= "  value = searchField.getProperty('value');". "\n";
$finderJs .= "  searchField.addEvent('focus', function(){". "\n";
$finderJs .= "    if (this.getProperty('value') == '" . JText::_('MOD_FINDER_SEARCH_VALUE', true) . "'){". "\n";
$finderJs .= "      this.setProperty('value', '');". "\n";
$finderJs .= "      this.setStyle('color', '#353535');". "\n";
$finderJs .= "    }". "\n";
$finderJs .= "  }).addEvent('blur', function(){". "\n";
$finderJs .= "    if (!this.getProperty('value')){". "\n";
$finderJs .= "      this.setProperty('value', value);". "\n";
$finderJs .= "      this.setStyle('color', '#999');". "\n";
$finderJs .= "    }". "\n";
$finderJs .= "  }).addEvent('submit', function(e){". "\n";
$finderJs .= "    e = new Event(e);". "\n";
$finderJs .= "    e.stop();". "\n";
$finderJs .= "    if (advancedField != null){". "\n";
$finderJs .= "      advancedField.getElements('select').each(function(s){". "\n";
$finderJs .= "        if (!s.getProperty('value')){". "\n";
$finderJs .= "          s.setProperty('disabled', 'disabled');". "\n";
$finderJs .= "        }". "\n";
$finderJs .= "      });". "\n";
$finderJs .= "    }". "\n";
$finderJs .="     searchField.submit();". "\n";
$finderJs .= "  });". "\n";
if ($params->get('show_autosuggest', 1)){
  JHtml::script('templates/' . $doc->template . '/js/autocompleter.js');
  $finderJs .= "  var url = '" . JRoute::_('index.php?option=com_finder&task=suggestions.display&format=json&tmpl=component', false) . "';". "\n";
  $finderJs .= "  var ModCompleter = new Autocompleter.Request.JSON(searchField, url, {'postVar': 'q'});". "\n";
}
$finderJs .= "});". "\n";

$doc->addScriptDeclaration($finderJs);

?>
<form id="mod-finder-searchform" action="<?php echo JRoute::_($route); ?>" method="get" class="navbar-search inset-3d">
  <div class="search-inner <?php echo $suffix; ?>">
  <div class="loading"></div>
    <input type="text" name="q" id="mod-finder-searchword" class="search-query input-medium" size="<?php echo $params->get('field_size', 20);?>" value="<?php echo htmlspecialchars(JFactory::getApplication()->input->get('q', '', 'string')); ?>" />
    <?php if ($params->get('show_advanced', 1)) : ?>
    <?php if ($params->get('show_advanced', 1) == 2) : ?>
    <a href="<?php echo JRoute::_($route); ?>"><?php echo JText::_('COM_FINDER_ADVANCED_SEARCH'); ?></a>
    <?php elseif ($params->get('show_advanced', 1) == 1) : ?>
    <div id="mod-finder-advanced"> <?php echo JHtml::_('filter.select', $query, $params); ?> </div>
    <?php endif; ?>
    <?php endif; ?>
    <?php echo modFinderHelper::getGetFields($route); ?>
      <div class="button-container">
    <?php if ($params->get('show_button', 1)) : ?>
    <button class="search-button round <?php echo $suffix; ?>'" type="submit" title="<?php echo JText::_('MOD_FINDER_SEARCH_BUTTON'); ?>"><i class="icon-search icon-white"></i></button>
    <?php endif; ?>
  </div>
  </div>
</form>