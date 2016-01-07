<?php

if (!isset($user)) {
	$tpl->assign('error', 'Not logged in');

} else {
	$retinue = new RB_Retinue;
	$retinue->id = $_REQUEST['id'];

	$res = $retinue->find(true);

	if (0 == $res) {
		$tpl->assign('error', 'Retinue not found');

	} elseif ($retinue->user != $user->id) {
		$tpl->assign('error', 'Permission denied');

	} elseif (!isset($_POST['confirm'])) {
		$tpl->assign('retinue', $retinue);

	} else {
		$retinue->delete();
		header("Location: /home");
		exit;

	}
}

$tpl->display('delete_retinue.tpl');