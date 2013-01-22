<?php

class RB_Figure extends RB_DB_Figures {

	function getCost($retinue=NULL) {
		$cost =	0;
		$cost += RB::getGritCost($this->grit);
		$cost += $this->getArmour()->getCost();
		foreach ($this->getWeapons() as $weapon) $cost += $weapon->getCost();
		foreach ($this->getSpecialAbilities($retinue) as $ability) $cost += $ability->getCost($this);
		foreach ($this->getPsykerPowers() as $power) $cost += $power->getCost();

		return $cost;
	}

	function getArmour() {
		return new RB_Armour($this->armour);
	}

	function getWeapons() {
		$link = new RB_WeaponLink;
		$link->figure = $this->id;
		$link->find();
		$weapons = array();
		while ($link->fetch()) $weapons[] = $link->getWeapon();
		return $weapons;
	}

	function getSpecialAbilities($retinue=NULL) {
		$link = new RB_SpecialAbilityLink;
		$link->figure = $this->id;
		$link->find();
		$abilities = array();
		while ($link->fetch()) $abilities[$link->ability] = $link->getAbility();

		if (
			$retinue &&
			$retinue->race != $this->race &&
			!isset($abilities[RB::STRANGE_ALLY]) &&
			'S' == $this->getRace()->getAllegiance($retinue->getRace())->type
		) $abilities[RB::STRANGE_ALLY] = new RB_SpecialAbility(RB::STRANGE_ALLY);

		return array_values($abilities);
	}

	function getPsykerPowers() {
		$link = new RB_PsykerPowerLink;
		$link->figure = $this->id;
		$link->find();
		$powers = array();
		while ($link->fetch()) $powers[] = $link->getPower();
		return $powers;
	}

	function in($retinue) {
		$link = new RB_RetinueLink;
		$link->figure = $this->id;
		$link->retinue = $retinue->id;
		return ($link->count() > 0);
	}

	function getRace() {
		return new RB_Race($this->race);
	}

	function delete() {
		$link = new RB_WeaponLink;
		$link->figure = $this->id;
		$link->delete();

		$link = new RB_SpecialAbilityLink;
		$link->figure = $this->id;
		$link->delete();

		$link = new RB_PsykerPowerLink;
		$link->figure = $this->id;
		$link->delete();

		$link = new RB_RetinueLink;
		$link->figure = $this->id;
		$link->delete();

		parent::delete();
	}

	function linked() {
		$link = new RB_RetinueLink;
		$link->figure = $this->id;
		return ($link->count() > 0);
	}

	function getRetinues() {
		$link = new RB_RetinueLink;
		$link->figure = $this->id;
		$link->find();
		$retinues = array();
		while ($link->fetch()) $retinues[] = $link->getRetinue();
		return $retinues;
	}

	function canJoin($retinue) {
		if ($this->in($retinue)) return false;
		if ($this->leader && $retinue->hasLeader()) return false;
		if ($this->race != $retinue->race && !$this->getRace()->canAllyWith($retinue->getRace())) return false;
		return true;
	}

	function addWeapon($weapon) {
		$link = new RB_WeaponLink;
		$link->figure = $this->id;
		$link->weapon = $weapon->id;
		$link->insert();
		return $link;
	}

	function addSpecialAbility($ability) {
		$link = new RB_SpecialAbility;
		$link->figure = $this->id;
		$link->ability = $ability->id;
		$link->insert();
		return $link;
	}

	function addPsykerPower($power) {
		$link = new RB_PsykerPower;
		$link->figure = $this->id;
		$link->power = $power->id;
		$link->insert();
		return $link;
	}

	function cloneFigure($user=NULL) {
		$new = new RB_Figure;
		foreach (array_keys($this->table()) as $field) $new->$field = $this->$field;

		unset($new->id);
		$new->name = $new->name.' (clone)';
		if ($user) $new->user = $user->id;
		$new->insert();

		foreach ($this->getWeapons() as $weapon) $new->addWeapon($weapon);
		foreach ($this->getSpecialAbilities() as $ability) $new->addSpecialAbility($ability);
		foreach ($this->getPsykerPowers() as $power) $new->addPsykerPower($power);

		return $new;
	}

	function inPublicRetinues() {
		$o = new RB_DataObject;
		$o->query("SELECT COUNT(1) AS count
				FROM retinues,retinue_link
				WHERE (
					retinues.id=retinue_link.retinue AND
					retinue_link.figure={$this->id} AND
					retinues.public=1
				)");
		return ($o->count > 0);
	}
}