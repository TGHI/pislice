<?php defined('_JEXEC') or die;
/**
* piSlice - The simple, responsive template for Joomla! 3.0+
*
* @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
* @license     GNU General Public License version 3 or later; see LICENCE.txt
*/

class piFonts{
	
	private $parent;
	public $API;

	function __construct($parent)
	{

		$this->API = $parent->API;
		$this->font = $this->setFonts();

	}

	public function setFonts($font=null)
	{
		
		$app = JFactory::getApplication();
		$params = $app->getTemplate(true)->params;

		$fonts = array($params->get('MAIN_FONT'), $params->get('SUB_FONT'));

		if (!empty($fonts))
		{

			return $fonts;

		}
	}
}