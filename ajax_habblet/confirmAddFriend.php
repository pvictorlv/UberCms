<?php

require_once("../global.php");
$buscarhabbo = mysql_query("SELECT * FROM users WHERE id = ".$_POST['accountId']."");
$datoshabbo = mysql_fetch_array($buscarhabbo);
echo '<p>
&#191;Seguro que deseas a&#241;adir a '.$datoshabbo['username'].' en tu Lista de Amigos?
</p>

<p>
<a href="#" class="new-button done"><b>Cancelar</b><i></i></a>
<a href="#" class="new-button add-continue"><b>Continuar</b><i></i></a>
</p>';
?>