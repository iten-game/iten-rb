<?php

class RB_ErrorHandler {

	static function error($errno, $errstr, $file, $line, $context) {
		print "<pre>Error: {$errstr} at {$file} line {$line}";
		debug_print_backtrace();
		print "</pre>";
		if ($errno == E_USER_ERROR) exit(1);
	}
}