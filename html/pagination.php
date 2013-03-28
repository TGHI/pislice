<?php defined('_JEXEC') or die;
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

function pagination_list_footer($list)
{
	$html = "<div class=\"pagination\">\n";
	$html .= $list['pageslinks'];
	$html .= "\n<input type=\"hidden\" name=\"" . $list['prefix'] . "limitstart\" value=\"" . $list['limitstart'] . "\" />";
	$html .= "\n</div>";

	return $html;
}

/**
 * Renders the pagination list
 *
 * @param   array  $list  Array containing pagination information
 *
 * @return  string  HTML markup for the full pagination object
 *
 * @since   3.0
 */
function pagination_list_render($list)
{
	// Calculate to display range of pages
	$currentPage = 1;
	$range = 1;
	$step = 5;
	foreach ($list['pages'] as $k => $page)
	{
		if (!$page['active'])
		{
			$currentPage = $k;
		}
	}
	if ($currentPage >= $step)
	{
		if ($currentPage % $step == 0)
		{
			$range = ceil($currentPage / $step) + 1;
		}
		else
		{
			$range = ceil($currentPage / $step);
		}
	}

	$html = '<ul class="pagination-list row-fluid">';
	$html .= $list['start']['data'];
	$html .= $list['previous']['data'];

	foreach($list['pages'] as $k => $page)
	{
		if (in_array($k, range($range * $step - ($step + 1), $range * $step)))
		{
			if (($k % $step == 0 || $k == $range * $step - ($step + 1)) && $k != $currentPage && $k != $range * $step - $step)
			{
				$page['data'] = preg_replace('#(<a.*?>).*?(</a>)#', '$1...$2', $page['data']);
			}
		}

		$html .= $page['data'];
	}

	// swapped these around because of floats. Yuck, I know.

	$html .= $list['end']['data'];
	$html .= $list['next']['data'];

	$html .= '</ul>';
	return $html;
}


function pagination_item_active(&$item){

  // put round dots only under numeric items

  if ($item->text == JText::_('JLIB_HTML_START')){
	  
	return '<li class="start span1"><span class="icon-fast-backward"></span><a title="' . $item->text . '" href="' . $item->link . '" class="pagenav">' . $item->text . '</a></li>';
	
  }elseif($item->text == JText::_('JPREV')){
	  
	return '<li class="prev span1"><span class="icon-backward"></span><a title="' . $item->text . '" href="' . $item->link . '" class="pagenav">' . $item->text . '</a></li>';
	  
  }elseif($item->text == JText::_('JNEXT')){
	  
    return '<li class="next span1"><a title="' . $item->text . '" href="' . $item->link . '" class="pagenav">' . $item->text . '</a><span class="icon-forward"></span></li>';
	  
  }elseif($item->text == JText::_('JLIB_HTML_END')){
	  
    return '<li class="end span1"><a title="' . $item->text . '" href="' . $item->link . '" class="pagenav">' . $item->text . '</a><span class="icon-fast-forward"></span></li>';
	  
  }else{
	  
    return '<li class="pagenumber span1 small"><a title="' . $item->text . '" href="' . $item->link . '" class="round empty"><div class="round"></div></a>' . $item->text . '</li>';
	
  }
}

function pagination_item_inactive(&$item){
	// Check for "Start" item
	if ($item->text == JText::_('JLIB_HTML_START'))
	{
		return '<li class="start disabled span1"><span class="icon-fast-backward"></span><a>'.JText::_('JLIB_HTML_START').'</a></li>';
	}

	// Check for "Prev" item
	if ($item->text == JText::_('JPREV'))
	{
		return '<li class="prev disabled span1"><span class="icon-backward"></span><a>'.JText::_('JPREV').'</a></li>';
	}

	// Check for "Next" item
	if ($item->text == JText::_('JNEXT'))
	{
		return '<li class="next disabled span1"><a>'.JText::_('JNEXT').'</a><span class="icon-forward"></span></li>';
	}

	// Check for "End" item
	if ($item->text == JText::_('JLIB_HTML_END'))
	{
		return '<li class="end disabled span1"><a>'.JText::_('JLIB_HTML_END').'</a><span class="icon-fast-forward"></span></li>';
	}

	// Check if the item is the active page
	if (isset($item->active) && ($item->active))
	{
		return '<li class="pagenumber active small span1"><div class="round empty"><div class="round filled" title='. $item->text .'></div></div>' . $item->text . '</li>';
	}

	// Doesn't match any other condition, render a normal item
	return '<li class="disabled span1"><a>' . $item->text . '</a></li>';
}