<?php

require 'pgdb.php';

function param($id) {
	return (isset($_GET[$id]))? pg_escape_string(urldecode($_GET[$id])): false;
}

function quit($msg) {
	header("Content-Type: text/plain");
	echo "$msg\n";
	exit;
}

$db = new PGDB();

if (!$db->ok()) {
	quit("DB");
}

$save = "SELECT urler_save('%s', '%s', '%s')";

$url = param("url");
$nick = param("nick");
$chan = param("chan");

if ($url) {
	$qrystr = sprintf($save, $url, $nick, $chan);

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
	readfile("urler.xhtml");
}

?>
