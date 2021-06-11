<?php

class PoPaging
{

	function __construct()
	{ }

	public function searchPosition($limit, $active_page)
	{
		if (empty($active_page)) {
			$position = 0;
			$active_page = 1;
		} else {
			$position = ($active_page - 1) * $limit;
		}
		return $position;
	}

	public function totalPage($totaldata, $limit)
	{
		$totalpage = ceil($totaldata / $limit);
		return $totalpage;
	}

	public function navPage($active_page, $totalpage, $website_url, $mod, $title, $pagetype, $prevtxt, $nexttxt)
	{
		$link_page = "";

		if ($active_page > 1) {
			$prev = $active_page - 1;
			$link_page .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$website_url}/{$mod}/{$title}/{$prev}\">{$prevtxt}</a></li>";
		} else {
			$link_page .= "<li class=\"page-item disabled\"><a class=\"page-link\">{$prevtxt}</a></li>";
		}

		if ($pagetype == "1") {
			$num = ($active_page > 3 ? "<li class=\"page-item disabled\"><a class=\"page-link\">...</a></li>" : " ");
			for ($i = $active_page - 2; $i < $active_page; $i++) {
				if ($i < 1)
					continue;
				$num .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$website_url}/{$mod}/{$title}/{$i}\">{$i}</a></li>";
			}
			$num .= "<li class=\"page-item active\"><a class=\"page-link\">{$active_page}</a></li>";
			for ($i = $active_page + 1; $i < ($active_page + 3); $i++) {
				if ($i > $totalpage)
					break;
				$num .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$website_url}/{$mod}/{$title}/{$i}\">{$i}</a></li>";
			}
			$num .= ($active_page + 2 < $totalpage ? "<li class=\"page-item disabled\"><a class=\"page-link\">...</a></li><li class=\"page-item\"><a class=\"page-link\" href=\"{$website_url}/{$mod}/{$title}/{$totalpage}\">{$totalpage}</a></li>" : " ");
			$link_page .= "{$num}";
		}

		if ($active_page < $totalpage) {
			$next = $active_page + 1;
			$link_page .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$website_url}/{$mod}/{$title}/{$next}\">{$nexttxt}</a></li>";
		} else {
			$link_page .= "<li class=\"page-item disabled\"><a class=\"page-link\">{$nexttxt}</a></li>";
		}
		return $link_page;
	}
}
