<?php defined('_JEXEC') or die;
/**
* piSlice - The simple, responsive template for Joomla! 3.0+
*
* @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
* @license     GNU General Public License version 3 or later; see LICENCE.txt
*/

//show all php errors

ini_set('error_reporting', E_ALL);
ini_set('display_errors','On');

if (!defined('DS'))
{
	define('DS', DIRECTORY_SEPARATOR);
}

require_once(dirname(__file__) . DS . 'framework' . DS . 'meta.php');
require_once(dirname(__file__) . DS . 'framework' . DS . 'fonts.php');
require_once(dirname(__file__) . DS . 'framework' . DS . 'styles.php');

class piSlice{

    public $API;

	function __construct($parentTpl)
	{
        // access jdochtml object
		$this->API = $parentTpl;

		$this->getConfig();

		$this->styles =	new piStyle($this);
		$this->meta = new piMeta($this);
		$this->fonts = new piFonts($this); 

	}

	public function render($layout)
	{
		jimport('joomla.filesystem.file');

		if(JFile::exists($this->templatePath() . DS . 'layouts' . DS . $layout . '.php'))
		{
			include($this->templatePath() . DS . 'layouts' . DS . $layout . '.php');
		}
		else
		{	

			JError::raiseError(500,JText::sprintf('TPL_PISLICE_ERROR_LAYOUT_NOT_FOUND', $layout),$info=null);

		}
	}

	public function getConfig()
	{
		$app = JFactory::getApplication();
		$params = $app->getTemplate(true)->params;
		$template_params  = (array)json_decode($params);

		if (empty($template_params))
		{

			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$template = $this->API->template;

			$config = file_get_contents($this->templatePath() . DS . 'config' . DS . 'default.config.json');

			$db->setQuery("UPDATE #__template_styles SET params = '$config' WHERE template = '$template' LIMIT 1");
			$result = $db->query();

			foreach(json_decode($config) as $param=>$value)
			{
				$this->API->params->set($param,$value);
			}
		}
	}

	public function basePath()
	{
		return JURI::base();
	}

	public function templateURL()
	{
		return $this->basePath() . "templates/" . $this->API->template;
	}

	public function sitePath()
	{
		return JPATH_SITE;
	}

	public function templatePath()
	{
		return $this->sitePath() . DS . "templates" . DS . $this->API->template;
	}

}