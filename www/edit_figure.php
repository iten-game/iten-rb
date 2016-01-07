<?php

if (!isset($user)) {
	$tpl->assign('error', 'Not logged in');
	$tpl->display('error.tpl');
	exit;

} else {
	$figure = new RB_Figure;
	$figure->id = $_REQUEST['figure'];
	
	if (0 == $figure->find(true)) {
		$tpl->assign('error', 'Figure not found');
		$tpl->display('error.tpl');
		exit;

	} elseif ($figure->user != $user->id) {
		$tpl->assign('error', 'Permission denied');
		$tpl->display('error.tpl');
		exit;

	} elseif ('POST' == $_SERVER['REQUEST_METHOD']) {
		$figure->name	= $_POST['name'];
		$figure->leader	= isset($_POST['leader']);
		$figure->armour	= $_POST['armour'];
		$figure->grit	= abs(intval($_POST['grit']));
		$figure->fv	= abs(intval($_POST['fv']));
		$figure->sv	= abs(intval($_POST['sv']));
		$figure->s	= abs(intval($_POST['speed']));
		$figure->notes	= $_POST['notes'];
		$figure->update();

		$link = new RB_WeaponLink;
		$link->figure = $figure->id;
		$link->delete();
		if (isset($_POST['weapons'])) foreach ($_POST['weapons'] as $id) {
			$link->weapon = $id;
			$link->insert();
		}

		$link = new RB_SpecialAbilityLink;
		$link->figure = $figure->id;
		$link->delete();
		if (isset($_POST['abilities'])) foreach ($_POST['abilities'] as $id) {
			$link->ability = $id;
			$link->insert();
		}

		$link = new RB_PsykerPowerLink;
		$link->figure = $figure->id;
		$link->delete();
		if (isset($_POST['powers'])) foreach ($_POST['powers'] as $id) {
			$link->power = $id;
			$link->insert();
		}

		$link = new RB_EquipmentLink;
		$link->figure = $figure->id;
		$link->delete();
		if (isset($_POST['equipment'])) foreach ($_POST['equipment'] as $id) {
			$link->equipment = $id;
			$link->insert();
		}

		$tpl->assign('updated', true);
	}

	$_REQUEST = array(
		'name'		=> $figure->name,
		'notes'		=> $figure->notes,
		'grit'		=> $figure->grit,
		'fv'		=> $figure->fv,
		'sv'		=> $figure->sv,
		'speed'		=> $figure->s,
		'leader'	=> $figure->leader,
		'armour'	=> $figure->armour,
		'weapons'	=> array(),
		'abilities'	=> array(),
		'powers'	=> array(),
	);
	foreach ($figure->getWeapons() as $weapon) $_REQUEST['weapons'][] = $weapon->id;
	foreach ($figure->getSpecialAbilities() as $ability) $_REQUEST['abilities'][] = $ability->id;
	foreach ($figure->getPsykerPowers() as $power) $_REQUEST['powers'][] = $power->id;
	foreach ($figure->getEquipment() as $equipment) $_REQUEST['equipment'][] = $equipment->id;

	$tpl->assign('figure', $figure);
}

$tpl->display('edit_figure.tpl');
