<?php defined('_JEXEC') or die;
/**
* piSlice - The simple, responsive template for Joomla! 3.0+
*
* @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
* @license     GNU General Public License version 3 or later; see LICENCE.txt
*/

class piMeta{
    
    public $API;
    
    function __construct($parent)
    {
        
        $this->API = $parent->API;
        
        $this->setGenerator();
        $this->meta = $this->setTags();
		$this->generator = $this->setGenerator();
        
    }
    
    public function setTags(){
        
        if ($this->API->params->get('opengraph')) {
            
            $app = JFactory::getApplication();
            $option = JRequest::getCmd('option');
            $view = $app->input->getCmd('view', '');
            
            if ($option == "com_content") {
                
                $this->meta["og:title"]       = $this->API->title;
                $this->meta["og:type"]        = $view;
                $this->meta["og:url"]         = key($this->API->_links);
                
                if ($view == "category") {
                    
                    $category = JRequest::getVar('id');
                    $this->meta["og:section"] = $this->getCategoryName($category);
                    
                }
                
                if ($view == "article") {
                    
                    $ids = explode(':',JRequest::getString('id'));
                    $article_id = $ids[0];
                    $article = JTable::getInstance("content");
                    $article->load($article_id);
                    
                    $images = json_decode($article->images);
                    $author = JFactory::getUser($article->created_by);
                    
                    $this->meta["og:description"] = $this->API->description;
                    $this->meta["og:section"] = $this->getCategoryName($article->catid);
                    $this->meta["og:image"]  = JURI::base() . $images->image_intro;
                    $this->meta["og:author"] = $author->name;
                    $this->meta["article:published_time"] = $article->publish_up;
                    
                }
                
                $this->meta["fb:app_id"] = $this->API->params->get('facebookAppId');
                
                foreach($this->meta as $metaName=>$metaValue){
                    $this->API->addCustomTag('  <meta property="' . $metaName . '" content="' . $metaValue . '" />');
                }
            }
        }
    }
    
    public function setGenerator(){
        
        if (! $this->API->params->get('generator')) {
            $this->API->_generator = "";
        }
    }
    
    private function getCategoryName($id){
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('alias');
        $query->from('#__categories');
        $query->where("id='$id'");
        
        $db->setQuery($query);
        $db->loadObjectList();
        return $db->loadObjectList()[0]->alias;
        
    }
}
