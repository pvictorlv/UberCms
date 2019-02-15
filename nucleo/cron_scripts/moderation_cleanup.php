<?php

if (!defined('UBER') || !UBER)
{
	exit;
}

$visitsCutoff = time() - 259200;
$chatlogsCutoff = time() - 1209600;

dbquery("DELETE FROM chatlogs WHERE timestamp <= " . $chatlogsCutoff);
dbquery("DELETE FROM user_roomvisits WHERE entry_timestamp <= " . $visitsCutoff);


?>