<?php

class RB {

	const STRANGE_ALLY = 19;

	function getRaces() {
		$race = new RB_Race;
		return $race->findSet();
	}

	function getArmour() {
		$armour = new RB_Armour;
		return $armour->findSet();
	}

	function getWeapons() {
		$weapon = new RB_Weapon;
		return $weapon->findSet();
	}

	function getSpecialAbilities() {
		$ability = new RB_SpecialAbility;
		return $ability->findSet();
	}

	function getPsykerPowers() {
		$power = new RB_PsykerPower;
		return $power->findSet();
	}

	function getGritCost($grit) {
		if ($grit <= 2) {
			return 16;

		} elseif ($grit <= 3) {
			return 9;

		} elseif ($grit <= 4) {
			return 4;

		} elseif ($grit <= 5) {
			return 2;

		} else {
			return 1;

		}
	}

	function getArmourCost($to_hit) {
		if ($to_hit <= 5) {
			return 0;

		} elseif ($to_hit <= 6) {
			return 3;

		} elseif ($to_hit <= 7) {
			return 6;

		} elseif ($to_hit <= 8) {
			return 10;

		} elseif ($to_hist <= 9) {
			return 15;

		} else {
			return 20;

		}	}

	static function startDebug() {
		$options = &PEAR::getStaticProperty('DB_DataObject', 'options');
		$options['debug'] = 5;
		echo '<pre>';
	}

	static function stopDebug() {
		$options = &PEAR::getStaticProperty('DB_DataObject', 'options');
		$options['debug'] = 0;
		echo '</pre>';
	}
	
	function getPublicRetinues($limit=NULL) {
		$retinue = new RB_Retinue;
		$retinue->public = true;
		$retinue->orderBy('IF(updated > created,updated,created) DESC');
		if ($limit) $retinue->limit(0,$limit);
		return $retinue->findSet();
	}
}