<?php

use PoTemplate\Engine;
use PoTemplate\Extension\ExtensionInterface;

class Gallery implements ExtensionInterface
{

	public function __construct()
	{
		$this->core = new PoCore();
	}

	public function register(Engine $templates)
	{
		$templates->registerFunction('gallery', [$this, 'getObject']);
	}

	public function getObject()
	{
		return $this;
	}

	public function getAllGallery($order = 'id_gallery DESC', $limit)
	{
		$gallery = $this->core->podb->from('gallery')->orderBy($order)->limit($limit)->fetchAll();
		return $gallery;
	}

	public function getAlbum($limit, $order, $page)
	{
		$offset = $this->core->popaging->searchPosition($limit, $page);
		$album = $this->core->podb->from('album')
			->where('active', 'Y')
			->orderBy($order)
			->limit($offset . ',' . $limit)
			->fetchAll();
		foreach ($album as $key => $alb) {
			$gallery = $this->core->podb->from('gallery')
				->where('id_album', $alb['id_album'])
				->orderBy('id_gallery DESC')
				->limit(1)
				->fetch();
			$album[$key]['picture'] = $gallery['picture'];
		}
		return $album;
	}

	public function getAlbumPaging($limit, $page, $type, $prev, $next)
	{
		$totaldata = $this->core->podb->from('album')->where('active', 'Y')->count();
		$totalpage = $this->core->popaging->totalPage($totaldata, $limit);
		$pagination = $this->core->popaging->navPage($page, $totalpage, BASE_URL, 'album', 'page', $type, $prev, $next);
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
