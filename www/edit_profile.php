<?php

if (!$user) {
	$tpl->assign('error', 'Not logged in');
	$tpl->display('error.tpl');
	exit;

} elseif ('POST' == $_SERVER['REQUEST_METHOD']) {
	$hash = $user->hashPassword($_POST['password']);
	if ($hash != $user->password_hash) {
		$tpl->assign('error', 'Incorrect password');

	} else {
		$update = true;

		if (!Validate::email($_POST['email'])) {
			$tpl->assign('error', 'Invalid email address');
			$update = false;

		} else {
			$other = new RB_USer;
			$other->email = $_POST['email'];
			$other->whereAdd(sprintf('id<>%d', $user->id));
			if ($other->count() > 0) {
				$tpl->assign('error', 'That email address is already in use');
				$update = false;

			} else {
				$user->email = $_POST['email'];

			}
		}

		if (isset($_POST['password1']) && !empty($_POST['password1'])) {
			if ($_POST['password1'] != $_POST['password2']) {
				$tpl->assign('error', "Passwords don't match");
				$update = false;

			} elseif ($_POST['password1'] == $_POST['password']) {
				$tpl->assign('error', "New password is the same as the old one!");
				$update = false;


			} else {
				$user->setPassword($_POST['password1']);

			}
		}

		$user->allow_emails = isset($_POST['allow_emails']);

		if ($update) {
			$user->update();
			$tpl->assign('updated', true);
		}
	}
}

$tpl->display('edit_profile.tpl');