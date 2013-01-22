<?php

class RB_Armour extends RB_DB_Armour {

	function getCost() {
		return RB::getArmourCost($this->to_hit);
	}
}