<?php

if (!$user) {
	$tpl->display('error', 'not logged in');

} elseif ('POST' == $_SERVER['REQUEST_METHOD']) {
	if (!isset($_POST['message']) || empty($_POST['message'])) {
		$tpl->display('error', 'Empty message');

	} else {
		$result = $mail->send(
			'rb-feedback@iten-game.org',
			array(
				'To'		=> 'rb-feedback@iten-game.org',
				'From'		=> sprintf('"%s (via %s)" <%s>', ucfirst($user->username), SITE_NAME, $user->email),
				'Subject'	=> sprintf('Feedback received from %s', ucfirst($user->username)),
				'Date'		=> gmdate('r'),
			),
			$_POST['message']
		);
		if (PEAR::isError($result)) {
			$tpl->assign('error', 'Error sending email. Please try again later.');

		} else {
			$tpl->assign('message_sent', true);

		}
	}
}

$tpl->display('feedback.tpl');