<?php

$race = new RB_Race;
$tpl->assign('races', $race->findSet());

if (!isset($user)) {
	$tpl->assign('error', 'Not logged in');

} elseif (!isset($_POST['name']) || empty($_POST['name'])) {
	$tpl->assign('error', 'Missing retinue name');

} else {
	$race = new RB_Race;
	$race->id = intval($_POST['race']);

	if (0 == $race->count()) {
		$tpl->assign('error', 'Invalid race');

	} else {
		$retinue = new RB_Retinue;
		$retinue->user		= $user->id;
		$retinue->name		= $_POST['name'];
		$retinue->race		= $race->id;
		$retinue->created	= NOW();
		$retinue->updated	= NOW();
		$retinue->public	= false;
		$retinue->insert();

		header("Location: /edit_retinue?id={$retinue->id}");
	}
}

$tpl->display('create_retinue.tpl');