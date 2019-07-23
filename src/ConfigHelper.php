<?php
namespace Coffee\Config;

use Coffee\Config\Exception\LeafNodeException;

class ConfigHelper
{
	public function add(Config $config, $key, $value)
	{
		if($config->isLeaf()) throw new LeafNodeException($config);
		$mergedConfig = array_merge($config->getValue(), [
			$key => $value
		]);
		return new Config($mergedConfig);
	}

	public function merge(Config $configOne, Config $configTwo)
	{
		if($configOne->isLeaf()) throw new LeafNodeException($configOne);
		if($configTwo->isLeaf()) throw new LeafNodeException($configTwo);

		$mergedConfig = array_merge($configOne->getValue(), $configTwo->getValue());

		return new Config($mergedConfig);

	}
}