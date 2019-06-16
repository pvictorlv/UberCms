<?php

if (!defined('UBER') || !UBER)
{
	exit;
}

$visitsCutoff = time() - 259200;
$chatlogsCutoff = time() - 1209600;

db::query("DELETE FROM chatlogs WHERE timestamp <= " . $chatlogsCutoff);
db::query("DELETE FROM user_roomvisits WHERE entry_timestamp <= " . $visitsCutoff);


?>