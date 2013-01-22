<?php

function _SQL($sql) {
	return DB_DataObject_Cast::sql($sql);
}

function NOW() {
	return gmstrftime('%Y-%m-%d %H:%M:%S');
}

