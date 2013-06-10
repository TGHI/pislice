<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

?>
<div class="tags pull-left">
  <?php if (!empty($displayData)){
          JLoader::register('TagsHelperRoute', JPATH_BASE.'/components/com_tags/helpers/route.php');
          $x = 0;
          foreach ($displayData as $i=>$tag){
            if (in_array($tag->access, JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id')))){
              echo '<span class="tag-' . $tag->tag_id . ' tag-list' . $i . ' "><a href="' . JRoute::_(TagsHelperRoute::getTagRoute($tag->tag_id)).'" >' . $this->escape($tag->title) . '</a></span>';
              if ($x !== count($displayData) - 1){
                echo ",&nbsp;";
              }
            }
            $x++;
          }
        } ?>
</div>
