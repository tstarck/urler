<?php

require '../config/db.php';

class PGDB {
	private $connection;

	function __construct() {
		$connection = pg_connect($db_connection_string);
	}

	function __destruct() {
		pg_close($connection);
	}

	public function ok() {
		return ($connection !== false);
	}

	public function query($qry_str) {
		if ($this->ok()) {
			return pg_fetch_array(pg_query($qry_str));
		}

		return false;
	}
}

?>
