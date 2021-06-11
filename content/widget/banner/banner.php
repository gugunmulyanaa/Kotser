<?php
use PoTemplate\Engine;
use PoTemplate\Extension\ExtensionInterface;

class Banner implements ExtensionInterface
{
	public function __construct()
	{
		$this->core = new PoCore();
	}

	public function register(Engine $templates)
	{
		$templates->registerFunction('banner', [$this, 'getObject']);
	}

	public function getObject()
	{
		return $this;
	}

	public function getAllBanner($order = 'id DESC')
	{
		$banner = $this->core->podb->from('banner')->orderBy($order)->fetchAll();
		return $banner;
	}
}
