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

	} else {
		$tpl->assign('retinue', $retinue);

		if ('POST' == $_SERVER['REQUEST_METHOD']) {
			$retinue->name = $_POST['name'];
			$retinue->notes = $_POST['notes'];
			$retinue->public = isset($_POST['public']);
			$retinue->update();
			$tpl->assign('updated', true);
		}

	}
}

$tpl->display('edit_retinue.tpl');