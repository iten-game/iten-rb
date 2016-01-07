<?php

if (isset($user)) {
	$tpl->assign('error', "You're already logged in!");

} elseif ('POST' == $_SERVER['REQUEST_METHOD']) {
	$user = new RB_User;
	$user->whereAdd(sprintf(
		"username='%s' OR email='%s'",
		$user->quote($_POST['username']),
		$user->quote($_POST['email'])
	));
	if (1 == $user->find(true)) {
		$password = Text_Password::create(12);
		$user->setPassword($password, false);

		$result = $mail->send(
			$user->email,
			array(
				'To'		=> sprintf('"%s" <%s>', ucfirst($user->username), $user->email),
				'From'		=> sprintf('"%s" <%s>', SITE_NAME, SITE_EMAIL),
				'Subject'	=> 'User Account Password Reset',
				'Date'		=> gmdate('r'),
			),
			sprintf(
				"Dear %s\n\n".
				"Someone (presumably you, but possibly someone else) asked for your password on %s to be reset. Your account details are now as follows:\n\n".
				"Username: %s\n".
				"Password %s\n\n".
				"If you did not request this reset, you must still use this password to log in, but you can change it once you've done so.",
				ucfirst($user->username),
				SITE_NAME,
				$user->username,
				$password
			)
		);
		if (PEAR::isError($result)) {
			$tpl->assign('error', 'Error sending email. Please try again later.');

		} else {
			$tpl->assign('password_updated', true);
			$user->update();

		}
	}
}

$tpl->display('password_reset.tpl');