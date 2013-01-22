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
		$figure = new RB_Figure;
		$figure->id = $_POST['figure'];

		if (0 == $figure->find(true)) {
			$tpl->assign('error', 'Figure not found');

		} elseif ($figure->leader && $retinue->hasLeader()) {
			$tpl->assign('error', 'You can only have one leader per retinue');

		} else {
			if ($retinue->race != $figure->race) {
				if (!$retinue->canAllyWith($figure->getRace())) {
					$tpl->assign('error', "You can't use this figure with this retinue");
					$tpl->display('error.tpl');
					exit;
				}
			}
			$link = new RB_RetinueLink;
			$link->retinue = $retinue->id;
			$link->figure = $figure->id;
			$link->insert();

			$retinue->update();

			header("Location: /edit_retinue?id={$retinue->id}");
			exit;
		}
	}
}

$tpl->display('error.tpl');