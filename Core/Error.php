<?php

namespace Core;

use Exception;
use \App\Config;

class Error {

	public static function errorHandler($level, $msg, $file, $line) {
		if (error_reporting() !== 0) {
			throw new Exception($msg, 0, $level, $file, $line);
		}
	}

	public static function exceptionHandler($exception_obj) {

		$code = $exception_obj->getCode();

		if ($code !== 404) {
			$code = 500;
		}

		http_response_code($code);

		// for development
		if (Config::SHOW_ERRORS) {

			echo '<h1>Fatal Error!</h1>';
			echo '<p>Uncaught Exception: "' . get_class($exception_obj) . '"</p>';
			echo '<p>Message: "' . $exception_obj->getMessage() . '"</p>';
			echo '<p>Stack Trace: <pre>' . $exception_obj->getTraceAsString() . '</pre></p>';
			echo '<p>Thrown in "' . $exception_obj->getFile() . '" on line ' . $exception_obj->getLine() . '</p>';

			// for production
		} else {

			$log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
			ini_set('error_log', $log);

			$msg = 'Uncaught Exception: "' . get_class($exception_obj) . '"';
			$msg .= 'Message: "' . $exception_obj->getMessage() . '"';
			$msg .= 'Stack Trace: ' . $exception_obj->getTraceAsString();
			$msg .= 'Thrown in "' . $exception_obj->getFile() . '" on line ' . $exception_obj->getLine();
			error_log($msg);

			View::renderTemplate("$code.html");

		}
	}

}
