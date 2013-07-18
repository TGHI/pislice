<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

?>
<ul class="pager clearfix">
<?php if ($row->prev) : ?>
  <li><a href="<?php echo $row->prev; ?>" rel="prev"><i class="icon-backward"></i> <?php echo JText::_('TPL_PISLICE_PREV_ARTICLE'); ?></a></li>
<?php else: ?>
  <li><a class="disabled" rel="prev"><i class="icon-backward"></i> <?php echo JText::_('TPL_PISLICE_PREV_ARTICLE'); ?></a></li>
<?php endif; ?>
<?php if ($row->next) : ?>
  <li><a class="next" href="<?php echo $row->next; ?>" rel="next"><?php echo JText::_('TPL_PISLICE_NEXT_ARTICLE'); ?> <i class="icon-forward"></i></a> </li>
<?php else: ?>
  <li><a class="disabled"><?php echo JText::_('TPL_PISLICE_NEXT_ARTICLE'); ?><i class="icon-forward"></i></a></li>
<?php endif; ?>
</ul>