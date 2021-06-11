<?php
use PoTemplate\Engine;
use PoTemplate\Extension\ExtensionInterface;

class dokumen implements ExtensionInterface
{
	public function __construct()
	{
		$this->core = new PoCore();
	}

	public function register(Engine $templates)
	{
		$templates->registerFunction('dokumen', [$this, 'getObject']);
	}

	public function getObject()
	{
		return $this;
	}

	public function getdokumen($order = 'id DESC', $limit)
	{
		$dokumen = $this->core->podb->from('dokumen')->orderBy($order)->limit($limit)->fetchAll();
		return $dokumen;
	}
}
