<?php
namespace Coffee\Config\Exception;

class AppConfigNotSetException extends \DomainException
{
	public function __construct($message = 'App Config not set')
	{
		parent::__construct($message);
	}
}