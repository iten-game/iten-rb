<?php

$retinue = new RB_Retinue;
$retinue->id = $_REQUEST['id'];

$res = $retinue->find(true);

if (0 == $res) {
	$tpl->assign('error', 'Retinue not found');

} elseif (!$retinue->public && (!isset($user) || $retinue->user != $user->id)) {
	$tpl->assign('error', 'Permission denied');

} else {
	$tpl->assign('retinue', $retinue);

}

$tpl->display(isset($_REQUEST['printable']) ? 'view_retinue_printable.tpl' : 'view_retinue.tpl');
