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
		if (isset($_POST['retinue'])) {
			$retinue = new RB_Retinue($_POST['retinue']);
			if ($retinue->user != $user->id) {
				$tpl->assign('error', 'Permission denied');
				$tpl->display('error.tpl');
				exit;
			}
		}

		$new = $figure->cloneFigure($user);

		if ($retinue) $retinue->addFigure($figure);

		header("Location: /edit_figure?figure={$new->id}");
		exit;
	}
}

$tpl->display('error.tpl');
