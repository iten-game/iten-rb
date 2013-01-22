<?php

if (!isset($user)) {
	$tpl->assign('error', 'Not logged in');

} else {
	$retinues = $user->getRetinues();
	$tpl->assign('retinue_count', count($retinues));
	$tpl->assign('retinues', $retinues);

	$figures = $user->getFigures();
	$tpl->assign('figure_count', count($figures));
	$tpl->assign('figures', $figures);
}

$tpl->display('home.tpl');