<?php

class RB_SpecialAbility extends RB_DB_Special_abilities {

	function getCost($figure=NULL) {
		if ($this->points > 0) {
			return $this->points;

		} elseif (!$figure) {
			return 10;

		} else {
			switch ($this->id) {
				case 10:
					// Hard To Kill
					if ($figure->grit >= 5) {
						return 10;

					} else {
						return 5;

					}

				case 19:
					// Strange Ally
					if ($figure->grit >= 2) {
						return 10;

					} else {
						return 5;

					}
			}
		}
	}
}