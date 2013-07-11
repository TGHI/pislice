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
		$this->fonts = $this->setFonts();

	}

	public function setFonts($font=null)
	{

		$fonts = array($this->API->params->get('MAIN_FONT'), $this->API->params->get('SUB_FONT'));

		if (!empty($fonts))
		{

			$this->API->addStyleSheet('http://fonts.googleapis.com/css?family=' . implode("|", $fonts));

			for ($i = 0; $i < count($fonts); $i++)
			{
				if (strpos($fonts[$i],':'))
				{

					$fonts[$i] = substr($fonts[$i], 0, strpos($fonts[$i],':'));

                }

				$fonts[$i] = str_replace('+', ' ',$fonts[$i]);
			}

			$font .= "    select,input,body,.deeper li{font-family:\"" . $fonts[0] . "\",sans-serif}\n";
			$font .= "    .narrow,.moduletitle{font-family:\"" . $fonts[1] . "\",sans-serif;font-weight:500}\n";

			$this->API->addStyleDeclaration($font);

		}
	}
}