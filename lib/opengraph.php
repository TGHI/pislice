<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

$metaArray = array();

if ($option == "com_content"){

  $metaArray["og:title"]       = $doc->title;
  $metaArray["og:description"] = $doc->description;
  $metaArray["og:type"]        = $view;
  $metaArray["og:url"]         = key($doc->_links);

  if ($view == "category"){
    $category = JRequest::getVar('id');
  }else{
	$category = JRequest::getVar('catid'); 
  }

  $db = JFactory::getDbo();
  $query = $db->getQuery(true);
  $query->select ('alias');
  $query->from('#__categories');
  $query->where("id='$category'");
  
  $db->setQuery($query);
  $results = $db->loadObjectList();

  $metaArray["og:section"] = $results[0]->alias;

  if ($view == "article"){

    $ids = explode(':',JRequest::getString('id'));
    $article_id = $ids[0];
    $article = JTable::getInstance("content");
    $article->load($article_id);

    $images = json_decode($article->images);
    $author = JFactory::getUser($article->created_by);

    $metaArray["og:image"]  = $base_url . $images->image_intro;
    $metaArray["og:author"] = $author->name;
    $metaArray["article:published_time"] = $article->publish_up;
  }
}