<?php

namespace Core;

use Exception;

class View {

	public static function render($view_file, $args = []) {
		$file = "../App/Views/$view_file";

		extract($args, EXTR_SKIP);

		if (is_readable($file)) {
			require_once $file;
		} else {
			throw new Exception("$file not found !");
		}
	}

	public static function renderTemplate($template, $args = []) {
		static $twig = null;

		if (!$twig) {
			$loader = new \Twig_Loader_Filesystem('../App/Views');
			$twig = new \Twig_Environment($loader);
		}

		echo $twig->render($template, $args);
	}

}
