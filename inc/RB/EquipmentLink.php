<?php

class RB_EquipmentLink extends RB_DB_Equipment_link {

	function getEquipment() {
		return new RB_Equipment($this->equipment);
	}
}
