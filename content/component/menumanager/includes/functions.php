<?php
function site_url($url = '')
{
	if (!empty($url)) {
		return 'admin.php?mod=menumanager&act=' . $url;
	}
	return 'admin.php?mod=menumanager';
}

function redirect($url)
{
	$url = site_url($url);
	header("location: $url");
	die;
}
