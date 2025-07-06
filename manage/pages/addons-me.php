<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}


require_once "top.php";

?>		
<script type="text/javascript" src="./LightWindow/javascript/prototype.js"></script>
<script type="text/javascript" src="./LightWindow/javascript/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="./LightWindow/javascript/lightwindow.js"></script>
<link rel="stylesheet" href="./LightWindow/css/lightwindow.css" type="text/css" media="screen" />

<h1>Addons</h1>
<form method="post">

<br />

<div style="float: left;">

<?php
$getOptions = db::query("SELECT * FROM site_addons WHERE columna='1' ORDER BY orden");
$getOptions2 = db::query("SELECT * FROM site_addons WHERE columna='2' ORDER BY orden");

?>

<strong>Columna 1:</strong>
<br><br>
<?php while($Config = $getOptions->fetch(PDO::FETCH_ASSOC))){
if($Config['activado'] == '1'){
echo '<strong><font color="green">' . $Config['nombre'] . '</font></strong>  ';}
else{ echo '<br><strong><font color="red">' . $Config['nombre'] . '</font></strong>  ';}
if($Config['activado'] == '1'){ echo '<a href="./ajax/confirm_desactivar.php?nombre=' .$Config['nombre']. '" id="boton">Desactivar</a> '; }else{ echo '<a href="./ajax/confirm_activar.php?nombre=' .$Config['nombre']. '" id="boton">Activar</a>';}
echo '<form name="formulario' .$Config['nombre'] . '" method="post" action="index.php?_cmd=editar_addon"><input type="hidden" id="nombre" name="nombre" value="' .$Config['nombre']. '">
<a href="index.php?_cmd=editar_addon&nombre=' .$Config['nombre']. '" id="boton">Editar</a> ';
echo '<a href="./ajax/confirm_borrar.php?nombre=' .$Config['nombre']. '" id="boton" class="lightwindow page-options" params="lightwindow_width=640,lightwindow_height=290">Borrar</a>';
if($Config['nombre'] == 'Chat' | $Config['nombre'] == 'Xat'){echo '';}else{echo '<br>';};
if($Config['nombre'] == 'Chat' | $Config['nombre'] == 'Xat'){echo ' <a href="index.php?_cmd=config_addon&addon=Chat" id="boton">Administrar</a><br>';}
 } ?>

<br>
<strong>Columna 2:</strong>
<br><br>
<?php while($Config = $getOptions2->fetch(PDO::FETCH_ASSOC))){
if($Config['activado'] == '1'){
echo '<strong><font color="green">' . $Config['nombre'] . '</font></strong>  ';}
else{ echo '<br><strong><font color="red">' . $Config['nombre'] . '</font></strong>  ';}
if($Config['activado'] == '1'){ echo '<a href="./ajax/confirm_desactivar.php?nombre=' .$Config['nombre']. '" id="boton">Desactivar</a> '; }else{ echo '<a href="./ajax/confirm_activar.php?nombre=' .$Config['nombre']. '" id="boton">Activar</a>';}
echo '<form name="formulario' .$Config['nombre'] . '" method="post" action="index.php?_cmd=editar_addon"><input type="hidden" id="nombre" name="nombre" value="' .$Config['nombre']. '">
<a href="index.php?_cmd=editar_addon&nombre=' .$Config['nombre']. '" id="boton">Editar</a> ';
echo '<a href="./ajax/confirm_borrar.php?nombre=' .$Config['nombre']. '" id="boton" class="lightwindow page-options" params="lightwindow_width=640,lightwindow_height=290">Borrar</a><br>';
if($Config['nombre'] == 'Chat' | $Config['nombre'] == 'Xat'){echo '<a href="index.php?_cmd=config_addon&addon=Chat" id="boton">Administrar</a>';}
 } ?>

 
<br>
<br>
<a href="index.php?_cmd=nuevo_addon" id="boton">Nuevo Addon</a>

</form>


<?php

require_once "bottom.php";

?>