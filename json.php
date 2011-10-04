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

$update = "SELECT urler_prune('%s')";

$load = "SELECT * FROM urler_log WHERE seen = 'false' ORDER BY at DESC";

$datetime = (isset($_GET["seen"]))? $_GET["seen"]: false;

if ($datetime) {
	$qrystr = sprintf($update, pg_escape_string($datetime));

	if ($db->query($qrystr)) {
		header("Location: /urler/");
	}
}
elseif ($db->query($load)) {
	quit($db->getall());
}
else {
	quit(array(0 => "Q"));
}

?>
