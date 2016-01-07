<?php

if (!isset($user)) {
	$tpl->assign('error', 'not logged in!');

} else {
	$contactee = new RB_User;
	$contactee->username = $_REQUEST['id'];

	if (!$contactee->find(true)) {
		$tpl->assign('error', 'User not found');

	} else {
		$tpl->assign('contactee', $contactee);

		if ($contactee->id == $user->id) {
			$tpl->assign('error', "you can't send messages to yourself!");
	
		} elseif (!$contactee->allow_emails) {
			$tpl->assign('error', 'User does not want to receive emails');
	
		} else {
			if ('POST' == $_SERVER['REQUEST_METHOD']) {
				if (!isset($_POST['message']) || empty($_POST['message'])) {
					$tpl->assign('error', 'Empty message');
	
				} else {
					$result = $mail->send(
						$contactee->email,
						array(
							'To'		=> sprintf('"%s" <%s>', ucfirst($contactee->username), $contactee->email),
							'From'		=> sprintf('"%s (via %s)" <%s>', ucfirst($user->username), SITE_NAME, $user->email),
							'Subject'	=> sprintf('Message received from %s on %s', ucfirst($user->username), SITE_NAME),
							'Date'		=> gmdate('r'),
						),
						sprintf(
							"Dear %s,\n\n".
							"The user %s on %s (http://%s/) sent you the following message:\n\n".
							"%s\n\n".
							"To reply, click the 'Reply' button or click on the following link:\n\n".
							"http://%s/contact_user?id=%s",
							ucfirst($contactee->username),
							ucfirst($user->username),
							SITE_NAME,
							$_SERVER['HTTP_HOST'],
							$_POST['message'],
							$_SERVER['HTTP_HOST'],
							$user->username
						)
					);
					if (PEAR::isError($result)) {
						$tpl->assign('error', 'Error sending email. Please try again later.');
			
					} else {
						$tpl->assign('message_sent', true);
			
					}
				}
			}
		}
	}
}

$tpl->display('contact_user.tpl');
