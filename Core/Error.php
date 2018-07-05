<?php

namespace Core;

use Exception;

class Error {

	public static function errorHandler($level, $msg, $file, $line) {
		if (error_reporting() !== 0) {
			throw new Exception($msg, 0, $level, $file, $line);
		}
	}

	public static function exceptionHandler($exception_obj) {
		echo '<h1>Fatal Error!</h1>';
		echo '<p>Uncaught Exception: "' . get_class($exception_obj) . '"</p>';
		echo '<p>Message: "' . $exception_obj->getMessage() . '"</p>';
		echo '<p>Stack Trace: <pre>' . $exception_obj->getTraceAsString() . '</pre></p>';
		echo '<p>Thrown in "' . $exception_obj->getFile() . '" on line ' . $exception_obj->getLine() . '</p>';
	}

}
