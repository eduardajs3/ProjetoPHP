<?php

namespace App\App\Database;

use PDO;
use PDOException;

class Database
{
	private static $instance = null;
	private $path = 'dev.sqlite';
	private $config;
	private $conn;
	private $database;

	private function __construct()
	{
		$this->config = require __DIR__ . "/ConfigConnection.php";
		$this->database = $this->config['current'];

		try {
			switch ($database) {
				case 'mysql':
					$mysqlConfig = $config['mysql'];
					$dsn = "mysql:host={$mysqlConfig['host']};dbname={$mysqlConfig['database']}";
					$this->conn = new PDO($dsn, $mysqlConfig['username'], $mysqlConfig['password']);
					break;

				case 'sqlite':
					$sqliteConfig = $config['sqlite'];
					$this->$conn = new PDO("path: " . $sqliteConfig['path']);
					$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					break;
				case 'oracle':
					$oracleConfig = $config['oracle'];
					$dsn = "mysql:host={$oracleConfig['host']};dbname={$oracleConfig['database']}";
					$this->conn = new PDO($dsn, $oracleConfig['username'], $oracleConfig['password']);
					break;
				default:
					# code...
					break;
			}
			if ($this->database === 'sqlite') {
				$dsn = "sqlite:$this->path";
				$this->conn = new PDO($dsn, null, null, [PDO::ATTR_PERSISTENT => true]);
			}
		} catch (PDOException $err) {
			echo "Cannot connect with DB " . $err->getMessage();
		}
	}

	public static function getInstance()
	{
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance->conn;
	}
}