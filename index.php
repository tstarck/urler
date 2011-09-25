<?php

require 'pgdb.php';

function quittext($exit, $msg) {
	header("Content-Type: text/plain");
	echo "$msg\n";
	exit($exit);
}

$db = new PGDB();

if (!$db->ok()) {
	quittext(1, "No db connection");
}

$save = "SELECT urler_save('%s')";

# $load = "SELECT * FROM urler_log ORDER BY at DESC";

$url = (isset($_GET["url"]))? $_GET["url"]: false;

if ($url) {
	$result = $db->query(sprintf($save, $url));
	quittext(0, $result["urler_save"]);
}
else {
	header("Content-Type: application/xhtml+xml; charset=utf-8");
	readfile('template.xhtml');
}

?>
