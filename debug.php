<?php

function debug($msg) {
	$kahva= fopen('debug.log', 'a');
	if ($kahva !== false) {
		fwrite($kahva, $msg."\n");
		fclose($kahva);
	}
}

?>
