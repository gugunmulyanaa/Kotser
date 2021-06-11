<?php

use PoTemplate\Engine;
use PoTemplate\Extension\ExtensionInterface;

class Runningtext implements ExtensionInterface
{

	public function __construct()
	{
		$this->core = new PoCore();
	}

	public function register(Engine $templates)
	{
		$templates->registerFunction('runningtext', [$this, 'getObject']);
	}

	public function getObject()
	{
		return $this;
	}

	public function getAllRunning($order = 'id ASC', $limit)
	{
		$runningtext = $this->core->podb->from('runningtext')->orderBy($order)->limit($limit)->fetchAll();
		return $runningtext;
	}
}
