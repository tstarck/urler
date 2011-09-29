<?php

require 'pgdb.php';

# DELETE FROM urler_log
#   WHERE at < '2011-09-28 20:04:41.0' RETURNING url;

function quit($data) {
	header("Content-Type: application/json");
	echo json_encode($data);
	exit();
}

$db = new PGDB();

if (!$db->ok()) {
	quit(array(0 => "DB"));
}

$load = "SELECT * FROM urler_log ORDER BY at DESC";

if ($db->query($load)) {
	$data = array();

	while (($line = $db->getline()) !== false) {
		array_push(
			$data,
			array($line["url"] => $line["at"])
		);
	}

	quit($data);
}
else {
	quit(array(0 => "Q"));
}

?>
