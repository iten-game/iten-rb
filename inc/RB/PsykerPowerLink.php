<?php

class RB_PsykerPowerLink extends RB_DB_Psyker_power_link {

	function getPower() {
		return new RB_PsykerPower($this->power);
	}
}