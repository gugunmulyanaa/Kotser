<?php
use PoTemplate\Engine;
use PoTemplate\Extension\ExtensionInterface;

class Infografis implements ExtensionInterface
{

	public function __construct()
	{
		$this->core = new PoCore();
	}

	public function register(Engine $templates)
	{
		$templates->registerFunction('infografis', [$this, 'getObject']);
	}

	public function getObject()
	{
		return $this;
	}

	public function getAllInfografis($order = 'id ASC', $limit)
	{
		$infografis = $this->core->podb->from('infografis')->orderBy($order)->limit($limit)->fetchAll();
		return $infografis;
	}
}
