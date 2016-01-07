<?php

class RB_WeaponLink extends RB_DB_Weapon_link {

	function getWeapon() {
		return new RB_Weapon($this->weapon);
	}
}