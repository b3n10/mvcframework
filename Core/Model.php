<?php

namespace Core;

use PDO;
use \App\Config;

class Model {

	protected static function connectDB() {
		static $db = null;

		if ($db === null) {

			try {
				$db = new PDO("mysql:host=" . Config::DB_HOST .";dbname=" . Config::DB_NAME . ";charset=utf8",
					Config::DB_USERNAME, Config::DB_PASSWORD);

			} catch (PDOException $e) {
				die($e->getMessage());
			}
		}

		return $db;
	}

}
