<?php defined('_JEXEC') or die;
/**
* piSlice - The simple, responsive template for Joomla! 3.0+
*
* @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
* @license     GNU General Public License version 3 or later; see LICENCE.txt
*/
?>
<div class="categories-module">
  <button class="btn btn-navbar" data-target=".categories-list" data-toggle="collapse" type="button" style="width:100%"> Click to view category list </button>
    <ul class="categories-list collapse <?php echo $moduleclass_sfx; ?>">
      <?php require JModuleHelper::getLayoutPath('mod_articles_categories', $params->get('layout', 'default').'_items'); ?>
    </ul>
</div>