<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */
 
if ($option == "com_content"){
  $open_graph_meta = array(
    "og:title" => $this->title,
	"og:type"  => $view,
	"og:url"   => key($doc->_links)
	);
}