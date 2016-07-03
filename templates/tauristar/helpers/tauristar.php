<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.tauristar
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die();

/**
 * Helper class for Tauristar template.
 *
 * @since  3.8
 */
class TauristarHelper
{

	/**
	 * Compiles the template.less file.
	 *
	 * @return   void
	 */
	public static function compile()
	{
		JLoader::import('joomla.filesystem.folder');
		JLoader::import('joomla.filesystem.file');
		try
		{
			JLoader::import('lessphp.Less', JPATH_THEMES . '/tauristar/helpers');
			$parser = new Less_Parser(
				array(
					'relativeUrls' => false
				)
			);

			// Setting the directorys of joomla bootsrap path
			$parser->SetImportDirs(
					array(
					JPATH_ROOT . '/media/jui/bs3/' => '../../../media/jui/bs3/'
				)
			);
			$parser->parseFile(JPATH_THEMES . '/tauristar/less/template.less', JUri::base());
			$css = $parser->getCss();

			// Writting the css content to the cache file
			JFile::write(JPATH_THEMES . '/tauristar/css/template.css', $css);
		}
		catch (Exception $e)
		{
			JFactory::getApplication()->enqueueMessage($e->getMessage());
		}
	}
}
