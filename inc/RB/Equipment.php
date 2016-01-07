<?php

class RB_Equipment extends RB_DB_Equipment {

	function getCost($figure=NULL) {
		return $this->points;
	}
}
