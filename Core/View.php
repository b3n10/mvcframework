<?php

namespace Core;

class View {

	public static function render($view_file, $args = []) {
		$file = "../App/Views/$view_file";

		extract($args, EXTR_SKIP);

		if (is_readable($file)) {
			require_once $file;
		} else {
			echo "$file not found !";
		}
	}
}
