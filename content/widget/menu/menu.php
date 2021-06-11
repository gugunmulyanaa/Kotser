<?php

use PoTemplate\Engine;
use PoTemplate\Extension\ExtensionInterface;

class Menu implements ExtensionInterface
{

	public function __construct()
	{
		$this->core = new PoCore();
		$this->frontmenu = new FrontMenu();
	}

	public function register(Engine $templates)
	{
		$templates->registerFunction('menu', [$this, 'getObject']);
	}

	public function getObject()
	{
		return $this;
	}

	public function getFrontMenu($set_lang, $attr = '', $attrs = '', $attrss = '', $wrapper = '', $endwrapper = '')
	{
		$group_id = $this->core->podb->from('menu_group')
			->where('title', $set_lang)
			->limit(1)
			->fetch();
		$front_menu = $this->frontmenu->menu($group_id['id'], $attr, $attrs, $attrss, $wrapper, $endwrapper);
		return $front_menu;
	}
}
