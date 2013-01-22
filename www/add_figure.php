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

		if (!isset($_POST['name']) || empty($_POST['name'])) {
			$tpl->assign('error', 'Figure name is empty');

		} else {
			$figure = new RB_Figure;
			$figure->name	= $_POST['name'];
			$figure->race	= $retinue->race;
			$figure->user	= $user->id;
			$figure->leader	= isset($_POST['leader']);
			$figure->armour	= $_POST['armour'];
			$figure->grit	= abs(intval($_POST['grit']));
			$figure->fv	= abs(intval($_POST['fv']));
			$figure->sv	= abs(intval($_POST['sv']));
			$figure->s	= abs(intval($_POST['speed']));
			$figure->notes	= $_POST['notes'];

			if (0 == $figure->insert()) {
				$tpl->assign('error', 'Error adding figure, please try again later');

			} else {
				$link = new RB_RetinueLink;
				$link->figure = $figure->id;
				$link->retinue = $retinue->id;
				$link->insert();

				$retinue->update();

				foreach ($_POST['weapons'] as $weapon) {
					$link = new RB_WeaponLink;
					$link->weapon = $weapon;
					$link->figure = $figure->id;
					$link->insert();
				}

				foreach ($_POST['abilities'] as $ability) {
					$link = new RB_SpecialAbilityLink;
					$link->ability = $ability;
					$link->figure = $figure->id;
					$link->insert();
				}

				foreach ($_POST['powers'] as $power) {
					$link = new RB_PsykerPowerLink;
					$link->power = $power;
					$link->figure = $figure->id;
					$link->insert();
				}

				header("Location: /edit_retinue?id=$retinue->id");
			}
		}
	}
}

$tpl->display('add_figure.tpl');