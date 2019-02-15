<?php

define('NOWHOS', true);
define("Xukys", TRUE);
require_once('../global.php');

$stickerId = $gtfo->cleanWord($_POST['stickerId']);

$getAlreadyItem = mysql_query("SELECT link FROM homes_items WHERE owner_id = '" . USER_ID . "' AND id = '" . $stickerId . "' LIMIT 1");
$data = mysql_fetch_array($getAlreadyItem);
//echo $data['link'];
$getItem = mysql_query("SELECT id FROM site_inventory_items WHERE userId = '" . USER_ID . "' AND id = '" . $data['link'] . "' AND isWaiting = '1' LIMIT 1");


if(mysql_num_rows($getItem) > 0)
{
	echo 'ok1';
	mysql_query("UPDATE site_inventory_items SET isWaiting = '0' WHERE userId = '" . USER_ID . "' AND id = '" . $data['link'] . "' AND isWaiting = '1' LIMIT 1");
	echo 'ok2';
}
if(mysql_num_rows($getAlreadyItem) > 0)
{
	//$row = mysql_fetch_assoc($getAlreadyItem);	
	echo 'ok3';
	mysql_query("DELETE FROM homes_items WHERE owner_id = '" . USER_ID . "' AND id = '" . $stickerId . "' LIMIT 1");
	mysql_query("UPDATE site_inventory_items SET isWaiting = '0' WHERE userId = '" . USER_ID . "' AND id = '" . $data['link'] . "' AND isWaiting = '1' LIMIT 1");
	echo 'ok4';
}

exit;
?>