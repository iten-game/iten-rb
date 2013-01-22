<?php

class RB_Retinue extends RB_DB_Retinues {

	function getRace() {
		$race = new RB_Race;
		$race->id = $this->race;
		$race->find(true);
		return $race;
	}

	function getFigureCount() {
		$link = new RB_RetinueLink;
		$link->retinue = $this->id;
		return $link->count();
	}

	function getCost() {
		$total = 0;
		foreach ($this->getFigures() as $figure) $total += $figure->getCost($this);
		return $total;
	}

	function getFigures() {
		$link = new RB_RetinueLink;
		$link->query("SELECT retinue_link.*
				FROM retinue_link,figures
				WHERE (
					retinue='{$this->id}' AND
					figure=figures.id
				)
				ORDER BY leader DESC, grit DESC, id ASC");
		$figures = array();
		while ($link->fetch()) $figures[] = $link->getFigure();
		return $figures;
	}

	function hasLeader() {
		$link = new RB_RetinueLink;
		$link->query("SELECT COUNT(1) AS count
				FROM retinue_link,figures
				WHERE (
					retinue='{$this->id}' AND
					figure=figures.id AND
					leader=1
				)");
		$link->fetch();
		return ($link->count > 0);
	}

	function delete() {
		$link = new RB_RetinueLink;
		$link->retinue = $this->id;
		$link->delete();

		parent::delete();
	}

	function canAllyWith($race1) {
		return $this->getRace()->canAllyWith($race1);
	}

	function getCreator() {
		return new RB_User($this->user);
	}

	function addFigure($figure) {
		$link = new RB_RetinueLink;
		$link->retinue = $this->id;
		$link->figure = $figure->id;
		$link->insert();
		return $link;
	}

	function removeFigure($figure) {
		$link = new RB_RetinueLink;
		$link->retinue = $this->id;
		$link->figure = $figure->id;
		return $link->delete();
	}

	function cloneRetinue($user=NULL) {
		$new = new RB_Retinue;
		foreach (array_keys($this->table()) as $field) $new->$field = $this->$field;

		unset($new->id);
		$new->name = $new->name.' (clone)';
		$new->public = false;
		if ($user) $new->user = $user->id;
		$new->insert();

		foreach ($this->getFigures() as $figure) {
			if ($user && $user->id != $figure->user) {
				$new->addFigure($figure->cloneFigure($user));

			} else {
				$new->addFigure($figure);

			}
		}

		return $new;
	}

	function update() {
		$this->updated = gmstrftime('%Y-%m-%d %H:%M:%S');
		parent::update();
	}

	function insert() {
		$this->created = gmstrftime('%Y-%m-%d %H:%M:%S');
		parent::insert();
	}
}