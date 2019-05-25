<?php
/**
 * mod_xtrmexample.php, build date : 24 May. 2019
 * Joomla Module Xtrm ToTop main script.
 * php version 7.2.10
 *
 * @version    4.0.00.00.1441736
 * @category   XtrmAddons
 * @package    Joomla
 * @subpackage mod_xtrmtotop
 * @author     shim-sao <contact@xtrmaddons.com>
 * @copyright  Copyright 2015-2019 XtrmAddons.com. All rights reserved.
 * @license    https://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 * @link       https://www.xtrmaddons.com/
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
