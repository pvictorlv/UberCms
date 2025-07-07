<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require_once "../global.php";
if(isset($_GET['nombre'])){
$Nombre = $gtfo->cleanWord($_GET['nombre']);
Db::query("DELETE FROM site_addons WHERE nombre ='".$Nombre."'");
header("Location: " . WWW . "/manage/index.php?_cmd=addons-me");
}
?>