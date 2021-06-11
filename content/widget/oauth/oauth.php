<?php

use PoTemplate\Engine;
use PoTemplate\Extension\ExtensionInterface;

require_once('content/widget/oauth/twitter.php');

class Oauth implements ExtensionInterface
{
	public function __construct()
	{
		$this->core = new PoCore();
	}

	public function register(Engine $templates)
	{
		$templates->registerFunction('oauth', [$this, 'getObject']);
	}

	public function getObject()
	{
		return $this;
	}

	public function getFacebookCount($url)
	{
		if ($this->core->porequest->check_internet_connection()) {
			$rest_url = "http://api.facebook.com/restserver.php?format=json&method=links.getStats&urls=" . urlencode($url);
			$json = json_decode(file_get_contents($rest_url), true);
			return $json[0]['share_count'];
		} else {
			return 0;
		}
	}

	public function getTwitterCount($screen_name)
	{
		if ($this->core->porequest->check_internet_connection()) {
			$count = -1;
			$twoauth = $this->core->podb->from('oauth')
				->where('id_oauth', '2')
				->limit(1)
				->fetch();
			$settings = array(
				'twitter_user' => $screen_name,
				'consumer_key' => $twoauth['oauth_key'],
				'consumer_secret' => $twoauth['oauth_secret'],
				'oauth_access_token' => $twoauth['oauth_token1'],
				'oauth_access_token_secret' => $twoauth['oauth_token2'],
			);
			$apiUrl = "https://api.twitter.com/1.1/users/show.json";
			$requestMethod = 'GET';
			$getField = '?screen_name=' . $settings['twitter_user'];
			$twitter = new TwitterAPIExchange($settings);
			$response = $twitter->setGetfield($getField)->buildOauth($apiUrl, $requestMethod)->performRequest();
			$followers = json_decode($response);
			$count = (empty($followers->followers_count) ? '0' : $followers->followers_count);
			return $count;
		} else {
			return 0;
		}
	}

	public function getSubscribeCount()
	{
		$subscribe = $this->core->podb->from('subscribe')->count();
		return $subscribe;
	}
}
