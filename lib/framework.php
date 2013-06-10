<?php defined('_JEXEC') or die;
/**
* piSlice - The simple, responsive template for Joomla! 3.0+
*
* @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
* @license     GNU General Public License version 3 or later; see LICENCE.txt
*/

define('DS', DIRECTORY_SEPARATOR);

require_once(dirname(__file__) . DS . 'framework' . DS . 'meta.php');
require_once(dirname(__file__) . DS . 'framework' . DS . 'styles.php');


class piSlice{
    
    public $API;
    
    function __construct($parentTpl)
    {
        //access template object
        $this->API = $parentTpl;
        // check if we have params set
        $this->getConfig();
        
        $this->styles = new piStyle($this);
        $this->meta = new piMeta($this);
        
    }
    
    public function getConfig()
    {
        
        $template_params  = (array)json_decode($this->API->params);
        
        if (empty($template_params)) {
            
            $db     = JFactory::getDBO();
            $query  = $db->getQuery(true);
            $template = $this->API->template;
            
            jimport('joomla.filesystem.file');
            
            $config = file_get_contents($this->templatePath() . DS . 'config' . DS . 'default.config.json');
            
            $db->setQuery("UPDATE #__template_styles SET params = '$config' WHERE template = '$template' LIMIT 1");
            $result = $db->query();
            
            foreach(json_decode($config) as $param=>$value){
                $this->API->params->set($param,$value);
            }
        }
    }
    
    public function templateURL() {
        return JURI::base() . "templates/" . $this->API->template;
    }
    
    public function sitePath() {
        return JPATH_SITE;
    }
    
    public function templatePath() {
        return $this->sitePath() . DS . "templates" . DS . $this->API->template;
    }
    
}
