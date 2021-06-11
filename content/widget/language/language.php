<?php
use PoTemplate\Engine;
use PoTemplate\Extension\ExtensionInterface;

class Language implements ExtensionInterface
{
	public function __construct()
	{
		$this->core = new PoCore();
	}

	public function register(Engine $templates)
	{
		$templates->registerFunction('language', [$this, 'getObject']);
	}

	public function getObject()
	{
		return $this;
	}

	public function getLanguage($order)
	{
		$lang = $this->core->podb->from('language')
			->where('active', 'Y')
			->order('id_language ' . $order . '')
			->fetchAll();
		return $lang;
	}

	public function getIdLanguage($code)
	{
		$id_lang = $this->core->podb->from('language')
			->where('code', $code)
			->limit(1)
			->fetch();
		return $id_lang;
	}
}
