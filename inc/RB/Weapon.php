<?php

class RB_Weapon extends RB_DB_Weapons {

	function getCost() {
		$cost = $this->bonus;

		if ($this->range > 24) {
			$cost += 3;

		} elseif ($this->range > 18) {
			$cost += 2;

		} elseif ($this->range > 12) {
			$cost += 1;

		}

		$cost += ($this->grit_penalty * 3);

		return $cost;
	}
}