<?php

require_once('../global.php');

$id = FilterText($_GET['songId']);

$mysql = Db::query("SELECT * FROM soundmachine_songs WHERE id = '".$id."' LIMIT 1");
$mysql = $mysql->fetch(PDO::FETCH_ASSOC);
$song = $mysql['data'];
$song = substr($song, 0, -1);
$song = str_replace(":4:", "&track4=", $song);
$song = str_replace(":3:", "&track3=", $song);
$song = str_replace(":2:", "&track2=", $song);
$song = str_replace("1:", "&track1=", $song);
$usuario = "MoNiKoS";
$sql = Db::query("SELECT * FROM users WHERE id = '1' LIMIT 1");
$userrow = $sql->fetch(PDO::FETCH_ASSOC);
$output = "status=0&name=".trim(nl2br($mysql['title']))."&author=".$usuario.$song;
echo $output;
?>