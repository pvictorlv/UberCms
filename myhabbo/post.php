<?php
$url = '%www%/myhabbo/guestbook/list';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'ownerId=2262084&lastEntryId=64900940&widgetId=13182101');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);

$var = explode('.gif" alt="', $response);
foreach($var as $var_data)
{
$nombre = explode('" title="', $var_data[1]);
//$habname = trim($habname[0]);
var_dump($nombre);
echo '<br />';
}

		
?>