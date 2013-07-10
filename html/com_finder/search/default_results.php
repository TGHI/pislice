<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

if (!empty($this->query->highlight) && $this->params->get('highlight_terms', 1)){
	JHtml::_('behavior.highlighter', $this->query->highlight);
}

$app = JFactory::getApplication();

// Display the suggested search if it is different from the current search.
if (($this->suggested && $this->params->get('show_suggested_query', 1)) || ($this->explained && $this->params->get('show_explained_query', 1))):
?>
<div id="search-query-explained">
<?php
  
  if ($this->total > 0){

    if ($this->suggested && $this->params->get('show_suggested_query', 1)){

      $uri = JUri::getInstance($this->query->toURI());
      $uri->setVar('q', $this->suggested);

      $link	= '<a href="' . JRoute::_($uri->toString(array('path', 'query'))) . '">'. $this->escape($this->suggested) . '</a>';
      echo JText::sprintf('COM_FINDER_SEARCH_SIMILAR', $link);
    }

    elseif ($this->explained && $this->params->get('show_explained_query', 1)){
        echo '<h5 class="well">' . $this->explained . '</h5>';
    }
  };
  ?>
</div>
<?php
endif;

if ($this->total == 0):
?>
<div id="search-result-empty">
  <?php if ($app->getLanguageFilter()) : ?>
  <h5 class="well"><?php echo JText::sprintf('COM_FINDER_SEARCH_NO_RESULTS_BODY_MULTILANG', $this->escape($this->query->input)); ?></h5>
  <?php else : ?>
  <h5 class="well"><?php echo JText::sprintf('COM_FINDER_SEARCH_NO_RESULTS_BODY', $this->escape($this->query->input)); ?></h5>
  <?php endif; ?>
</div>
<?php
else:
	// Prepare the pagination string.  Results X - Y of Z
	$start	= (int) $this->pagination->get('limitstart') + 1;
	$total	= (int) $this->pagination->get('total');
	$limit	= (int) $this->pagination->get('limit') * $this->pagination->pagesTotal;
	$limit	= (int) ($limit > $total ? $total : $limit);
	$pages	= JText::sprintf('COM_FINDER_SEARCH_RESULTS_OF', $start, $limit, $total);
?>
<br id="highlighter-start" />
<div class="search-result-list <?php echo $this->pageclass_sfx; ?> list-striped">
<?php
	for ($i = 0, $n = count($this->results); $i < $n; $i++):
		$this->result	= &$this->results[$i];
		$layout			= $this->getLayoutFile($this->result->layout);
?>
<?php echo $this->loadTemplate($layout); ?>
<?php endfor; ?>
</div>
<br id="highlighter-end" />
<div class="search-pagination">
  <div class="pagination"> <?php echo $this->pagination->getPagesLinks(); ?> </div>
  <div class="search-pages-counter"> <?php echo $pages; ?> </div>
</div>
<?php endif;