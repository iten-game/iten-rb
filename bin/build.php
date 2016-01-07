<?php

require(dirname(dirname(__FILE__)).'/etc/config.php');

$GLOBALS['options']['debug'] = 5;

$generator = new DB_DataObject_Generator;
$generator->start();

