<?php

$router->match('GET|POST', '/tag/([a-z0-9_-]+)', function ($seotitle) use ($core, $templates) {
	$lang = $core->setlang('tag', WEB_LANG);
	$tag = $core->podb->from('post')
		->where('post.tag LIKE ?', '%' . $seotitle . '%')
		->where('post.active', 'Y')
		->where('post.publishdate < ?', date('Y-m-d H:i:s'))
		->limit(1)
		->fetch();
	if ($tag) {
		$info = array(
			'page_title' => ucfirst(str_replace('-', ' ', $seotitle)),
			'page_desc' => ucfirst(str_replace('-', ' ', $seotitle)) . ' - ' . $core->posetting[2]['value'],
			'page_key' => ucfirst(str_replace('-', ' ', $seotitle)),
			'social_mod' => $lang['front_tag_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'] . '/tag/' . $seotitle,
			'social_title' => ucfirst(str_replace('-', ' ', $seotitle)),
			'social_desc' => ucfirst(str_replace('-', ' ', $seotitle)) . ' - ' . $core->posetting[2]['value'],
			'social_img' => $core->posetting[1]['value'] . '/' . DIR_INC . '/images/favicon.png',
			'tag_seo' => $seotitle,
			'page' => '1'
		);
		$adddata = array_merge($info, $lang);
		$templates->addData(
			$adddata
		);
		echo $templates->render('tag', compact('tag', 'lang'));
	} else {
		$info = array(
			'page_title' => $lang['front_tag_not_found'],
			'page_desc' => $core->posetting[2]['value'],
			'page_key' => $core->posetting[3]['value'],
			'social_mod' => $lang['front_tag_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'],
			'social_title' => $lang['front_tag_not_found'],
			'social_desc' => $core->posetting[2]['value'],
			'social_img' => $core->posetting[1]['value'] . '/' . DIR_INC . '/images/favicon.png'
		);
		$adddata = array_merge($info, $lang);
		$templates->addData(
			$adddata
		);
		echo $templates->render('404', compact('lang'));
	}
});

$router->match('GET|POST', '/tag/([a-z0-9_-]+)/page/(\d+)', function ($seotitle, $page) use ($core, $templates) {
	$lang = $core->setlang('tag', WEB_LANG);
	$tag = $core->podb->from('post')
		->where('post.tag LIKE ?', '%' . $seotitle . '%')
		->where('post.active', 'Y')
		->where('post.publishdate < ?', date('Y-m-d H:i:s'))
		->limit(1)
		->fetch();
	if ($tag) {
		$info = array(
			'page_title' => ucfirst(str_replace('-', ' ', $seotitle)),
			'page_desc' => ucfirst(str_replace('-', ' ', $seotitle)) . ' - ' . $core->posetting[2]['value'],
			'page_key' => ucfirst(str_replace('-', ' ', $seotitle)),
			'social_mod' => $lang['front_tag_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'] . '/tag/' . $seotitle,
			'social_title' => ucfirst(str_replace('-', ' ', $seotitle)),
			'social_desc' => ucfirst(str_replace('-', ' ', $seotitle)) . ' - ' . $core->posetting[2]['value'],
			'social_img' => $core->posetting[1]['value'] . '/' . DIR_INC . '/images/favicon.png',
			'tag_seo' => $seotitle,
			'page' => $page
		);
		$adddata = array_merge($info, $lang);
		$templates->addData(
			$adddata
		);
		echo $templates->render('tag', compact('tag', 'lang'));
	} else {
		$info = array(
			'page_title' => $lang['front_tag_not_found'],
			'page_desc' => $core->posetting[2]['value'],
			'page_key' => $core->posetting[3]['value'],
			'social_mod' => $lang['front_tag_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'],
			'social_title' => $lang['front_tag_not_found'],
			'social_desc' => $core->posetting[2]['value'],
			'social_img' => $core->posetting[1]['value'] . '/' . DIR_INC . '/images/favicon.png'
		);
		$adddata = array_merge($info, $lang);
		$templates->addData(
			$adddata
		);
		echo $templates->render('404', compact('lang'));
	}
});
