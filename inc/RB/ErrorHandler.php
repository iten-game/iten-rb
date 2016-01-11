<?php

class RB_ErrorHandler {

	static function error($errno, $errstr, $file, $line, $context) {
		printf(
			'<pre>Error: %s at %s line %u\n',
			htmlspecialchars(errstr),
			htmlspecialchars($file),
			$line
		);
		debug_print_backtrace();
		print '</pre>';
		if ($errno == E_USER_ERROR) exit(1);
	}
}
