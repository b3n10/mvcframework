<?php

namespace Core;

use PDO;

class Model {

	protected static function connectDB() {
		static $db = null;

		if ($db === null) {
			$host			= 'localhost';
			$dbname		= 'mvcframework';
			$username = 'root';
			$password	=	'jairah';

			try {
				$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}

		return $db;
	}

}
