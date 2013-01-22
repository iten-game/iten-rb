<?php

class RB_SpecialAbilityLink extends RB_DB_Abilities_link {

	function getAbility() {
		return new RB_SpecialAbility($this->ability);
	}
}