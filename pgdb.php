<?php

require '../config/db.php';

class PGDB {
	private $resource;
	private $connection;

	function __construct() {
		$this->resource = false;
		$this->connection = pg_connect($db_connection_string);
	}

	function __destruct() {
		pg_close($connection);
	}

	public function ok() {
		return ($connection !== false);
	}

	public function query($query) {
		if ($this->ok()) {
			$this->resource = pg_query($this->connection, $query);
		}

		return ($this->resource !== false);
	}

	public function getall() {
		if ($this->resource === false) return;
		return pg_fetch_all($this->resource);
	}

	public function getline() {
		if ($this->resource === false) return;
		return pg_fetch_assoc($this->resource);
	}
}

?>
