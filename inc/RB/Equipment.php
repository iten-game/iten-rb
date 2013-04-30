<?php

class RB_Equipment extends RB_DB_Equipment {

	function getCost() {
		return $this->points;
	}
}
