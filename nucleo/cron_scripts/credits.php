<?php

if (!defined('UBER') || !UBER)
{
	exit;
}

db::query("UPDATE users SET credits = credits + 20 WHERE credits < 100 AND online = 1");
$core->Mus('updateCredits', 'ALL');

?>