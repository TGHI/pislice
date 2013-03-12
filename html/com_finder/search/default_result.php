<?php defined('_JEXEC') or die;
/**
 * piSlice - The simple, responsive template for Joomla! 3.0+
 *
 * @copyright   Copyright (C) 2013 Justin Renaud (tghidsgn@gmail.com)
 * @license     GNU General Public License version 3 or later; see LICENCE.txt
 */

// Get the mime type class.
$mime = !empty($this->result->mime) ? 'mime-' . $this->result->mime : null;

// Get the base url.
$base = JURI::getInstance()->toString(array('scheme', 'host', 'port'));

// Get the route with highlighting information.
if (!empty($this->query->highlight) && empty($this->result->mime) && $this->params->get('highlight_terms', 1) && JPluginHelper::isEnabled('system', 'highlight'))
{
	$route = $this->result->route . '&highlight=' . base64_encode(json_encode($this->query->highlight));
} else {
	$route = $this->result->route;
}
?>

<li>
	<h2 class="result-title serif <?php echo $mime; ?>"><a href="<?php echo JRoute::_($route); ?>"><?php echo $this->result->title; ?></a></h4>
	<?php if ($this->params->get('show_description', 1)) : ?>
	<p class="result-text<?php echo $this->pageclass_sfx; ?>">
		<?php echo JHtml::_('string.truncate', $this->result->description, $this->params->get('description_length', 255)); ?>
	</p>
	<?php endif; ?>
	<?php if ($this->params->get('show_url', 1)) : ?>
	<small class="small grey result-url<?php echo $this->pageclass_sfx; ?>"><?php echo $base . JRoute::_($this->result->route); ?></small>
	<?php endif; ?>
</li>
