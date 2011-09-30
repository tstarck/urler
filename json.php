<?php

require 'pgdb.php';

function quit($data) {
	header("Content-Type: application/json");
	echo json_encode($data);
	exit;
}

$db = new PGDB();

if (!$db->ok()) {
	quit(array(0 => "DB"));
}

$load = "SELECT * FROM urler_log ORDER BY at DESC";
$del = "DELETE FROM urler_log WHERE at <= '%s' RETURNING url";

$datetime = (isset($_GET["del"]))? $_GET["del"]: false;

if ($datetime) {
	$qrystr = sprintf($del, pg_escape_string($datetime));

	if ($db->query($qrystr)) {
		header("Location: /urler/");
	}

	exit;
}

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
