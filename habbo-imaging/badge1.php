<?php
define('Xukys', true);
define('NOWHOS', true);
error_reporting(0);
include '../inc/class.xukys.php';
if(!defined('CWD')) {
	define('CWD', str_replace('manage' . DIRECTORY_SEPARATOR, '', dirname(__FILE__) . DIRECTORY_SEPARATOR));
}
Header("Content-type: image/png");

$badge = $_GET['badge'];
	
	$url = 'http://www.habbo.es/habbo-imaging/badge/';
	$u = $badge.'.gif';
	
	$webpage = $url.$u;
if (!file_Exists(CWD.'cache/'.$u)) {
	$fd = fopen( $webpage, "rb" )
	or die();

	$File = fopen(CWD.'cache/'.$u,"wb");

	while (!feof($fd) ) {
	$contents = fread($fd, 4096);
	fwrite($File, $contents );
	echo file_get_contents_curl($webpage);
}
}
else
{
	echo file_get_contents(CWD.'cache/'.$u);
}
fclose( $fd );
fclose( $File );
?> 