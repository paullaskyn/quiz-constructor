<?php
	namespace core;

	use PDO;

	#----------------------------------------
	#	Base model class for connection
	#	and working with db
	#========================================

	class Db
	{
		public $db;

		public function __construct()
		{
			try {
				$config_db_path = '../config/db_config.php';

				if (!file_exists($config_db_path))
					throw new \PDOException("Database configuration file not found.");

				$db_config = require_once $config_db_path;

				$dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";

				$opt = [
					PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					PDO::ATTR_EMULATE_PREPARES   => false
				];

				$this->db = new PDO($dsn, $db_config['user'], $db_config['password'], $opt);

			} catch (\PDOException $e) {
				# Later I will make a beautiful error page and show errors there
				# for now...
				die("Error connecting to database: {$e->getMessage()}");
			}
		}

		/**
		 * Method sends queries to the database
		 *
		 * @method query
		 *
		 * @param  string $query  [line with sql query]
		 * @param  array  $params [parameters that need to be inserted into the string]
		 *
		 * @return [type]         [return type depends on input string $query]
		 */

		final public function query(string $query, array $params = [])
		{
			try {
				$stmt = $this->db->prepare($query);
				$stmt->execute($params);

				$rawStatement = explode(' ', preg_replace("/\s+|\t+|\n+/", " ", $query));
				$statement = strtolower($rawStatement[0]);

				if ($statement === 'select' || $statement === 'show') {
					return $stmt->fetchAll();
				} elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
					return $stmt->rowCount();
				} else {
					return null;
				}

			} catch (\PDOException $e) {
				die("Database request failed: {$e->getMessage()}");
			}
		}

}
