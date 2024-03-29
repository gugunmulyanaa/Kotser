<?php
$site['structure'] = 'Madani CMS';
$site['ver'] = '2.0';
$site['build'] = '1';
$site['release'] = '19 Maret 2019';

define('CONF_STRUCTURE', $site['structure']);
define('CONF_VER', $site['ver']);
define('CONF_BUILD', $site['build']);
define('CONF_RELEASE', $site['release']);

$site['url'] = "http://localhost/madani_opd/";
$site['adm'] = "admin";
$site['con'] = "content";
$site['inc'] = "includes";

define('WEB_URL', $site['url']);
define('DIR_ADM', $site['adm']);
define('DIR_CON', $site['con']);
define('DIR_INC', $site['inc']);

$db['host'] = "localhost";
$db['driver'] = "mysql";
$db['sock'] = "";
$db['port'] = "";
$db['user'] = "root";
$db['passwd'] = "";
$db['db'] = "db_madaniopd";

define('DATABASE_HOST', $db['host']);
define('DATABASE_DRIVER', $db['driver']);
define('DATABASE_SOCK', $db['sock']);
define('DATABASE_PORT', $db['port']);
define('DATABASE_USER', $db['user']);
define('DATABASE_PASS', $db['passwd']);
define('DATABASE_NAME', $db['db']);

$site['vqmod'] = FALSE;
$site['timezone'] = "Asia/Jakarta";
$site['permalink'] = "slug/post-title";
$site['slug_permalink'] = "detailpost";

define('VQMOD', $site['vqmod']);
define('TIMEZONE', $site['timezone']);
define('PERMALINK', $site['permalink']);
define('SLUG_PERMALINK', $site['slug_permalink']);
