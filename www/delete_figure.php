<?php

if (!isset($user)) {
	$tpl->assign('error', 'Not logged in');

} else {
	$figure = new RB_Figure;
	$figure->id = $_REQUEST['figure'];

	if (0 == $figure->find(true)) {
		$tpl->assign('error', 'Figure not found');

	} elseif ($figure->user != $user->id) {
		$tpl->assign('error', 'Permission denied');

	} elseif (!isset($_POST['confirm'])) {
		$tpl->assign('figures', array($figure));
		$tpl->assign('figure', $figure);
		$tpl->assign('delete_confirm', true);

	} else {
		print "delete";
		$figure->delete();
		header("Location: /home");
		exit;

	}
}

$tpl->display('delete_figure.tpl');
