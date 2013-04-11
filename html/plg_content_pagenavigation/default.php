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
  <li><a class="button light-3d" href="<?php echo $row->prev; ?>" rel="prev"><span class="icon-backward"></span> <?php echo JText::_('TPL_PISLICE_PREV_ARTICLE'); ?></a></li>
<?php else: ?>
  <li><a class="button light-3d disabled" href="<?php echo $row->prev; ?>" rel="prev"><span class="icon-backward"></span> <?php echo JText::_('TPL_PISLICE_PREV_ARTICLE'); ?></a></li>
<?php endif; ?>
<?php if ($row->next) : ?>
  <li><a class="button light-3d next" href="<?php echo $row->next; ?>" rel="next"><?php echo JText::_('TPL_PISLICE_NEXT_ARTICLE'); ?> <span class="icon-forward"></span></a> </li>
<?php else: ?>
  <li><a class="button light-3d disabled"><?php echo JText::_('TPL_PISLICE_NEXT_ARTICLE'); ?><span class="icon-forward"></span></a></li>
<?php endif; ?>
</ul>