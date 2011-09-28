<?php

require '../config/db.php';

class PGDB {
	private $resource;
	private $connection;

	function __construct() {
		$resource = false;
		$connection = pg_connect($db_connection_string);
	}

	function __destruct() {
		pg_close($connection);
	}

	public function ok() {
		return ($connection !== false);
	}

	public function query($query) {
		if ($this->ok()) {
			$resource = pg_query($query);
		}

		return ($resource !== false)? true; false;
	}

	public function getline() {
		return pg_fetch_assoc($resource);
	}

	public function getall() {
		return pg_fetch_all($resource);
	}
}

?>
