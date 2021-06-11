<?php
$router->match('GET|POST', '/rabeg', function () use ($core, $templates) {
	$lang = $core->setlang('rabeg', WEB_LANG);
	$info = array(
		'page_title' => $lang['front_rabeg'],
		'page_desc' => $core->posetting[2]['value'],
		'page_key' => $core->posetting[3]['value'],
		'social_mod' => $lang['front_contact'],
		'social_name' => $core->posetting[0]['value'],
		'social_url' => $core->posetting[1]['value'],
		'social_title' => $core->posetting[0]['value'],
		'social_desc' => $core->posetting[2]['value'],
		'social_img' => $core->posetting[1]['value'] . '/' . DIR_INC . '/images/favicon.png',
	);
	$adddata = array_merge($info, $lang);
	$templates->addData(
		$adddata
	);
	echo $templates->render('rabeg', compact('lang'));
});
