<?php

class RB_DataObject extends DB_DataObject {

	function __construct($id=NULL) {
		if ($id) {
			$this->id = $id;
			$this->find(true);
		}
	}

	function findSet() {
		$set = array();

		$this->find();
		while ($this->fetch()) $set[] = clone($this);
		return $set;
	}

	function quote($str) {
		$driver = $this->getDatabaseConnection();
		if ($driver instanceof DB_common) {
			return $driver->escapeSimple($str);
		
		} elseif ($driver instanceof MDB2_Driver_Common) {
			return $driver->escape($str);
		
		} else {
			trigger_error(sprintf("Cannot escape string '%s': unhandled driver class %s", $str, get_class($driver)), E_USER_ERROR);
		
		}
	}
}