<?php
/**
 * script.php, build date : {{creation_date}}
 * Joomla Module Xtrm ToTop installation script.
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
defined('_JEXEC') or die;



/**
 * Script file of XtrmAddons component.
 *
 * @category   	{{category}}
 * @package    	{{framework}}
 * @subpackage 	{{element}}
 * @author     	{{author}} <{{author_email}}>
 * @copyright  	{{copyright}}
 * @license    	{{license_link}}
 * @version    	{{version_build}}
 * @link       	{{packager_url}}
 *
 * @access     	public
 * @since 			3.1.01.00.151014
 */
class Mod_XtrmToTopInstallerScript
{
	/**
	 * Method to install the component.
	 *
	 * @param   Joomla\CMS\Installer\Adapter\ModuleAdapter $parent The class that calling this method.
	 *
	 * @access	public
	 * @since 	3.1.01.00.151014
	 * @version {{version_build}}
	 *
	 * @return 	void
	 */
	public function install($parent)
	{
		echo '<p>' . JText::_('MOD_XTRMTOTOP_INSTALL_SUCCESS') . '</p>';
	}

	/**
	 * Method to uninstall the component.
	 *
	 * @param 	Joomla\CMS\Installer\Adapter\ModuleAdapter $parent	is the class calling this method.
	 *
	 * @access	public
	 * @since 	3.1.01.00.151014
	 * @version {{version_build}}
	 *
	 * @return void
	 */
	public function uninstall($parent)
	{
		echo '<p>' . JText::_('MOD_XTRMTOTOP_UNINSTALL_SUCCESS') . '</p>';
	}

	/**
	 * Method to update the component.
	 *
	 * @param 	Joomla\CMS\Installer\Adapter\ModuleAdapter $parent is the class calling this method.
	 *
	 * @access	public
	 * @since 	3.1.01.00.151014
	 * @version {{version_build}}
	 *
	 * @return 	void
	 */
	public function update($parent)
	{
		$this->cleanUpdatesSites();
		echo '<p>' . JText::sprintf('MOD_XTRMTOTOP_UPDATE_SUCCESS', $parent->get('manifest')->version) . '</p>';
	}

	/**
	 * Method run after an install/update/uninstall method.
	 *
	 * @param 	string 																			$type 	is the type of change (install, update or discover_install)
	 * @param 	Joomla\CMS\Installer\Adapter\ModuleAdapter 	$parent is the class calling this method
	 *
	 * @access	public
	 * @since 	3.1.01.00.151014
	 * @version {{version_build}}
	 *
	 * @return 	void
	 */
	public function postflight($type, $parent)
	{
		$this->copyright($parent);
	}

	/**
	 * Method to display copyright informations.
	 *
	 * @param 	Joomla\CMS\Installer\Adapter\ModuleAdapter 	$parent is the class calling this method
	 *
	 * @access	public
	 * @since 	4.0.00.00
	 * @version {{version_build}}
	 *
	 * @return 	void
	 */
	public function copyright($parent)
	{
		// Explode license assuming: link name
		$license = explode(' ', (string) $parent->getManifest()->license);

		// Displays copyright
		echo '<p class="text-center">'
			. 'Author: ' . (string) $parent->getManifest()->author
			. ' - Version:' . (string) $parent->getManifest()->version
			. ' - License: <a target="_blank" href="' . $license[0] . '">'
			. (empty($license[0]) ? '' : pathinfo($license[0], PATHINFO_FILENAME))
			. (empty($license[0]) || empty($license[1]) ? '' : ' ')
			. (empty($license[1]) ? '' : $license[1])
			. '</a>'
			. '<br />'
			. (string) $parent->getManifest()->copyright
			. '</p>';
	}

	/**
	 * Method to clean updates site list.
	 *
	 * @access	public
	 * @since 	3.1.01.00.151014
	 * @version {{version_build}}
	 *
	 * @return 	void
	 */
	public function cleanUpdatesSites()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);

		$query->select($db->q('update_site_id'))
			->from($db->qn('#__update_sites'))
			->where($db->qn('location') . ' LIKE ' . $db->q('%' . $this->element . '%'))
			->order('update_site_id DESC');

		$id    = $db->setQuery($query)->loadResult();
		$query = $db->getQuery(true);

		$query->delete($db->qn('#__update_sites'))
			->where($db->qn('location') . ' LIKE ' . $db->q('%' . $this->element . '%'))
			->where($db->qn('update_site_id') . ' != ' . $db->q($id));

		$db->setQuery($query)->execute();
	}
}
