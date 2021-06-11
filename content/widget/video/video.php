<?php

use PoTemplate\Engine;
use PoTemplate\Extension\ExtensionInterface;

class Video implements ExtensionInterface
{
	public function __construct()
	{
		$this->core = new PoCore();
	}

	public function register(Engine $templates)
	{
		$templates->registerFunction('video', [$this, 'getObject']);
	}

	public function getObject()
	{
		return $this;
	}

	public function getAllVideo($order = 'id_video DESC', $limit)
	{
		$video = $this->core->podb->from('video')->where('headline', 'Y')->orderBy($order)->limit($limit)->fetchAll();
		return $video;
	}

	public function getVideoPaging($limit, $page, $type, $prev, $next)
	{
		$totaldata = $this->core->podb->from('video')->where('headline', 'Y')->count();
		$totalpage = $this->core->popaging->totalPage($totaldata, $limit);
		$pagination = $this->core->popaging->navPage($page, $totalpage, BASE_URL, 'video', 'page', $type, $prev, $next);
		return $pagination;
	}

	public function getGallery($limit, $order, $album, $page)
	{
		$offset = $this->core->popaging->searchPosition($limit, $page);
		$gallery = $this->core->podb->from('gallery')
			->where('id_album', $album['id_album'])
			->orderBy($order)
			->limit($offset . ',' . $limit)
			->fetchAll();
		return $gallery;
	}

	public function getGalleryPaging($limit, $album, $page, $type, $prev, $next)
	{
		$totaldata = $this->core->podb->from('gallery')->where('id_album', $album['id_album'])->count();
		$totalpage = $this->core->popaging->totalPage($totaldata, $limit);
		$pagination = $this->core->popaging->navPage($page, $totalpage, BASE_URL, 'gallery/' . $album['seotitle'], 'page', $type, $prev, $next);
		return $pagination;
	}
}
