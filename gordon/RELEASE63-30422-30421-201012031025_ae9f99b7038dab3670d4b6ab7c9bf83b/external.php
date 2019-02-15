<?php

if (file_exists($_GET['id'] . '.txt'))
{
	header('Content-type: text/plain; charset=utf-8;');
	include $_GET['id'] . '.txt';
}
else
{
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
}

if (empty($_GET['id']))
{
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
}

?> 
