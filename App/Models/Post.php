<?php

namespace App\Models;

use PDO;

class Post {

	public static function getAll() {
		$host			= 'localhost';
		$dbname		= 'mvcframework';
		$username = 'root';
		$password	=	'jairah';

		try {
			$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

			$stmt = $pdo->prepare('SELECT id, title, content FROM posts ORDER BY created_at');

			if ($stmt->execute()) {
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
			return false;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

}
