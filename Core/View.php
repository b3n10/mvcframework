<?php

namespace Core;

class View {

	public static function render($view_file) {
		$file = "../App/Views/$view_file";

		if (is_readable($file)) {
			require_once $file;
		} else {
			echo "$file not found !";
		}
	}
}
