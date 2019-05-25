<?php
/**
 * mod_xtrmexample.php, build date : {{creation_date}}
 * Joomla Module Xtrm ToTop main script.
 * php version 7.2.10
 *
 * @version    {{version_build}}
 * @category   {{category}}
 * @package    {{framework}}
 * @subpackage {{element}}
 * @author     {{author}} <{{author_email}}>
 * @copyright  {{copyright}}
 * @license    {{license_link}}
 * @link       {{packager_url}}
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

JFactory::getDocument()->addScript(JURI::base(true) . '/media/mod_xtrmtotop/js/jquery.totop.min.js');

$p = new stdClass;
$keys = array('right', 'bottom', 'width', 'height', 'border', 'borderRadius', 'background', 'backgroundImage');

foreach ($keys as $key)
{
	$v = $params->get($key);

	if (!empty($v))
	{
		$p->$key = $v;
	}
}

$p = json_encode($p);

$script  = 'jQuery(window).on(\'load\',  function() {'
. 'var xst = new XtrmScrollTop(' . $p . ');'
. '});';

JFactory::getDocument()->addScriptDeclaration($script);
