<?php

require_once "global.php";

if (LOGGED_IN)
{
	header("Location: " . WWW . "/me");
	exit;
}

header("Location: " . WWW);
exit;

?>