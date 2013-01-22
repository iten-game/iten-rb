<?php

if (!$user) {
	$tpl->assign('error', 'not logged in');

} else {
	$figure = new RB_Figure;
	$figure->id = $_POST['figure'];

	if (!$figure->find(true)) {
		$tpl->assign('error', 'Figure not found');

	} elseif ($figure->user != $user->id && !$figure->inPublicRetinues()) {
		$tpl->assign('error', 'Permission denied');

	} else {
		$new = $figure->cloneFigure($user);

		header("Location: /edit_figure?figure={$new->id}");
		exit;
	}
}

$tpl->display('error.tpl');