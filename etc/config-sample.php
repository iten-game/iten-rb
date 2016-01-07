<?php

ini_set('include_path', ini_get('include_path').':'.dirname(dirname(__FILE__)).'/inc');

define('DB_DATAOBJECT_NO_OVERLOAD', true);

require('RB/AutoLoader.php');

spl_autoload_register(array('RB_AutoLoader', 'load'));

$options = &PEAR::getStaticProperty('DB_DataObject', 'options');
$options['database']		= 'mysql://username:password@server/database';
$options['schema_location']	= dirname(__FILE__);
$options['class_location']	= dirname(dirname(__FILE__)).'/inc/RB/DB';
$options['class_prefix']	= 'RB_DB_';
$options['quote_identifiers']	= true;
$options['extends']		= 'RB_DataObject';
$options['extends_location']	= 'RB/DataObject.php';
$options['OVERLOADED']		= false;

define('SITE_NAME',			'ItEN Retinue Builder (Beta)');
define('SITE_EMAIL',			'no-reply@iten-game.org');
define('PASSWORD_HASH_ALG',		'sha256');
define('PASSWORD_HASH_ITERATIONS',	50000);
