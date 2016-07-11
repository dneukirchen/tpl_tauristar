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
 * Class CustomFrameworkExample
 */
class CustomFrameworkExample implements JHtmlFrameworkInterface
{
	public function assets()
	{
		$this->styles();
		$this->scripts();
	}

	public function styles()
	{
		// add custom framework scripts
	}

	public function scripts()
	{
		// add custom framework styles
	}

	public function helloWorld() {
		return 'Hello World';
	}
}