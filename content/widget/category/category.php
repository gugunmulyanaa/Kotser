<?php

use PoTemplate\Engine;
use PoTemplate\Extension\ExtensionInterface;

class Category implements ExtensionInterface
{

	public function __construct()
	{
		$this->core = new PoCore();
	}

	public function register(Engine $templates)
	{
		$templates->registerFunction('category', [$this, 'getObject']);
	}

	public function getObject()
	{
		return $this;
	}

	public function getCategory($id_post, $lang, $sep = ', ', $link = true)
	{
		$post_cats = $this->core->podb->from('post_category')
			->where('id_post', $id_post)
			->fetchAll();
		$category = '';
		foreach ($post_cats as $post_cat) {
			$categorys = $this->core->podb->from('category')
				->select('category_description.title')
				->leftJoin('category_description ON category_description.id_category = category.id_category')
				->where('category.id_category', $post_cat['id_category'])
				->where('category_description.id_language', $lang)
				->where('category.active', 'Y')
				->limit(1)
				->fetch();
			if ($link) {
				$category .= '<a href="' . WEB_URL . 'category/' . $categorys['seotitle'] . '">' . $categorys['title'] . '</a>' . $sep;
			} else {
				$category .= $categorys['title'] . $sep;
			}
		}
		return rtrim($category, $sep);
	}

	public function getOneCategory($id, $lang)
	{
		$category = $this->core->podb->from('category')
			->select('category_description.title')
			->leftJoin('category_description ON category_description.id_category = category.id_category')
			->where('category.id_category', $id)
			->where('category_description.id_language', $lang)
			->where('category.active', 'Y')
			->limit(1)
			->fetch();
		return $category;
	}

	public function getAllCategory($lang)
	{
		$category = $this->core->podb->from('category')
			->select('category_description.title')
			->leftJoin('category_description ON category_description.id_category = category.id_category')
			->where('category_description.id_language', $lang)
			->where('category.active', 'Y')
			->fetchAll();
		return $category;
	}
}
