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

  if (isset($attribs['shadows'] )){
    $moduleArray[] = "folded-shadow";
  }
  if ($params->get('moduleclass_sfx')){
    $moduleArray[] = htmlspecialchars($params->get('moduleclass_sfx'));
  }
  
  $moduleClasses = implode(" ", $moduleArray);
  
  if($params->get('bootstrap_size') != 0){
	 $bootstrapSize = "span" . htmlspecialchars($params->get('bootstrap_size'));
  }else{
	  $bootstrapSize = "";
  }
  
?>
<?php if (!empty ($module->content)):?>
<<?php echo htmlspecialchars($params->get('module_tag')); ?> class="pi_default moduletable <?php echo $bootstrapSize; ?> <?php echo $moduleClasses; ?>">
<?php if($module->showtitle): ?>
<<?php echo htmlspecialchars($params->get('header_tag')); ?> class="moduletitle"><i class="<?php echo htmlspecialchars($params->get('header_class')); ?>"></i><?php echo $module->title; ?></<?php echo htmlspecialchars($params->get('header_tag')); ?>>
<?php endif; ?>
  <div class="module-content">
    <?php echo $module->content; ?>
  </div>
</<?php echo htmlspecialchars($params->get('module_tag')); ?>>
<?php endif; ?>
<?php 
}