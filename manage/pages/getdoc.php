<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN)
{
	exit;
}

if (!isset($_GET['doc']))
{
	die("No doc!");
}

$file = 'docs/' . $_GET['doc'];

if (!file_exists($file))
{
	die("Could not find file");
}

header("Content-type: application/force-download");
header("Content-Transfer-Encoding: Binary");
header("Content-length: " . filesize($file));
header("Content-disposition: attachment; filename = " . basename($file));
readfile($file);

?>