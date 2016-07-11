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
 * Utility class for Frontend frameworks.
 *
 * @since  3.0
 */
abstract class JUiFramework
{
	/**
	 * @var array
	 */
	protected static $customCreators = array();

	/**
	 * @var array
	 */
	protected static $frameworks = array();

	/**
	 * @var null|string
	 */
	protected static $defaultFramework = null;

	/**
	 * @param null|string $name
	 *
	 * @return mixed
	 */
	public static function framework($name = null)
	{
		$name = $name ?: self::getDefaultFramework();

		return isset(static::$frameworks[$name])
			? self::$frameworks[$name]
			: self::$frameworks[$name] = self::resolve($name);
	}

	/**
	 * Register a custom framework closure
	 *
	 * @param      $name
	 * @param      $callback
	 * @param bool $setDefault
	 */
	public static function register($name, $callback, $setDefault = false)
	{
		self::$customCreators[$name] = $callback;

		if($setDefault) {
			self::setDefaultFramework($name);
		}
	}

	public static function shouldUse($name) {

	}

	public static function setDefaultFramework($name) {
		var_dump(self::$defaultFramework);
	}

	/**
	 * @param $name
	 *
	 * @return JHtmlFrameworkInterface
	 */
	protected static function resolve($name)
	{
		if (isset(self::$customCreators[$name]))
		{
			return self::callCustomCreator($name);
		}

		$createMethod = 'create' . ucfirst($name) . 'Framework';
		if (method_exists(get_called_class(), $createMethod))
		{
			return self::$createMethod();
		}

		throw new InvalidArgumentException('Framework not defined: ' . $name);
	}

	/**
	 * Call the custom framework creator
	 *
	 * @param $name
	 *
	 * @return mixed
	 */
	protected static function callCustomCreator($name)
	{
		$creatorCallback = self::$customCreators[$name];

		return $creatorCallback();
	}

	/**
	 * Create the bootstrap 2 framework
	 *
	 * @return JHtmlFrameworkInterface
	 */
	protected static function createBs2Framework()
	{
		return new JUiFrameworkBootstrap2();
	}

	/**
	 * Create the bootstrap 3 framework
	 *
	 * @return JHtmlFrameworkInterface
	 */
	protected static function createBs3Framework()
	{
		return new JUiFrameworkBootstrap3;
	}

	/**
	 * Get the default framework
	 *
	 * @return string
	 */
	protected static function getDefaultFramework()
	{
		return JApplicationHelper::getActiveFramework();
	}

	/**
	 * Dynamically call the framework method
	 *
	 * @param $method
	 * @param $parameters
	 *
	 * @return mixed
	 */
	public static function __callStatic($method, $parameters)
	{
		$framework = self::framework();

		// Check if the framework instance implements JHtmlFrameworkInterface
		if (!$framework instanceof JUiFrameworkInterface)
		{
			throw new RuntimeException(get_class($framework) . ' must implement JUiFrameworkInterface.');
		}

		// Check if the method exists
		if (!method_exists($framework, $method))
		{
			throw new InvalidArgumentException('Method ' . get_class($framework) . '::' . $method . ' does not exist.');
		}

		return call_user_func_array(array($framework, $method), $parameters);
	}
}