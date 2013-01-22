<?php

class RB_AutoLoader {

	static function load($class) {
		$limit = (preg_match('/^RB_DB_/', $class) ? 2 : -1);
		$file = preg_replace('/_/', '/', $class, $limit).'.php';
		require_once($file);
	}
}

