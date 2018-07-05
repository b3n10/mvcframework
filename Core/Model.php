<?php

namespace Core;

use PDO;
use \App\Config;

class Model {

	protected static function connectDB() {
		static $db = null;

		if ($db === null) {

			$db = new PDO("mysql:host=" . Config::DB_HOST .";dbname=" . Config::DB_NAME . ";charset=utf8",
				Config::DB_USERNAME, Config::DB_PASSWORD);

			// replace try-catch by throwing an exception if error occurs
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}

		return $db;
	}

}
