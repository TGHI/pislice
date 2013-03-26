<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

$header_tag = $params->get('header_tag');
$module_tag = $params->get('module_tag');

?>
<?php if($module->showtitle == 1): ?>
<<?php echo $header_tag;?> class="moduletitle"><?php echo $module->title; ?></<?php echo $header_tag;?>>
<?php endif; ?>
<<?php echo $module_tag; ?> class="custom<?php echo $moduleclass_sfx; ?>" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage');?>)"<?php endif;?>>
	<?php echo $module->content;?>
</<?php echo $module_tag; ?>>