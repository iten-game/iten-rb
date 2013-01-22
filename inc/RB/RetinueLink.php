<?php

class RB_RetinueLink extends RB_DB_Retinue_link {

	function getFigure() {
		return new RB_Figure($this->figure);
	}

	function getRetinue() {
		return new RB_Retinue($this->retinue);
	}
}