<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

$app = JFactory::getApplication();
$params = $app->getTemplate(true)->params;

$errorCode	= $this->API->error->getCode();

?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->API->language; ?>" lang="<?php echo $this->API->language; ?>" dir="<?php echo $this->API->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $this->API->error->getCode(); ?> - <?php echo $this->API->error->getMessage(); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->templateURL(); ?>/css/template.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->templateURL(); ?>/css/elusive-webfont.css" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=<?php echo $params->get('MAIN_FONT'); ?>" type="text/css" />
  <style type="text/css">
    <?php echo $this->styles->css; ?>
	h1,h2{margin:0;text-shadow:1px 1px 0 rgba(255,255,255,<?php echo $params->get('3D_LIGHT_HIGHLIGHT_OPACITY'); ?>)}
	h1{font-size:200pt}
	h2{margin-bottom:20px;font-weight:300}
    body{padding: 70px 0 0;margin:0}
    body,input{font-family:"Open Sans",sans-serif}
	.center{margin:0 auto !important;text-align:center}
	.search{width:400px;margin:0 auto;padding:10px}
  </style> 
</head>
<body>
  <div class="center">
    <h1><?php echo $this->API->error->getCode(); ?> :(</h1>
    <h2><?php echo $this->API->error->getMessage(); ?></h2>
    <div class="search">
      <?php $this->searchmodules = JModuleHelper::getModules('search');
			foreach ($this->searchmodules as $searchmodule) {
				$output = JModuleHelper::renderModule($searchmodule, array('style' => 'none'));
				$params = new JRegistry;
				$params->loadString($searchmodule->params);
				echo $output;
			}?>
    </div>
   <p><a class="btn" href="<?php echo $this->basePath(); ?>"><i class="icon-home"></i> Return Home</a></p>
  </div>
  <script type="text/javascript">
	var input=document.getElementById("mod-finder-searchword"),value="Find something else?";input.value=value;input.onfocus=function(){if(this.value==value)return this.value=""};input.onblur=function(){if(""==this.value)return this.value=value};
  </script>
</body>
</html>