<?php

require 'pgdb.php';

function quit($msg) {
	header("Content-Type: text/plain");
	echo "$msg\n";
	exit();
}

$db = new PGDB();

if (!$db->ok()) {
	quit("DB");
}

$save = "SELECT urler_save('%s')";

$url = (isset($_GET["url"]))? $_GET["url"]: false;

if ($url) {
	$qrystr = sprintf($save, pg_escape_string($url));

	if ($db->query($qrystr)) {
		$line = $db->getline();
		quit($line["urler_save"]);
	}
	else {
		quit("Q");
	}
}
else {
	header("Content-Type: application/xhtml+xml; charset=utf-8");
	readfile('template.xhtml');
}

?>
