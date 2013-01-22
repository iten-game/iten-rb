<?php

if (isset($user)) {
	$tpl->assign('error', 'already logged in');

} elseif ('POST' == $_SERVER['REQUEST_METHOD']) {
	if (!isset($_POST['username']) || !isset($_POST['email'])) {
		$tpl->assign('error', 'Missing fields');
	
	} elseif (!preg_match('/^[a-zA-Z0-9]{4,}$/', $_POST['username'])) {
		$tpl->assign('error', "Invalid username '{$_POST['username']}'. Must be at least four characters from the set A-Z, 0-9");
	
	} elseif (!Validate::email($_POST['email'])) {
		$tpl->assign('error', 'Invalid email address');
	
	} else {
		$user = new RB_User;
		$user->username = $_POST['username'];
		$count = $user->count();
	
		if ($count > 0) {
			$tpl->assign('error', 'Username is already in use');
	
		} else {
			unset($user->username);
			$user->email = $_POST['email'];
	 		$count = $user->count();
	
			if ($count > 0) {
				$tpl->assign('error', 'Email address is already in use');
	
			} else {
				$password = Text_Password::create(12);
	
				$user->username			= $_POST['username'];
				$user->enabled			= false;
				$user->created			= NOW();
				$user->last_seen		= NOW();
				$user->setPassword($password, false);
	
				$result = $mail->send(
					$user->email,
					array(
						'To'		=> sprintf('"%s" <%s>', ucfirst($user->username), $user->email),
						'From'		=> sprintf('"%s" <%s>', SITE_NAME, SITE_EMAIL),
						'Subject'	=> 'User Account Registration',
						'Date'		=> gmdate('r'),
					),
					sprintf(
						"Dear %s\n\n".
						"Thank you for registering on %s. Your account has been created with the following password:\n\n".
						"%s\n\n".
						"To activate your account, please click on the following link:\n\n".
						"http://%s/activate?u=%s&t=%s",
						ucfirst($user->username),
						SITE_NAME,
						$password,
						$_SERVER['HTTP_HOST'],
						$user->username,
						hash($user->password_alg, $user->username.$user->email.$user->password_salt)
					)
				);
				if (PEAR::isError($result)) {
					$tpl->assign('error', 'Error sending email. Please try again later.');
	
				} else {
					$user->insert();
					$tpl->assign('registered', true);
	
				}
			}	
		}
	}
}

$tpl->display('signup.tpl');