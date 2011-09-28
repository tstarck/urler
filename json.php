<?php

require 'pgdb.php';

function quit($msg) {
	header("Content-Type: text/plain");
	echo "$msg\n";
	die();
}

$db = new PGDB();

if (!$db->ok()) {
	quit("No db connection");
}

$load = "SELECT * FROM urler_log ORDER BY at DESC";

if ($db->query($load)) {
	# header("Content-Type: application/json");
	header("Content-Type: text/plain");
	print_r($pg->getall());
	echo json_encode($pg->getall());
}
else {
	quit("Query failed");
}

?>
