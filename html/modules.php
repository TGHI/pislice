<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */
 
// Standard module

function modChrome_pi_default($module, &$params, &$attribs){
	
  $moduleArray = array();

  if (isset( $attribs['shadows'] )){
    array_push($moduleArray, "folded-shadow");
  }
  if ($params->get('moduleclass_sfx')){
    array_push($moduleArray, htmlspecialchars($params->get('moduleclass_sfx')));
  }
  
  $moduleClasses = implode(" ", $moduleArray);
  
?>
<?php if (!empty ($module->content)):?>
<<?php echo htmlspecialchars($params->get('module_tag')); ?> class="moduletable span<?php echo htmlspecialchars($params->get('bootstrap_size')); ?> <?php echo $moduleClasses; ?>">
<?php if($module->showtitle): ?>
<<?php echo htmlspecialchars($params->get('header_tag')); ?> class="moduletitle <?php echo htmlspecialchars($params->get('header_class')); ?>"><?php echo $module->title; ?></<?php echo htmlspecialchars($params->get('header_tag')); ?>>
  <?php echo $module->content; ?>
<?php endif; ?>
</<?php echo htmlspecialchars($params->get('module_tag')); ?>>
<?php endif; ?>
<?php 
}