<?php

if (!isset($user)) {
	$tpl->assign('error', 'Not logged in');

} else {
	$retinue = new RB_Retinue;
	$retinue->id = $_REQUEST['retinue'];

	if (0 == $retinue->find(true)) {
		$tpl->assign('error', 'Retinue not found');

	} elseif ($retinue->user != $user->id) {
		$tpl->assign('error', 'Permission denied');

	} else {
		$tpl->assign('retinue', $retinue);

		$figure = new RB_Figure;
		$figure->id = $_REQUEST['figure'];

		if (0 == $figure->find(true)) {
			$tpl->assign('error', 'Figure not found');

		} elseif ($figure->user != $user->id) {
			$tpl->assign('error', 'Permission denied');

		} else {
			$link = new RB_RetinueLink;
			$link->retinue = $retinue->id;
			$link->figure = $figure->id;

			if (0 == $link->find(true)) {
				$tpl->assign('error', "Figure isn't a member of this retinue");

			} else {
				$link->delete();
				$retinue->update();
				header("Location: /edit_retinue?id={$retinue->id}");
			}
		}
	}
}

$tpl->display('error.tpl');
