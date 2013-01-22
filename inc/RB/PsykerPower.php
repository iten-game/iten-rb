<?php

class RB_PsykerPower extends RB_DB_Psyker_powers {

	function getCost() {
		return $this->points;
	}
}