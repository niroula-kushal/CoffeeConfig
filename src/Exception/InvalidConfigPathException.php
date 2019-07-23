<?php
namespace Coffee\Config\Exception;

use Coffee\Config\Config;

class InvalidConfigPathException extends \DomainException
{

	private $config;
	private $path;

	public function __construct(Config $config, $path, $message = 'Invalid Config Path')
	{
		parent::__construct($message);
		$this->config = $config;
		$this->path   = $path;
	}

	public function getConfig() : Config
	{
		return $this->config;
	}

	public function getPath()
	{
		return $path;
	}

}