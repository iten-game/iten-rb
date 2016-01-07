<?php

if (!$user) {
	$tpl->assign('error', 'not logged in');

} else {
	$retinue = new RB_Retinue;
	$retinue->id = $_POST['retinue'];

	if (!$retinue->find(true)) {
		$tpl->assign('error', 'Retinue not found');

	} elseif ($user->id != $retinue->user && !$retinue->public) {
		$retinue->assign('error', 'Permission denied');

	} else {
		$new = $retinue->cloneRetinue($user);
		$new->user = $user->id;
		$new->update();
		header("Location: /edit_retinue?id={$new->id}");
		exit;
	}
}

$tpl->display('error.tpl');