<?php
define('Xukys', true);
define('NOWHOS', true);
define('MUST_LOG', true);
require_once "./global.php";
global $gtfo;

if(isset($_GET['editar'])){
$creditos = $users->GetUserVar(USER_ID, 'credits');
$creditos_quitar = mysql_query("SELECT creditos_grupos FROM configuracion LIMIT 1");
$creditos_totales = $creditos - $creditos_quitar;
$editar = $gtfo->cleanWord($_GET['editar']);
$Nombre = $_POST['nombre'];
if($editar == 'placa'){
$Placas = $_POST['placas'];
dbquery("UPDATE groups_details SET badge='".$Placas."' WHERE name ='".$Nombre."'");
dbquery("UPDATE users SET credits='".$creditos_totales."' WHERE id ='".USER_ID."'");
$mensaje = "Editado com sucesso";
}
if($editar == 'informacion'){
$Titulo = $_POST['titulo'];
$Descripcion = $_POST['descripcion'];
dbquery("UPDATE groups_details SET description='".$Descripcion."', name='".$Titulo."' WHERE name ='".$Nombre."'");
dbquery("UPDATE users SET credits='".$creditos_totales."' WHERE id ='".USER_ID."'");
$mensaje = "Editado com sucesso!";
}
if($editar == 'fondo'){
$Fondo = $_POST['fondo'];
dbquery("UPDATE groups_details SET bg='".$Fondo."' WHERE name ='".$Nombre."' AND groupid =");
dbquery("UPDATE users SET credits='".$creditos_totales."' WHERE id ='".USER_ID."'");
$mensaje = "Você modificou o fundo do seu grupo corretamente!";
}
<!--
if(isset($_POST['name'])){
$Nombre = $_POST['name'];
$Grupos = mysql_query("SELECT * FROM groups_details WHERE name = '".$Nombre."' LIMIT 1");
$GetGrupo = mysql_fetch_assoc($Grupos);

if($editar == 'favs'){
$favs = $_POST['favs'];
dbquery("UPDATE groups_memberships SET is_current='1' WHERE userid ='".USER_ID."'");
dbquery("UPDATE users SET credits='".$creditos_totales."' WHERE id ='".USER_ID."'");
$mensaje = "Você modificou o fundo do seu grupo corretamente!";
}
-->
$id = mysql_fetch_assoc(mysql_query("SELECT * FROM groups_details WHERE name ='".$Nombre."'"));
}
else
{
header("Location: " . WWW . "/error.php");}
?>

<div class="habblet-container ">
<div class="cbb clearfix green ">
<h2 class="title">¡Editación exitosa!</h2>
<div class="box-content">
<center>
<b><?php if(isset($mensaje)){ echo $mensaje; }; ?></b>
<br>
¿Quieres ir a tu grupo para ver los cambios? Entonces ve <a href="%www%/groups/<?php echo $id['id']; ?>/id">aquí</a>
</center>

</div>

</div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
