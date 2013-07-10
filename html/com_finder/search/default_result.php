<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
*/

 require_once (JPATH_SITE . '/components/com_content/helpers/route.php');

 $mime = !empty($this->result->mime) ? 'mime-' . $this->result->mime : null;
 $base = JURI::getInstance()->toString(array('scheme', 'host', 'port'));
 $category_route = JRoute::_(ContentHelperRoute::getCategoryRoute($this->result->catslug));

if (!empty($this->query->highlight) && empty($this->result->mime) && $this->params->get('highlight_terms', 1) && JPluginHelper::isEnabled('system', 'highlight')){
	$route = $this->result->route . '&highlight=' . base64_encode(json_encode($this->query->highlight));
} else {
	$route = $this->result->route;
}
?>
<div class="article-contents folded-shadow">
  <div class="article-header anim">
    <div class="article-date pull-left">
      <i class="icon-time"></i>
      <span class="narrow"><?php echo JHTML::date($this->result->publish_start_date,'l, F jS Y',true); ?></span>
    </div>
    <br style="clear:both" />
    <h2><?php echo JHtml::_('link',JRoute::_($route), $this->result->title);?></h2>  
    <dl class="article-details">
    <?php if(!empty($this->result->category)) : ?>
      <dt><i class="icon-folder round inset-3d"></i></dt>
      <dd><?php echo JText::sprintf('TPL_PISLICE_POST_LOCATION', JHtml::_('link',$category_route,$this->result->category));?></dd>
    <?php endif; ?>
    </dl>
  </div>
<?php if ($this->params->get('show_description', 1)) : ?>
  <p class="result-text<?php echo $this->pageclass_sfx; ?>"> <?php echo JHtml::_('string.truncate', $this->result->description, $this->params->get('description_length', 255)); ?> </p>
<?php endif; ?>
<?php if ($this->params->get('show_url', 1)) : ?>
  <span class="small grey result-url<?php echo $this->pageclass_sfx; ?>"><?php echo $base . JRoute::_($this->result->route); ?></span>
<?php endif; ?>
</div>