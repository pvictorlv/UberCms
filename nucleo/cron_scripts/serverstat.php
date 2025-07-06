<?php

if (!defined('UBER') || !UBER)
{
	exit;
}

$curStat = ->fetchColumn(db::query("SELECT status FROM server_status LIMIT 1"), 0);

if ($curStat == "1")
{
	$stamp = ->fetchColumn(db::query("SELECT stamp FROM server_status LIMIT 1"), 0);
	$diff = time() - $stamp;

	if ($diff >= 300)
	{
		db::query("UPDATE server_status SET status = '2' LIMIT 1");
	}
}

?>