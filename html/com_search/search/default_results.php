<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */
	
 require_once (JPATH_SITE . '/components/com_content/helpers/route.php');

 $base = JURI::getInstance()->toString(array('scheme', 'host', 'port'));
 $start	= (int) $this->pagination->get('limitstart') + 1;
 $total	= (int) $this->pagination->get('total');
 $limit	= (int) $this->pagination->get('limit') * $this->pagination->pagesTotal;
 $limit	= (int) ($limit > $total ? $total : $limit);
 $pages	= JText::sprintf('TPL_PISLICE_SEARCH_RESULTS_OF', $start, $limit, $total); 
		
?>
<?php if(count($this->results == 1)) : ?>
<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS_1'); ?>
<?php else: ?>
<?php echo JText::sprintf('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', count($this->results)); ?>
<?php endif; ?>
<ul class="search-result-list<?php echo $this->pageclass_sfx; ?> list-striped">
  <?php foreach ($this->results as $result) : ?>
  <?php $category_route = JRoute::_(ContentHelperRoute::getCategoryRoute($result->catslug)); ?>
  <li class="search-result">
    <h2 class="result-title">
      <?php if ($result->href) :?>
      <a href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) :?> target="_blank"<?php endif;?>> <?php echo $this->escape($result->title);?> </a>
      <?php else:?>
      <?php echo $this->escape($result->title);?>
      <?php endif; ?>
    </h2>
    <?php if ($result->section): ?>
    <span class="search-result-category small"><?php echo JText::sprintf('TPL_PISLICE_POST_LOCATION', JHtml::_('link',$category_route,$this->escape($result->section)));?></span>
    <span class="small grey result-url<?php echo $this->pageclass_sfx; ?>"><?php echo $base . JRoute::_($result->href); ?></span>
    <?php endif; ?>
    <p class="result-text"> <?php echo $result->text; ?></p>
    <?php endforeach; ?>
  </li>
</ul>
<div class="search-pagination">
  <div class="pagination"> <?php echo $this->pagination->getPagesLinks(); ?> </div>
  <?php if(count($this->results) > 0) : ?>
  <div class="search-pages-counter"> <?php echo $pages; ?> </div>
  <?php endif; ?>
</div>
