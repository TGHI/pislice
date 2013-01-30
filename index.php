<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

//Some handy variables
$app				= JFactory::getApplication();
$doc				= JFactory::getDocument();
$this->language		= $doc->language;
$this->direction	= $doc->direction;
$user				= JFactory::getUser();
$option				= $app->input->getCmd('option', '');
$view				= $app->input->getCmd('view', '');
$layout				= $app->input->getCmd('layout', '');
$task				= $app->input->getCmd('task', '');
$itemid				= $app->input->getCmd('Itemid', '');
$sitename			= $app->getCfg('sitename');

// Get template params
$tpl_param_generator= $this->params->get('generator');
$tpl_param_jquery	= $this->params->get('jquery');
$tpl_param_framework= $this->params->get('framework');

// Add Stylesheets
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/bootstrap-responsive.min.css');
$doc->addStyleSheet('http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic|Open+Sans:400,300,700,300italic,400italic');

// Javascript Resources
if ($tpl_param_framework == 1){
	JHtml::_('behavior.framework', true);
}else{
	if ($layout !== 'edit'){
		$s = array('mootools','caption','core');
		foreach($this->_scripts as $k => $v) {
			foreach($s as $f) {
				if(stristr($k, $f) !== false) {
					unset($this->_scripts[$k]);
				}
			}
		}
	}
	$this->_script = preg_replace('%window\.addEvent\(\'load\',\s*function\(\)\s*{\s*new\s*JCaption\(\'img.caption\'\);\s*}\);\s*%', '', $this->_script);
	$this->_script = preg_replace('%window\.addEvent\(\'domready\',\s*function\(\)\s*{\s*\$\$\(\'.hasTip\'\).each\(function\(el\)\s*{\s*var\s*title\s*=\s*el.get\(\'title\'\);\s*if\s*\(title\)\s*{\s*var\s*parts\s*=\s*title.split\(\'::\',\s*2\);\s*el.store\(\'tip:title\',\s*parts\[0\]\);\s*el.store\(\'tip:text\',\s*parts\[1\]\);\s*}\s*}\);\s*var\s*JTooltips\s*=\s*new\s*Tips\(\$\$\(\'.hasTip\'\),\s*{\s*maxTitleChars:\s*50,\s*fixed:\s*false}\);\s*}\);%', '', $this->_script);
}

if ($tpl_param_jquery == "local"){
	$doc->addScript('templates/'.$this->template.'/js/lib/jquery/jquery.min.js');
}elseif ($tpl_param_jquery == "cdn"){
	$doc->addScript('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<?php if ($tpl_param_generator == 0) $doc->_generator = ""; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<jdoc:include type="head" />
</head>
<body>
<div class="container-fluid center">
  <jdoc:include type="modules" name="article-top" style="none" />
  <jdoc:include type="modules" name="article-top2" style="none" />
</div>
<div class="container-fluid center">
  <jdoc:include type="message" />
  <jdoc:include type="component" />
  <div class="span2"> test? </div>
</div>
<div class="container-fluid center">
  <jdoc:include type="modules" name="article-bottom" style="none" />
  <jdoc:include type="modules" name="debug" style="none" />
</div>
</body>
</html>