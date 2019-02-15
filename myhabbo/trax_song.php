<?php

require_once('../global.php');

$id = FilterText($_GET['songId']);

$mysql = mysql_query("SELECT * FROM soundmachine_songs WHERE id = '".$id."' LIMIT 1");
$mysql = mysql_fetch_assoc($mysql);
$song = $mysql['data'];
$song = substr($song, 0, -1);
$song = str_replace(":4:", "&track4=", $song);
$song = str_replace(":3:", "&track3=", $song);
$song = str_replace(":2:", "&track2=", $song);
$song = str_replace("1:", "&track1=", $song);
$usuario = "MoNiKoS";
$sql = mysql_query("SELECT * FROM users WHERE id = '1' LIMIT 1");
$userrow = mysql_fetch_assoc($sql);
$output = "status=0&name=".trim(nl2br($mysql['title']))."&author=".$usuario.$song;
echo $output;
?>