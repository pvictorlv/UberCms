<?php
define('Xukys', true);

define('NOWHOS', true);
include '../global.php';
header("Content-Type: text/plain");

if(LOGGED_IN) {
	header('X-JSON: {"privilegeLevel":"1"}');
	} else {
	header('X-JSON: {"privilegeLevel":"0"}');
}

?>