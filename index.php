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

$save = "SELECT urler_save('%s')";

$url = (isset($_GET["url"]))? $_GET["url"]: false;

if ($url) {
	if ($db->query(sprintf($save, pg_escape_string($url)))) {
		header("Content-Type: text/plain");
		$line = $db->getline();
		echo $line["urler_save"];
	}
	else {
		quit("Query failed");
	}
}
else {
	header("Content-Type: application/xhtml+xml; charset=utf-8");
	readfile('template.xhtml');
}

?>
