 <?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

// Get template params
$tpl_param_generator = $this->params->get('generator');

// Add Stylesheets

if ($tpl_param_generator == 0) {
    $doc->_generator = "";
}

?> 