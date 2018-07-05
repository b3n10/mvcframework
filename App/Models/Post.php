<?php

namespace App\Models;

use PDO;

class Post extends \Core\Model {

	public static function getAll() {
		$pdo = self::connectDB();

		$stmt = $pdo->prepare('SELECT id, title, content FROM posts ORDER BY created_at');

		if ($stmt->execute()) {
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}

}
