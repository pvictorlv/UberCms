<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require_once "../global.php";
$Nombre = $gtfo->cleanWord($_GET['nombre']);
if(isset($Nombre)){
mysql_query("DELETE FROM site_promos WHERE titulo ='".$Nombre."'");
header("Location: " . WWW . "/manage/index.php?_cmd=newspromos");
}
?>