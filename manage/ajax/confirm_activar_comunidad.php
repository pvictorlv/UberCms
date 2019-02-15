<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require_once "../global.php";
$Nombre = $gtfo->cleanWord($_GET['nombre']);
if(isset($Nombre)){
mysql_query("UPDATE site_addons_comunidad SET activado='1' WHERE nombre ='".$Nombre."'");
header("Location: " . WWW . "/manage/index.php?_cmd=addons-comunidad");
}
?>