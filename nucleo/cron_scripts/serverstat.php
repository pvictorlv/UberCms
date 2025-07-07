<?php

if (!defined('UBER') || !UBER)
{
	exit;
}

$curStat = db::query("SELECT status FROM server_status LIMIT 1")->fetchColumn();

if ($curStat == "1")
{
	$stamp = db::query("SELECT stamp FROM server_status LIMIT 1")->fetchColumn();
	$diff = time() - $stamp;

	if ($diff >= 300)
	{
		db::query("UPDATE server_status SET status = '2' LIMIT 1");
	}
}

?>