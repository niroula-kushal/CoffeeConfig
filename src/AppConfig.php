<?php
namespace Coffee\Config;

class AppConfig
{
	private static $_instance = null;

	private static $configInstance = null;

	private function __construct() { }

	public static function getInstance()
	{
		if(self::$_instance === null) self::$_instance = new self();
		return self::$_instance;
	}

	public static function setAppConfig($configData)
	{
		self::$configInstance = new Config($configData);
		return self::$configInstance;
	}

	public static function getAppConfig(): Config
	{
		if(!self::hasAppConfigSet())
		{
			throw new AppConfigNotSetException();
		}
		return self::$configInstance;
	}

	private static function hasAppConfigSet()
	{
		return self::$configInstance !== null;
	} 

	public static function get($key)
	{
		if(!self::hasAppConfigSet())
		{
			throw new AppConfigNotSetException();
		}
		return self::getAppConfig()->get($key);
	}

}