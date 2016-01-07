<?php

ini_set('session.name', 'RBSESSID');
session_start();

ob_start();

$parts = explode('/', $_SERVER['PATH_INFO']);
array_shift($parts);
$function = $parts[0];

if ($function === '') $function = 'front';
if (!preg_match('/^[a-z_]{3,}$/', $function)) die('invalid function');

$file = dirname(__FILE__).'/'.$function.'.php';
if (!file_exists($file)) exit;

require(dirname(dirname(__FILE__)).'/etc/config.php');
require(dirname(dirname(__FILE__)).'/inc/utils.php');

require('Smarty/Smarty.class.php');

$tpl = new Smarty;
$tpl->caching		= false;
$tpl->template_dir	= dirname(dirname(__FILE__)).'/tpl';
$tpl->compile_dir	= '/tmp';
$tpl->cache_dir		= '/tmp';

function smarty_dump($params) {
	var_export($params['var']);
}
$tpl->register_function('dump', 'smarty_dump');

$tpl->assign('SITE_NAME', SITE_NAME);

$RB = new RB();
$tpl->assign('RB', $RB);

require('thoughts.php');
$tpl->assign('thought', $thoughts[rand(0, count($thoughts)-1)]);

$mail = Mail::factory('sendmail');

if (isset($_SESSION['user']) && $_SESSION['user'] > 0) {
	$user = new RB_User;
	$user->id = $_SESSION['user'];
	$user->find(true);

	if (0 === $user->enabled) {
		unset($user);

	} else {
		$user->last_seen = NOW();
		$user->update();
		$tpl->assign('user', $user);
	}
}

require($file);
