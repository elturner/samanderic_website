<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require_once "configuration.php";

class Database {
	private $connection;

	function __construct() {
		$host = Configuration::$DATABASE_HOST;
		$user = Configuration::$DATABASE_USER;
		$pass = Configuration::$DATABASE_PASSWORD;
		$db_name = Configuration::$DATABASE_NAME;

		$this->connection = pg_connect("host=$host dbname=$db_name user=$user password=$pass");

		// if connection fails
		if (!$this->connection) {
			die("<br>Couldn't establish a connection with the database.\n");
		}
	}

	function insert($table, $values) {
		return pg_insert($this->connection, $table, $values);
	}

	function query($query) {
		return pg_query($this->connection, $query);
	}

	function read_row($results) {
		return pg_fetch_array($results);
	}

	function escape_string($string) {
		return pg_escape_string($string);
	}

	function num_rows($result) {
		return pg_num_rows($result);
	}
}

?>
