<?php

if (isset($user)) {
	$tpl->assign('error', 'already logged in');

} elseif (!isset($_GET['t']) || empty($_GET['t'])) {
	$tpl->assign('error', 'Missing activation code');

} elseif (!isset($_GET['u'])|| empty($_GET['u'])) {
	$tpl->assign('error', 'Missing username');

} else {
	$user = new RB_User;
	$user->username = $_GET['u'];

	if (0 == $user->find(true)) {
		$tpl->assign('error', 'Invalid username');

	} elseif (true == $user->enabled) {
		$tpl->assign('error', 'Account is already activated');

	} else {

		if ($_GET['t'] !== hash($user->password_alg, $user->username.$user->email.$user->password_salt)) {
			$tpl->assign('error', "Invalid activation code. If the code is broken into separate lines in the email, please copy and paste it into your browser's address bar");

		} else {
			$user->enabled = true;
			$user->update();
			$_SESSION['user'] = $user->id;

		}
	}
}

$tpl->display('activate.tpl');