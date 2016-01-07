<?php

class RB_Race extends RB_DB_Races {

	function canAllyWith($race2) {
		return (in_array($this->getAllegiance($race2)->type, array('Y', 'S')) ? true : false);
	}

	function getAllegiance($race2) {
		$allegiance = new RB_Allegiance;
		$allegiance->whereAdd("race1={$this->id} and race2={$race2->id}");
		$allegiance->whereAdd("race2={$this->id} and race1={$race2->id}", 'OR');
		return ($allegiance->find(true) ? $allegiance : false);
	}
}