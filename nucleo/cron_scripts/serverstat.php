<?php

if (!defined('UBER') || !UBER)
{
	exit;
}

$curStat = mysql_result(dbquery("SELECT status FROM server_status LIMIT 1"), 0);

if ($curStat == "1")
{
	$stamp = mysql_result(dbquery("SELECT stamp FROM server_status LIMIT 1"), 0);
	$diff = time() - $stamp;

	if ($diff >= 300)
	{
		dbquery("UPDATE server_status SET status = '2' LIMIT 1");
	}
}

?>