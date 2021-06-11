<?php

use PoTemplate\Engine;
use PoTemplate\Extension\ExtensionInterface;

class Post implements ExtensionInterface
{
	public function __construct()
	{
		$this->core = new PoCore();
	}

	public function register(Engine $templates)
	{
		$templates->registerFunction('post', [$this, 'getObject']);
	}

	public function getObject()
	{
		return $this;
	}

	public function getPost($limit, $order, $lang)
	{
		$post = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('post_description.id_language', $lang)
			->where('post.active', 'Y')
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->orderBy('post.id_post ' . $order . '')
			->limit($limit)
			->fetchAll();
		return $post;
	}

	public function getPostById($id_post, $lang)
	{
		$post = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('post.id_post', $id_post)
			->where('post_description.id_language', $lang)
			->where('post.active', 'Y')
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->limit(1)
			->fetch();
		return $post;
	}

	public function getPostByCategory($id_category, $limit, $order, $lang)
	{
		$post = array();
		$categorys = $this->core->podb->from('post_category')
			->where('id_category', $this->getCategoryParentTree($id_category))
			->orderBy('id_post_category ' . $order . '')
			->limit($limit)
			->fetchAll();
		foreach ($categorys as $cat) {
			$if_post = $this->getPostById($cat['id_post'], $lang);
			if (!empty($if_post['active'])) {
				$post[] = $this->getPostById($cat['id_post'], $lang);
			}
		}
		$lastarr = $this->arrayOrderBy($post, 'id_post', SORT_DESC);
		return array_unique($lastarr, SORT_REGULAR);
	}

	public function getPopular($limit, $order, $lang)
	{
		$popular = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('post_description.id_language', $lang)
			->where('post.active', 'Y')
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->orderBy('post.hits ' . $order . '')
			->limit($limit)
			->fetchAll();
		return $popular;
	}

	public function getPopularInCategory($category, $limit, $order, $lang)
	{
		$post = array();
		$categorys = $this->core->podb->from('post_category')
			->where('id_category', $this->getCategoryParentTree($category))
			->orderBy('id_post_category DESC')
			->fetchAll();
		foreach ($categorys as $cat) {
			$if_post = $this->getPostById($cat['id_post'], $lang);
			if (!empty($if_post['active'])) {
				$post[] = $this->getPostById($cat['id_post'], $lang);
			}
		}
		if ($order == 'ASC' || $order == 'asc') {
			$popular = $this->arrayOrderBy($post, 'hits', SORT_ASC);
		} else {
			$popular = $this->arrayOrderBy($post, 'hits', SORT_DESC);
		}
		$popular = array_unique($popular, SORT_REGULAR);
		return array_slice($popular, 0, $limit);
	}

	public function getRecent($limit, $order, $lang)
	{
		$recent = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('post_description.id_language', $lang)
			->where('post.active', 'Y')
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->orderBy('post.id_post ' . $order . '')
			->limit($limit)
			->fetchAll();
		return $recent;
	}

	public function getHeadline($limit, $order, $lang)
	{
		$headline = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('post_description.id_language', $lang)
			->where('post.active', 'Y')
			->where('post.headline', 'Y')
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->orderBy('post.id_post ' . $order . '')
			->limit($limit)
			->fetchAll();
		return $headline;
	}

	public function getRelated($id_post, $tags, $limit, $order, $lang)
	{
		$exp_tag  = explode(",", $tags);
		$total = (integer)count($exp_tag);
		$total_tag = $total - 1;
		$conditions = array();
		for ($i = 0; $i <= $total_tag; $i++) {
			$conditions[] = "post.tag LIKE '%" . $exp_tag[$i] . "%'";
		}
		$orWhere = implode(" OR ", $conditions);
		$related = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('post_description.id_language', $lang)
			->where('post.id_post != ?', $id_post)
			->where('(' . $orWhere . ')')
			->where('post.active', 'Y')
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->orderBy('post.id_post ' . $order . '')
			->limit($limit)
			->fetchAll();
		return $related;
	}

	public function getPrevPost($id_post, $lang)
	{
		$post = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('post.id_post < ?', $id_post)
			->where('post_description.id_language', $lang)
			->where('post.active', 'Y')
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->orderBy('post.id_post DESC')
			->limit(1)
			->fetch();
		return $post;
	}

	public function getNextPost($id_post, $lang)
	{
		$post = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('post.id_post > ?', $id_post)
			->where('post_description.id_language', $lang)
			->where('post.active', 'Y')
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->limit(1)
			->fetch();
		return $post;
	}

	public function getComment($limit, $order)
	{
		$comment = $this->core->podb->from('comment')
			->where('active', 'Y')
			->orderBy('id_comment ' . $order . '')
			->limit($limit)
			->fetchAll();
		return $comment;
	}

	public function getCommentByPost($id_post, $limit, $order, $page)
	{
		$offset = $this->core->popaging->searchPosition($limit, $page);
		$comment = $this->core->podb->from('comment')
			->where('id_post', $id_post)
			->where('id_parent', '0')
			->where('active', 'Y')
			->orderBy('id_comment ' . $order . '')
			->limit($offset . ',' . $limit)
			->fetchAll();
		return $comment;
	}

	public function getCommentByParent($id_parent, $limit, $order)
	{
		$comment = $this->core->podb->from('comment')
			->where('id_parent', $id_parent)
			->where('active', 'Y')
			->orderBy('id_comment ' . $order . '')
			->limit($limit)
			->fetchAll();
		return $comment;
	}

	public function generateComment($comments, $order, $template)
	{
		$comment_template = '';
		foreach ($comments as $comment) {
			$datetime = date_create($comment['date'] . ' ' . $comment['time']);
			$comment_template .= str_replace('{$comment_id}', $comment['id_comment'], $template['parent_tag_open']);
			$comment_template_con = str_replace('{$comment_id}', $comment['id_comment'], $template['comment_list']);
			$comment_template_con = str_replace('{$comment_name}', $comment['name'], $comment_template_con);
			$comment_template_con = str_replace('{$comment_avatar}', BASE_URL . '/' . DIR_CON . '/uploads/avatar.jpg', $comment_template_con);
			$comment_template_con = str_replace('{$comment_url}', $this->core->postring->addhttp($comment['url']), $comment_template_con);
			$comment_template_con = str_replace('{$comment_datetime}', date_format($datetime, 'd M Y') . ' ' . date_format($datetime, 'H:i:a'), $comment_template_con);
			$comment_template_con = str_replace('{$comment_content}', nl2br($comment['comment']), $comment_template_con);
			$comment_template .= $comment_template_con;
			$comment_child = $this->core->podb->from('comment')
				->where('id_parent', $comment['id_comment'])
				->where('active', 'Y')
				->orderBy('id_comment ' . $order . '')
				->fetchAll();
			if (count($comment_child) > 0) {
				$comment_template .= str_replace('{$comment_id}', $comment['id_comment'], $template['child_tag_open']);
				$comment_template .= $this->generateComment($comment_child, 'DESC', $template);
				$comment_template .= $template['child_tag_close'];
			}
			$comment_template .= $template['parent_tag_close'];
		}
		return $comment_template;
	}

	public function getCommentPaging($limit, $id_post, $seotitle, $page, $type, $prev, $next)
	{
		$totaldata = $this->core->podb->from('comment')->where('id_post', $id_post)->where('id_parent', '0')->where('active', 'Y')->count();
		$totalpage = $this->core->popaging->totalPage($totaldata, $limit);
		$postdata = $this->getPostById($id_post, WEB_LANG_ID);
		$permalink = $this->core->postring->permalink(rtrim(BASE_URL, '/'), $postdata);
		$pagination = $this->core->popaging->navPage($page, $totalpage, BASE_URL, str_replace(BASE_URL, '', $permalink), 'page', $type, $prev, $next);
		return $pagination;
	}

	public function getCountComment($id_post)
	{
		$comment = $this->core->podb->from('comment')
			->where('id_post', $id_post)
			->where('active', 'Y')
			->count();
		return $comment;
	}

	public function getAuthor($id_user)
	{
		$author = $this->core->podb->from('users')
			->select(array('username', 'nama_lengkap', 'email', 'no_telp', 'bio', 'picture'))
			->where('id_user', $id_user)
			->limit(1)
			->fetch();
		return $author;
	}

	public function getAuthorName($id_user)
	{
		$author = $this->core->podb->from('users')
			->select(array('nama_lengkap', 'email', 'no_telp', 'bio', 'picture'))
			->where('id_user', $id_user)
			->limit(1)
			->fetch();
		return $author['nama_lengkap'];
	}

	public function getAllTag($order = 'id_tag DESC', $limit, $sep = ', ', $link = true, $opentag = '', $closetag = '')
	{
		$tagsep = '';
		$tags = $this->core->podb->from('tag')->orderBy($order)->limit($limit)->fetchAll();
		foreach ($tags as $tag) {
			if ($link) {
				$tagsep .= $opentag . '<a href="' . WEB_URL . 'tag/' . $tag['tag_seo'] . '">' . ucfirst($tag['title']) . '</a>' . $closetag . $sep;
			} else {
				$tagsep .= $opentag . $tag['title'] . $closetag . $sep;
			}
		}
		return rtrim($tagsep, $sep);
	}

	public function getPostTag($tagseo, $sep = ', ', $link = true)
	{
		$tag = '';
		$tagseoexp  = explode(',', $tagseo);
		foreach ($tagseoexp as $exp) {
			$tags = $this->core->podb->from('tag')
				->where('tag_seo', $exp)
				->limit(1)
				->fetch();
			if ($link) {
				$tag .= '<a href="' . WEB_URL . 'tag/' . $tags['tag_seo'] . '">' . ucfirst($tags['title']) . '</a>' . $sep;
			} else {
				$tag .= $tags['title'] . $sep;
			}
		}
		return rtrim($tag, $sep);
	}

	public function getCategoryParentTree($id_category)
	{
		$ptree = array();
		$ptree[] = "" . $id_category . "";
		$ctree = $this->getCategoryTree($id_category);
		$ptree = array_merge($ptree, $ctree);
		return $ptree;
	}

	public function getCategoryTree($id_category)
	{
		$tree = array();
		$catfuns = $this->core->podb->from('category')
			->select('category_description.title')
			->leftJoin('category_description ON category_description.id_category = category.id_category')
			->where('category.id_parent', $id_category)
			->where('category_description.id_language', '1')
			->orderBy('category.id_category ASC')
			->fetchAll();
		$catfunnum = $this->core->podb->from('category')->where('id_parent', $id_category)->orderBy('id_category ASC')->count();
		if ($catfunnum > 0) {
			foreach ($catfuns as $catfun) {
				$child = $this->getCategoryParentTree($catfun['id_category']);
				if ($child) {
					$tree[] = $catfun['id_category'];
					$tree = $child;
				} else {
					$tree[] = $catfun['id_category'];
				}
			}
		}
		return $tree;
	}

	public function getPostFromCategory($limit, $order, $orderall, $category, $page, $lang)
	{
		$offset = $this->core->popaging->searchPosition($limit, $page);
		if ($category['seotitle'] == 'all') {
			$post = $this->core->podb->from('post')
				->select(array('post_description.title', 'post_description.content'))
				->leftJoin('post_description ON post_description.id_post = post.id_post')
				->where('post_description.id_language', $lang)
				->where('post.active', 'Y')
				->where('post.publishdate < ?', date('Y-m-d H:i:s'))
				->orderBy($orderall)
				->limit($offset . ',' . $limit)
				->fetchAll();
		} else {
			$post = array();
			$categorys = $this->core->podb->from('post_category')
				->where('id_category', $this->getCategoryParentTree($category['id_category']))
				->orderBy($order)
				->limit($offset . ',' . $limit)
				->fetchAll();
			foreach ($categorys as $cat) {
				$if_post = $this->getPostById($cat['id_post'], $lang);
				if (!empty($if_post['active'])) {
					$post[] = $this->getPostById($cat['id_post'], $lang);
				}
			}
		}
		$lastarr = $this->arrayOrderBy($post, 'id_post', SORT_DESC);
		return array_unique($lastarr, SORT_REGULAR);
	}

	public function getCategoryPaging($limit, $category, $page, $type, $prev, $next)
	{
		if ($category['seotitle'] == 'all') {
			$totaldata = $this->core->podb->from('post')->where('active', 'Y')->where('publishdate < ?', date('Y-m-d H:i:s'))->count();
			$totalpage = $this->core->popaging->totalPage($totaldata, $limit);
			$pagination = $this->core->popaging->navPage($page, $totalpage, BASE_URL, 'category/' . $category['seotitle'], 'page', $type, $prev, $next);
		} else {
			$totaldata = $this->core->podb->from('post_category')->where('id_category', $this->getCategoryParentTree($category['id_category']))->count();
			$totalpage = $this->core->popaging->totalPage($totaldata, $limit);
			$pagination = $this->core->popaging->navPage($page, $totalpage, BASE_URL, 'category/' . $category['seotitle'], 'page', $type, $prev, $next);
		}
		return $pagination;
	}

	public function getPostFromTag($limit, $order, $tag, $page, $lang)
	{
		$offset = $this->core->popaging->searchPosition($limit, $page);
		$post = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('post.tag LIKE ?', '%' . $tag . '%')
			->where('post_description.id_language', $lang)
			->where('post.active', 'Y')
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->orderBy($order)
			->limit($offset . ',' . $limit)
			->fetchAll();
		return $post;
	}

	public function getTagPaging($limit, $tag, $page, $type, $prev, $next)
	{
		$totaldata = $this->core->podb->from('post')
			->where('post.tag LIKE ?', '%' . $tag . '%')
			->where('post.active', 'Y')
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->count();
		$totalpage = $this->core->popaging->totalPage($totaldata, $limit);
		$pagination = $this->core->popaging->navPage($page, $totalpage, BASE_URL, 'tag/' . $tag, 'page', $type, $prev, $next);
		return $pagination;
	}

	public function getPostFromSearch($limit, $order, $query, $page, $lang)
	{
		$conditions = [
			'post_description.title LIKE "%' . str_replace('-', ' ', $query) . '%"',
			'post_description.content LIKE "%' . str_replace('-', ' ', $query) . '%"',
			'post.tag LIKE "%' . str_replace('-', ' ', $query) . '%"',
		];
		$orWhere = implode(" OR ", $conditions);
		$offset = $this->core->popaging->searchPosition($limit, $page);
		$post = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('(' . $orWhere . ')')
			->where('post_description.id_language', $lang)
			->where('post.active', 'Y')
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->orderBy($order)
			->limit($offset . ',' . $limit)
			->fetchAll();
		return $post;
	}

	public function getSearchPaging($limit, $query, $page, $lang, $type, $prev, $next)
	{
		$conditions = [
			'post_description.title LIKE "%' . str_replace('-', ' ', $query) . '%"',
			'post_description.content LIKE "%' . str_replace('-', ' ', $query) . '%"',
			'post.tag LIKE "%' . str_replace('-', ' ', $query) . '%"',
		];
		$orWhere = implode(" OR ", $conditions);
		$totaldata = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('(' . $orWhere . ')')
			->where('post_description.id_language', $lang)
			->where('post.active', 'Y')
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->count();
		$totalpage = $this->core->popaging->totalPage($totaldata, $limit);
		$pagination = $this->core->popaging->navPage($page, $totalpage, BASE_URL, 'search/' . $query, 'page', $type, $prev, $next);
		return $pagination;
	}

	public function getPostGallery($id_post, $order)
	{
		$post_gallery = $this->core->podb->from('post_gallery')
			->where('id_post', $id_post)
			->orderBy('id_post_gallery ' . $order . '')
			->fetchAll();
		return $post_gallery;
	}

	public function getPostFromEditor($editor, $limit, $order, $page, $lang)
	{
		$post = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('post_description.id_language', $lang)
			->where('post.active', 'Y')
			->where('post.editor', $editor)
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->orderBy('post.id_post ' . $order . '')
			->limit($limit)
			->fetchAll();
		return $post;
	}

	public function getPostFromEditorPaging($editor, $username, $limit, $page, $lang, $type, $prev, $next)
	{
		$totaldata = $this->core->podb->from('post')
			->select(array('post_description.title', 'post_description.content'))
			->leftJoin('post_description ON post_description.id_post = post.id_post')
			->where('post_description.id_language', $lang)
			->where('post.active', 'Y')
			->where('post.editor', $editor)
			->where('post.publishdate < ?', date('Y-m-d H:i:s'))
			->count();
		$totalpage = $this->core->popaging->totalPage($totaldata, $limit);
		$pagination = $this->core->popaging->navPage($page, $totalpage, BASE_URL, 'member/profile/' . $username, 'page', $type, $prev, $next);
		return $pagination;
	}

	public function generate_checkbox($id, $type, $id_post = null)
	{
		if ($type == 'add') {
			return $this->generate_child($id, "0");
		} else {
			return $this->generate_child_update($id, $id_post, "0");
		}
	}

	public function generate_child($id, $exp)
	{
		$i = 1;
		$html = "";
		$indent = str_repeat("\t\t", $i);
		$catfuns = $this->core->podb->from('category')
			->select('category_description.title')
			->leftJoin('category_description ON category_description.id_category = category.id_category')
			->where('category.id_parent', $id)
			->where('category_description.id_language', '1')
			->orderBy('category.id_category ASC')
			->fetchAll();
		$catfunnum = $this->core->podb->from('category')->where('id_parent', $id)->orderBy('id_category ASC')->count();
		if ($catfunnum > 0) {
			$html .= "\n\t" . $indent . "";
			$html .= "<ul class=\"list-unstyled\">";
			$i++;
			foreach ($catfuns as $catfun) {
				$explus = $exp + 20;
				$child = $this->generate_child($catfun['id_category'], $explus . "px");
				$html .= "\n\t" . $indent . "";
				if ($child) {
					$i--;
					$html .= "<li><input type=\"checkbox\" name=\"id_category[]\" value='" . $catfun['id_category'] . "' style='margin-left:" . $exp . ";' /> ";
					$html .= $catfun['title'];
					$html .= $child;
					$html .= "\n\t" . $indent . "";
				} else {
					$html .= "<li><input type=\"checkbox\" name=\"id_category[]\" value='" . $catfun['id_category'] . "' style='margin-left:" . $exp . ";' /> ";
					$html .= $catfun['title'];
				}
				$html .= '</li>';
			}
			$html .= "\n$indent</ul>";
			return $html;
		} else {
			return false;
		}
	}

	public function generate_child_update($id, $id_post, $exp)
	{
		$i = 1;
		$html = "";
		$postcat = array();
		$indent = str_repeat("\t\t", $i);
		$catfuns = $this->core->podb->from('category')
			->select('category_description.title')
			->leftJoin('category_description ON category_description.id_category = category.id_category')
			->where('category.id_parent', $id)
			->where('category_description.id_language', '1')
			->orderBy('category.id_category ASC')
			->fetchAll();
		$post_cats = $this->core->podb->from('post_category')
			->where('id_post', $id_post)
			->fetchAll();
		foreach ($post_cats as $post_cat) {
			$postcat[] = $post_cat['id_category'];
		}
		$catfunnum = $this->core->podb->from('category')->where('id_parent', $id)->orderBy('id_category ASC')->count();
		if ($catfunnum > 0) {
			$html .= "\n\t" . $indent . "";
			$html .= "<ul class=\"list-unstyled\">";
			$i++;
			foreach ($catfuns as $catfun) {
				if (in_array($catfun['id_category'], $postcat)) {
					$checked = 'checked';
				} else {
					$checked = '';
				}
				$explus = $exp + 20;
				$child = $this->generate_child_update($catfun['id_category'], $id_post, $explus . "px");
				$html .= "\n\t" . $indent . "";
				if ($child) {
					$i--;
					$html .= "<li><input type=\"checkbox\" name=\"id_category[]\" value='" . $catfun['id_category'] . "' style='margin-left:" . $exp . ";' " . $checked . " /> ";
					$html .= $catfun['title'];
					$html .= $child;
					$html .= "\n\t" . $indent . "";
				} else {
					$html .= "<li><input type=\"checkbox\" name=\"id_category[]\" value='" . $catfun['id_category'] . "' style='margin-left:" . $exp . ";' " . $checked . " /> ";
					$html .= $catfun['title'];
				}
				$html .= '</li>';
			}
			$html .= "\n$indent</ul>";
			return $html;
		} else {
			return false;
		}
	}

	public function arrayOrderBy()
	{
		$args = func_get_args();
		$data = array_shift($args);
		foreach ($args as $n => $field) {
			if (is_string($field)) {
				$tmp = array();
				foreach ($data as $key => $row)
					$tmp[$key] = $row[$field];
				$args[$n] = $tmp;
			}
		}
		$args[] = &$data;
		call_user_func_array('array_multisort', $args);
		return array_pop($args);
	}
}
