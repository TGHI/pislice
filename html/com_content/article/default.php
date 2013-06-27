<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

$app	 			= JFactory::getApplication();
$params				= $this->item->params;
$images 			= json_decode($this->item->images);
$urls 				= json_decode($this->item->urls);
$info   	 		= $params->get('info_block_position', 0);
$user    			= JFactory::getUser();
$limitstart			= JRequest::getVar('limitstart');

JHtml::_('bootstrap.framework');

?>

<section class="article-content">
  <div class="article-item <?php echo $this->pageclass_sfx; ?>">
    <article>
      <?php if ($this->params->get('show_page_heading', 1)) : ?>
      <div class="page-header">
        <h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
      </div>
      <?php endif;?>
      <div class="article-contents folded-shadow">
        <?php if ($params->get('show_title') || $params->get('show_author')) : ?>
          <?php $this->item->header = new JLayoutFile('header', JPATH_ROOT . '/templates/' . $template .'/layouts/content/');  ?>
          <?php echo $this->item->header->render($this->item); ?>
	    <?php endif; ?>
        <?php if (!$params->get('show_intro')) : echo $this->item->event->afterDisplayTitle; endif; ?>
        <?php echo $this->item->event->beforeDisplayContent; ?>
        <?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
		|| (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
        <?php echo $this->loadTemplate('links'); ?>
        <?php endif; ?>
        <?php if ($params->get('access-view')):?>
        <?php 
		// only display introtext/image on first page of a paginated of article
		if (empty($limitstart)): ?>
        <?php if($params->get('show_intro')) : ?>
        <div class="article-introtext"> <?php echo $this->item->introtext; ?> </div>
        <?php endif; ?>
        <?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>
        <?php 

		  $fulltext_class = "";

		  if ($images->float_fulltext == "left"){
			  $fulltext_class = " pull-left";
		  }elseif ($images->float_fulltext == "right"){
  			  $fulltext_class = " pull-right";
		  }

		?>
        <div class="article-image<?php echo $fulltext_class; ?>"> <img <?php if (($images->image_fulltext_caption) || ($images->image_fulltext_alt)): echo 'class="anim"'.' title="' .htmlspecialchars($images->image_fulltext_caption) . '"';endif; ?> src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/>
          <?php if (($images->image_fulltext_caption) || ($images->image_fulltext_alt)) : ?>
          <i class="zoom-in icon-zoom-in anim"></i>
          <div class="caption"> <i class="icon-picture pull-left"></i>
            <div class="caption-inner pull-left">
              <h4><?php echo htmlspecialchars($images->image_fulltext_alt); ?></h4>
              <p class="small"><?php echo htmlspecialchars($images->image_fulltext_caption); ?></p>
            </div>
          </div>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <?php 
        if (isset ($this->item->toc)){
         echo $this->item->toc;
		}
         ?>
        <?php 

		if ($app->getTemplate(true)->params->get('ARTICLE_PAGE_NUMBERS') == 0) {
		  // get rid of those stupid page numbers
		  if(preg_match('/(<div class=\"pagenavcounter\">)(.*)(<\\/div>)/', $this->item->text, $pageNumbers)){;
		    $this->item->text = str_replace($pageNumbers[0], '', $this->item->text);
		  }
		}

		// match/remove article nav
		if(preg_match('/(<div class=\"pager\">)(.*)(<\\/div>)/', $this->item->text, $pager)){
		  $this->item->text = str_replace($pager[0], '', $this->item->text);
        }

		echo $this->item->text;	

		?>
        <?php if ($info == 0): ?>
        <?php if ($params->get('show_modify_date')) : ?>
        <p class="modified grey italic"><i class="icon-time"></i> <?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, 'l, F jS Y')); ?> </p>
        <?php endif; ?>
        <?php endif; ?>
        <?php 

		  // put article nav down here
		 if(!empty($pager)){
			 echo $pager[0];
			 echo '<br style="clear:both" />';
		 }

		?>
        <?php
			if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative):
			echo $this->item->pagination;
		?>
        <?php endif; ?>
        <?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))): ?>
        <?php echo $this->loadTemplate('links'); ?>
        <?php endif; ?>
        <?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
        <?php echo $this->item->introtext; ?>
        <?php //Optional link to let them register to see the whole article. ?>
        <?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JURI($link1);?>
        <a class="btn" href="<?php echo $link; ?>">
        <?php $attribs = json_decode($this->item->attribs); ?>
        <?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $this->item->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
				echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif; ?>
        </a>
        <?php endif; ?>
        <?php endif; ?>
        <?php
if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) {
	echo $this->item->pagination; 
	}
?>
        <?php echo $this->item->event->afterDisplayContent; ?> </div>
    </article>
  </div>
</section>