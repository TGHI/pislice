<?php defined('_JEXEC') or die;
/**
* piSlice - The simple, responsive template for Joomla! 3.0+
*
* @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
* @license     GNU General Public License version 3 or later; see LICENCE.txt
*/

class piLayout{

	private $parent;
	public $API;

	function __construct($parent)
	{
		$this->parent = $parent;
		$this->API = $parent->API;
		$this->fonts = $this->doLayout();

	}

	public function doLayout()
	{
		
		$tmpl = JRequest::getCmd('tmpl', '');
		
		if($tmpl == "component")
		{
			if(JFile::exists($this->parent->templatePath() . DS . 'layouts' . DS . 'default.component.php'))
			{
				include($this->parent->templatePath() . DS . 'layouts' . DS . 'default.component.php');
			}
			
		}else{

			if(JFile::exists($this->parent->templatePath() . DS . 'layouts' . DS . 'default.blog.php'))
			{ 
				include($this->parent->templatePath() . DS . 'layouts' . DS . 'default.blog.php');
			}
	
		}
	}
}