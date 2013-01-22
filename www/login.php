<?php

if (isset($user)) {
	$tpl->assign('error', 'Already logged in');

} elseif ('POST' == $_SERVER['REQUEST_METHOD']) {
	if (!isset($_POST['username']) || empty($_POST['username'])) {
		$tpl->assign('error', 'Missing username');
	
	} elseif (!isset($_POST['password']) || empty($_POST['password'])) {
		$tpl->assign('error', 'Missing password');
	
	} else {
		$user = new RB_User;
		$user->username = $_POST['username'];
	
		if (0 == $user->find(true)) {
			$tpl->assign('error', 'Invalid username');
	
		} elseif (false == $user->enabled) {
			$tpl->assign('error', 'Account has not yet been activated');
	
		} else {
			if ($user->hashPassword($_POST['password']) != $user->password_hash) {
				$tpl->assign('error', 'Invalid password');
	
			} else {
				// this progressively upgrades the strength of password hashes as users log in:
				if ($user->password_alg != PASSWORD_HASH_ALG ||
					$user->password_iterations < PASSWORD_HASH_ITERATIONS)
					$user->setPassword($_POST['password']);
	
				$_SESSION['user'] = $user->id;
				header('Location: /home');
	
			}
		}
	}
}

$tpl->display('login.tpl');