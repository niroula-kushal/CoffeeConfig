<?php
namespace Coffee\Config\Exception;

use Coffee\Config\Config;

class LeafNodeException extends \DomainException
{

	private $config;

	public function __construct(Config $config, $message = 'Leaf node')
	{
		parent::__construct($message);
		$this->config = $config;
	}

	public function getConfig($config) : Config
	{
		return $this->config;
	}

}