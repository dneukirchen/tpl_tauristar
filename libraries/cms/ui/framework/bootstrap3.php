<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  HTML
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Utility class for the Bootstrap 3 frontend framework
 *
 * @since  3.0
 */
class JUiFrameworkBootstrap3 implements JUiFrameworkInterface
{
	public function assets()
	{
		$this->styles();
		$this->scripts();
	}

	public function styles()
	{
		var_dump('scripts');
	}

	public function scripts()
	{
		var_dump('styles');
	}

	public function modal()
	{
		die('hello world');
	}
}