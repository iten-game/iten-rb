<?php

class RB_Weapon extends RB_DB_Weapons {

	function getCost() {
		return RB::getWeaponCost($this);
	}
}
