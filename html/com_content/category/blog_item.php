<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

$params =& $this->item->params;
$images = json_decode($this->item->images);

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
?>
<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished grey">
  <?php endif; ?>
  <div class="article-contents folded-shadow">
    <?php if ($params->get('show_title') || $params->get('show_author')) : ?>
      <?php $this->item->header = new JLayoutFile('header', JPATH_ROOT . '/templates/' . $template .'/layouts/content/');  ?>
      <?php echo $this->item->header->render($this->item); ?>
    <?php endif; ?>
    <?php if (!$params->get('show_intro')) : ?>
    <?php echo $this->item->event->afterDisplayTitle; ?>
    <?php endif; ?>
    <?php echo $this->item->event->beforeDisplayContent; ?>
    <?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
    <?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
    <div class="blog-image <?php echo htmlspecialchars($imgfloat); ?>"> <img
		<?php if ($images->image_intro_caption):
			echo 'class=""'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
		endif; ?>
		src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/> </div>
    <?php endif; ?>
    <div class="article-introtext"> <?php echo $this->item->introtext; ?> </div>
    <?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?>
    <a class="btn" href="<?php echo $link; ?>"><i class="icon-chevron-right"></i>
    <?php if (!$params->get('access-view')) :
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
    <?php if ($this->item->state == 0) : ?>
  </div>
  <?php endif; ?>
</div>
<?php echo $this->item->event->afterDisplayContent; ?>