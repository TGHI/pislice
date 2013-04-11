<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

 $app = JFactory::getApplication();
 $option	= $app->input->getCmd('option', '');
 $searchword	= $app->input->getCmd('searchword', '');

?>
<div class="breadcrumbs<?php echo $moduleclass_sfx; ?>">
<?php if ($params->get('showHere', 1))
	{
		//echo '<span class="showHere">' .JText::_('MOD_BREADCRUMBS_HERE').'</span>';
		echo '<span class="icon-map-marker"></span>';
	}
?>
<?php for ($i = 0; $i < $count; $i ++) :
	// Workaround for duplicate Home when using multilanguage
	if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link == $list[$i - 1]->link) {
		continue;
	}
	// If not the last item in the breadcrumbs add the separator
		
	if ($i < $count - 1)
	{
		if (!empty($list[$i]->link)) {
			echo '<a href="'.$list[$i]->link.'" class="pathway">'.$list[$i]->name.'</a>';
		} else {
			echo '<span>';
			echo $list[$i]->name;
			echo '</span>';
		}
		if ($i < $count - 2)
		{
			echo ' <span class="icon-chevron-right"></span> ';
		}
	}  elseif ($params->get('showLast', 1)) { // when $i == $count -1 and 'showLast' is true
		if ($i > 0)
		{
			echo ' <span class="icon-chevron-right"></span> ';
		}
		echo '<span>';
		// if we're in finder/search, safe to assume this is a search result
		if ($option == "com_finder" || $option == "com_search"){
			if(!empty($searchword)){
				$query = $searchword;
			}else{
				$query = $list[$i]->name;
			}
			echo JText::sprintf('TPL_PISLICE_SEARCH_RESULTS_FOR',$query);
		}else{
		echo $list[$i]->name;
		}
		echo '</span>';
	}
endfor; ?>
</div>
