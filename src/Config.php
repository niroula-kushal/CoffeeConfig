<?php
namespace Coffee\Config;

use Coffee\Config\Exception\{
	InvalidConfigPathException,
	LeafNodeException
};

class Config implements \Iterator
{

	private $config;

	public function __construct($config)
	{
		$this->config = $config;
	}

	public function get($configName) : self
	{
		if($this->isLeaf()) throw new LeafNodeException($this);
		return $this->getConfig($configName);
	}

	private function getConfig($configName) : self
	{
		$parts = explode('/', $configName);
		$config = $this->config;
		foreach ($parts as $part) {
			if(!isset($config[$part])) throw new InvalidConfigPathException($this, $configName);
			$config = $config[$part];
		}
		return new self($config);
	}

	public function getValue()
	{
		return $this->config;
	}

	public function isLeaf() 
	{
		return !is_array($this->config);
	}

	public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return new self($this->config[$this->position]);
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->config[$this->position]);
    }

}
