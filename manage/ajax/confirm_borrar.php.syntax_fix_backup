<div id="lol" style="height: 290px !important;background-image: url('../web-gallery/v2/images/bg.png') !important;";>
<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require_once "../global.php";
$Nombre = $gtfo->cleanWord($_GET['nombre']);
if(isset($Nombre)){
$Config = ->fetch(PDO::FETCH_ASSOC)Db::query("SELECT * FROM site_addons WHERE nombre='".$Nombre."'"));
echo '<center><img src="./images/website/logo.png"></center><center><div style="margin-top: 24px !important;">Seguro quieres borrar ' .$Config['nombre'] . ' de tus addons?</div></center>
<center><div style="margin-top: 24px !important;"><a href="./ajax/borrar.php?nombre=' .$Nombre. '" style="top:24px !important;"><font color="green">Si</font></a> | <a href="index.php?_cmd=addons"><font color="green">No</font></a></div></center>';
}
?>
<br>
</div>