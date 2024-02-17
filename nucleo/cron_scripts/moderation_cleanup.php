<?php

if (!defined('UBER') || !UBER)
{
	exit;
}

$visitsCutoff = time() - 259200;
$chatlogsCutoff = time() - 1209600;

db::query("DELETE FROM users_chatlogs WHERE timestamp <= " . $chatlogsCutoff);
db::query("DELETE FROM user_rooms_visits WHERE entry_timestamp <= " . $visitsCutoff);


?>